<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdFaq extends Ace_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model(array(
      'faqs_model'
    ));
  }

  public function index() {
    $this->sech('admin', '1dama3na/login');

    $faqs = $this->faqs_model->get(['order_by' => ['created_at' => 'DESC']]);
    
    $this->data['title'] = 'FAQ | Clickapay Admin';
    $this->data['active_link'] = 'faqs';
    $this->data['faqs'] = $faqs;

    $this->load->view('admin/components/header', $this->data);
    $this->load->view('admin/components/sidebar');
    $this->load->view('admin/faqs/index');
    $this->load->view('admin/components/footer');
  }

  public function add() {
    $this->sech('admin', '1dama3na/login');
    if($_POST) {
      $rules = $this->rules();
      $this->form_validation->set_rules($rules['add']);

      if(!$this->form_validation->run()){
        $this->load->view('admin/components/header', $this->data);
        $this->load->view('admin/components/sidebar');
        $this->load->view('admin/faqs');
        $this->load->view('admin/components/footer');
      }
      else {
        $question = $this->input->post('question');
        $answer = $this->input->post('answer');

        $data = array(
          'id' => Random::generate(40),
          'question' => $question,
          'answer' => $answer,
        );

        $faq = $this->faqs_model->create($data);
        if($faq) {
          $this->session->set_flashdata('success', 'FAQ added successfully');
          redirect(base_url('1dama3na/faqs'));
        }
        else {
          $this->session->set_flashdata('error', 'Error adding FAQ');
          redirect(base_url('1dama3na/faqs'));
        }
      }
    }
  }

  public function edit() {
    $this->sech('admin', '1dama3na/login');

    $id = base64_decode($this->uri->segment(4));

    if($_POST) {
      $rules = $this->rules();
      $this->form_validation->set_rules($rules['edit']);

      if(!$this->form_validation->run()){
        redirect(base_url('1dama3na/ads'));
      }
      else {
        $question = $this->input->post('question');
        $answer = $this->input->post('answer');

        $data = array(
          'question' => $question,
          'answer' => $answer,
        );

        $options = array(
          'filter' => ['id' => $id],
          'data' => $data
        );

        $faq = $this->faqs_model->update($options);
        if($faq) {
          $this->session->set_flashdata('success', 'FAQ updated successfully');
          redirect(base_url('1dama3na/faqs'));
        }
        else {
          $this->session->set_flashdata('error', 'Error updating FAQ');
          redirect(base_url('1dama3na/faqs'));
        }
      }
    }
  }

  public function status() {
    $this->sech('admin', '1dama3na/login');

    $status = $this->uri->segment(4);
    $id = base64_decode($this->uri->segment(5));
    
    $status = ($status == 1) ? 0 : 1;

    $options = array(
      'filter' => ['id' => $id],
      'data' => ['disabled' => $status]
    );

    $faqs = $this->faqs_model->update($options);
    if($faq) {
      $this->session->set_flashdata('success', 'FAQ disabled successfully');
      redirect(base_url('1dama3na/faqs'));
    }
    else {
      $this->session->set_flashdata('error', 'Error disabling FAQ');
      redirect(base_url('1dama3na/faqs'));
    }
  }

  private function rules() {
    return $rules = array(
      'add' => array(
        array(
        'field' => 'question',
        'label' => 'Question',
        'rules' => 'trim|required|xss_clean|is_unique[faqs.question]',
        ),
        array(
          'field' => 'answer',
          'label' => 'Answer',
          'rules' => 'trim|xss_clean',
        ),
      ),
      'edit' => array(
        array(
        'field' => 'question',
        'label' => 'Question',
        'rules' => 'trim|required|xss_clean',
        ),
        array(
          'field' => 'answer',
          'label' => 'Answer',
          'rules' => 'trim|xss_clean',
        ),
      )
    );
  }

}

/* End of file AdFaq.php */
