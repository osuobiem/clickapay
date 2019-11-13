<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends Ace_Controller {

	public function __construct() {
    parent::__construct();

    $this->load->model(array(
			'admins_model',
			'users_model',
    ));
  }

	public function index() {
		$this->sech('admin', '1dama3na/login');

		$users = $this->users_model->getCount();

		$this->data['title'] = 'Dashboard | Clickapay Admin';
		$this->data['active_link'] = 'dashboard';
		$this->data['users'] = $users;

		$this->load->view('admin/components/header', $this->data);
		$this->load->view('admin/components/sidebar');
		$this->load->view('admin/index');
		$this->load->view('admin/components/footer');
	}

	public function login() {
		$this->sech('admin', '1dama3na', true);

		$this->data['title'] = 'Admin Login | Clickapay';

		if($_POST) {
      $rules = $this->rules();
      $this->form_validation->set_rules($rules['login']);

      if(!$this->form_validation->run()){
        $this->load->view('admin/login', $this->data);
      }
      else {
        $username = $this->input->post('username');
        $password = $this->hash($this->input->post('password'));

        $admin = $this->admins_model->login($username, $password);
        if($admin) {
          $admin = ['admin' => $admin];
          $this->session->set_userdata($admin);

          redirect(base_url('1dama3na'));
        }
        else {
          $this->session->set_flashdata('error', 'Invalid Credentials');
					redirect(base_url('1dama3na/login'));
        }
      }
    }
		else {
			$this->load->view('admin/login', $this->data);
		}
	}

	public function logout() {
		session_destroy();
		redirect(base_url('1dama3na/login'));
	}

	public function users() {
		$this->sech('admin', '1dama3na/login');

		$users = $this->users_model->get(['order_by' => ['created_at' => 'DESC']]);
		
		$this->data['title'] = 'Users | Clickapay Admin';
		$this->data['active_link'] = 'users';
		$this->data['users'] = $users;

		$this->load->view('admin/components/header', $this->data);
		$this->load->view('admin/components/sidebar');
		$this->load->view('admin/users/index');
		$this->load->view('admin/components/footer');
	}

	public function addUser() {
    $this->sech('admin', '1dama3na/login');
    if($_POST) {
      $rules = $this->rules();
      $this->form_validation->set_rules($rules['add-user']);

      if(!$this->form_validation->run()){
        $this->load->view('admin/components/header', $this->data);
				$this->load->view('admin/components/sidebar');
				$this->load->view('admin/users');
				$this->load->view('admin/components/footer');
      }
      else {
        $firstname = $this->input->post('fname');
        $lastname = $this->input->post('lname');
        $email = $this->input->post('email');
        $phone = $this->input->post('phone');
        $password = $this->hash($this->input->post('password'));

        $data = array(
          'id' => Random::generate(40),
          'firstname' => $firstname,
          'lastname' => $lastname,
          'email' => $email,
          'phone' => $phone,
          'password' => $password,
        );

        $user = $this->users_model->create($data);
        if($user) {
          $this->session->set_flashdata('success', 'User added successfully');
					redirect(base_url('1dama3na/users'));
        }
        else {
          $this->session->set_flashdata('error', 'Error adding user');
					redirect(base_url('1dama3na/users'));
        }
      }
    }
	}

	public function editUser() {
    $this->sech('admin', '1dama3na/login');

    $id = base64_decode($this->uri->segment(4));

		if($_POST) {
			$rules = $this->rules();
			$this->form_validation->set_rules($rules['edit-user']);

			if(!$this->form_validation->run()){
				redirect(base_url('1dama3na/users'));
			}
			else {
				$firstname = $this->input->post('fname');
				$lastname = $this->input->post('lname');
				$email = $this->input->post('email');
				$phone = $this->input->post('phone');

				$data = array(
					'firstname' => $firstname,
					'lastname' => $lastname,
					'email' => $email,
					'phone' => $phone
				);

				if(!empty($this->input->post('password'))) {
					$password = $this->hash($this->input->post('password'));
					$data['password'] = $password;
				}

				$options = array(
					'filter' => ['id' => $id],
					'data' => $data
				);

				$user = $this->users_model->update($options);
				if($user) {
					$this->session->set_flashdata('success', 'User updated successfully');
					redirect(base_url('1dama3na/users'));
				}
				else {
					$this->session->set_flashdata('error', 'Error updating user');
					redirect(base_url('1dama3na/users'));
				}
			}
		}
  }

	public function userStatus() {
		$this->sech('admin', '1dama3na/login');

		$status = $this->uri->segment(4);
		$id = base64_decode($this->uri->segment(5));
		
		$status = ($status == 1) ? 0 : 1;

		$options = array(
			'filter' => ['id' => $id],
			'data' => ['disabled' => $status]
		);

		$user = $this->users_model->update($options);
		if($user) {
			$this->session->set_flashdata('success', 'User disabled successfully');
			redirect(base_url('1dama3na/users'));
		}
		else {
			$this->session->set_flashdata('error', 'Error disabling user');
			redirect(base_url('1dama3na/users'));
		}
	}

	private function rules() {
    return $rules = array(
			'login' => array (
				array(
					'field' => 'username',
					'label' => 'Username',
					'rules' => 'trim|required|xss_clean'
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required|xss_clean'
				),
			),

			'add-user' => array(
				array(
          'field' => 'fname',
          'label' => 'Firstname',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'lname',
          'label' => 'Lastname',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'trim|required|xss_clean|valid_email|is_unique[users.email]',
          'errors' => array(
                        'is_unique' => 'Email is already taken',
                      ),
        ),
        array(
          'field' => 'phone',
          'label' => 'Phone',
          'rules' => 'trim|required|xss_clean|is_unique[users.phone]',
          'errors' => array(
                        'is_unique' => 'Phone number already in use',
                      ),
        ),
        array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'trim|required|xss_clean|min_length[6]'
        ),
			),
			
			'edit-user' => array(
        array(
          'field' => 'fname',
          'label' => 'Firstname',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'lname',
          'label' => 'Lastname',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'email',
          'label' => 'Email',
          'rules' => 'trim|required|xss_clean|valid_email',
        ),
        array(
          'field' => 'phone',
          'label' => 'Phone',
          'rules' => 'trim|required|xss_clean',
        ),
        array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'trim|xss_clean|min_length[6]'
        ),
      ),

		);
	}
	
}

/* End of file Admin.php */