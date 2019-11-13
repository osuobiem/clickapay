<?php

  
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Ad extends Ace_Controller {
  
    public function __construct() {
      parent::__construct();

      $this->load->model(array(
        'ads_model',
        'providers_model'
      ));
    }

    public function index() {
      $this->sech('admin', '1dama3na/login');

      $ads = $this->ads_model->get(['order_by' => ['created_at' => 'DESC']]);
      foreach($ads as $ad) {
        $this->ads_model->preserved = $ad->provider_id;
        
        $provider = $this->ads_model->provider()->getR();
        $ad->provider = $provider;
      }

      $providers = $this->providers_model->get(['where' => ['disabled' => 0], 'order_by' => ['name' => 'ASC']]);
      
      $this->data['title'] = 'Ads | Clickapay Admin';
      $this->data['active_link'] = 'ads';
      $this->data['ads'] = $ads;
      $this->data['providers'] = $providers;

      $this->load->view('admin/components/header', $this->data);
      $this->load->view('admin/components/sidebar');
      $this->load->view('admin/ads/index');
      $this->load->view('admin/components/footer');
    }

    public function add() {
      $this->sech('admin', '1dama3na/login');
      if($_POST) {
        $rules = $this->rules();
        $this->form_validation->set_rules($rules);

        if(!$this->form_validation->run()){
          $this->load->view('admin/components/header', $this->data);
          $this->load->view('admin/components/sidebar');
          $this->load->view('admin/ads');
          $this->load->view('admin/components/footer');
        }
        else {
          $provider = base64_decode($this->input->post('provider'));
          $medium = $this->input->post('medium');

          $data = array(
            'id' => Random::generate(40),
            'provider_id' => $provider,
            'i_medium' => $medium,
          );

          $ad = $this->ads_model->create($data);
          if($ad) {
            $this->session->set_flashdata('success', 'Ad added successfully');
            redirect(base_url('1dama3na/ads'));
          }
          else {
            $this->session->set_flashdata('error', 'Error adding ad');
            redirect(base_url('1dama3na/ads'));
          }
        }
      }
    }

    public function edit() {
      $this->sech('admin', '1dama3na/login');

      $id = base64_decode($this->uri->segment(4));

      if($_POST) {
        $rules = $this->rules();
        $this->form_validation->set_rules($rules);

        if(!$this->form_validation->run()){
          redirect(base_url('1dama3na/ads'));
        }
        else {
          $provider = base64_decode($this->input->post('provider'));
          $medium = $this->input->post('medium');

          $data = array(
            'provider_id' => $provider,
            'i_medium' => $medium,
          );

          $options = array(
            'filter' => ['id' => $id],
            'data' => $data
          );

          $ad = $this->ads_model->update($options);
          if($ad) {
            $this->session->set_flashdata('success', 'Ad updated successfully');
            redirect(base_url('1dama3na/ads'));
          }
          else {
            $this->session->set_flashdata('error', 'Error updating ad');
            redirect(base_url('1dama3na/ads'));
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

      $ad = $this->ads_model->update($options);
      if($ad) {
        $this->session->set_flashdata('success', 'Ad disabled successfully');
        redirect(base_url('1dama3na/ads'));
      }
      else {
        $this->session->set_flashdata('error', 'Error disabling ad');
        redirect(base_url('1dama3na/ads'));
      }
    }
  
    private function rules() {
      return $rules = array(
        array(
          'field' => 'provider',
          'label' => 'Provider',
          'rules' => 'trim|required'
        ),
        array(
          'field' => 'medium',
          'label' => 'Integration Medium',
          'rules' => 'trim|required',
        ),
      );
    }
    
  }
  
  /* End of file Ad.php */
  