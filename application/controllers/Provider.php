<?php

  
  defined('BASEPATH') OR exit('No direct script access allowed');
  
  class Provider extends Ace_Controller {
  
    public function __construct() {
      parent::__construct();

      $this->load->model(array(
        'providers_model'
      ));
    }

    public function index() {
      $this->sech('admin', '1dama3na/login');

      $providers = $this->providers_model->get(['order_by' => ['created_at' => 'DESC']]);
      
      $this->data['title'] = 'Providers | Clickapay Admin';
      $this->data['active_link'] = 'providers';
      $this->data['providers'] = $providers;

      $this->load->view('admin/components/header', $this->data);
      $this->load->view('admin/components/sidebar');
      $this->load->view('admin/providers/index');
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
          $this->load->view('admin/providers');
          $this->load->view('admin/components/footer');
        }
        else {
          $name = $this->input->post('name');
          $url = $this->input->post('url');

          $data = array(
            'id' => Random::generate(40),
            'name' => $name,
            'url' => $url,
          );

          $provider = $this->providers_model->create($data);
          if($provider) {
            $this->session->set_flashdata('success', 'Provider added successfully');
            redirect(base_url('1dama3na/providers'));
          }
          else {
            $this->session->set_flashdata('error', 'Error adding provider');
            redirect(base_url('1dama3na/providers'));
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
          redirect(base_url('1dama3na/providers'));
        }
        else {
          $name = $this->input->post('name');
          $url = $this->input->post('url');

          $data = array(
            'name' => $name,
            'url' => $url
          );

          $options = array(
            'filter' => ['id' => $id],
            'data' => $data
          );

          $provider = $this->providers_model->update($options);
          if($provider) {
            $this->session->set_flashdata('success', 'Provider updated successfully');
            redirect(base_url('1dama3na/providers'));
          }
          else {
            $this->session->set_flashdata('error', 'Error updating provider');
            redirect(base_url('1dama3na/providers'));
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

      $provider = $this->providers_model->update($options);
      if($provider) {
        $this->session->set_flashdata('success', 'Provider disabled successfully');
        redirect(base_url('1dama3na/providers'));
      }
      else {
        $this->session->set_flashdata('error', 'Error disabling provider');
        redirect(base_url('1dama3na/providers'));
      }
    }
  
    private function rules() {
      return $rules = array(
        'add' => array(
          array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
          ),
          array(
            'field' => 'url',
            'label' => 'Url',
            'rules' => 'trim|required|xss_clean|is_unique[providers.url]',
            'errors' => array(
                          'is_unique' => 'URL already exists',
                        ),
          ),
        ),

        'edit' => array(
          array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|xss_clean'
          ),
          array(
            'field' => 'url',
            'label' => 'Url',
            'rules' => 'trim|required|xss_clean',
          ),
        ),
      );
    }
    
  }
  
  /* End of file Provider.php */
  