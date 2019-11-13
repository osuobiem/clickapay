<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Ace_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model(array(
      'users_model',
      'banks_model',
      'userAccounts_model',
      'passwords_model',
      'clicks_model',
      'withdraw_model',
      'logs_model'
    ));
  }

  public function index($view = 'dashboard') {
    $this->sech('user', '/');

    $view = $_SESSION['view'];
    $_SESSION['page'] = '';
    
    $this->data['bal'] = isset($_SESSION['user'])?$this->formatCurrency($_SESSION['user']->balance):'';

    if($view == 'bank' && $_SESSION['user']->account) {
      $view = 'account';
    }

    $data = [
      'tb' => 0,
      'mb' => 0,
      'tc' => 0,
      'mc' => 0,
      'bal' => $this->formatCurrency($_SESSION['user']->balance)
    ];

    if($view == 'dashboard') {

        $cd = $this->clicks_model->get(['where' => ['user_id' => $_SESSION['user']->id], 'like' => ['created_at' => date('Y-m-d')]]);
        $cm = $this->clicks_model->get(['where' => ['user_id' => $_SESSION['user']->id], 'like' => ['created_at' => date('Y-m')]]);

        $tb = 0;
        $mb = 0;
        $tc = count($cd);
        $mc = count($cm);
        $bal = $this->formatCurrency($_SESSION['user']->balance);

        foreach($cd as $c) {
          $tb += $c->paid;
        }
        foreach($cm as $c) {
          $mb += $c->paid;
        }

        $mb = $this->formatCurrency($mb);
        $tb = $this->formatCurrency($tb);

        $data = [
          'tb' => $tb,
          'mb' => $mb,
          'tc' => $tc,
          'mc' => $mc,
          'bal' => $bal
        ];
    }

    if($view == 'withdraw') {
      $reqs = $this->withdraw_model->getCount([
        'where' => ['user_id' => $_SESSION['user']->id],
        'like' => ['created_at' => date('Y-m')]
      ]);

      if($reqs > 0) {
        $data['tb'] = 1;
      }
    }

    $this->data['_token'] = base64_encode(base64_encode(config_item('api_token')));
    $this->data['content'] = spa::view($view, $data);
    $_SESSION['active'] = ($view == 'account') ? 'bank' : $view;
    $this->data['title'] = 'User '.ucfirst($_SESSION['view']).' - Clickapay.ng';

    $this->load->view('templates/header', $this->data);
    $this->load->view('users/index');
    $this->load->view('templates/footer');
  }

  public function login() {
    $this->sech('user', '/user/dashboard', true);
    if($_POST) {
      $rules = $this->rules();
      $this->form_validation->set_rules($rules['login']);

      if(!$this->form_validation->run()){
        $res = ['status' => false, 'message' => validation_errors()];
        echo json_encode($res);
      }
      else {
        $api_token = base64_decode(base64_decode($this->input->post('_token')));
        $email_phone =  strtolower($this->input->post('emailPhone'));
        $password = $this->hash(strtolower($this->input->post('password')));
        $remember = $this->input->post('remember');
        
        if($this->verifyToken($api_token, 'api_token')) {
          $login = $this->users_model->login($email_phone, $password);
          
          if($login) {
            $banks = $this->banks_model->get(['order_by' => ['name' => 'ASC']]);
            $d_clicks = $this->clicks_model->get(['where' => ['user_id' => $login->id], 'like' => ['created_at' => date('Y-m-d')]]);
            $m_clicks = $this->clicks_model->get(['where' => ['user_id' => $login->id], 'like' => ['created_at' => date('Y-m')]]);

            $account = $this->users_model->account()->getR();
            $login->account = ($account) ? $account : [];

            $this->session->set_userdata(['user'=>$login]);
            $this->session->set_userdata(['data'=>['banks' => $banks, 'clicks_m' => $m_clicks, 'clicks_d' => $d_clicks]]);

            if($remember == 'on') {
              $token = Random::generate(40);
              set_cookie('_r_t', $token, time());

              $options = array(
                'filter' => ['id' => $login->id],
                'data' => ['remember_token' => $token]
              );
              
              $this->users_model->update($options);
            }
            $res = ['status' => true, 'message' => 'Success'];
          }
          else {
            $res = ['status' => false, 'message' => 'Invalid Credentials'];
          }
        }
        else {
          http_response_code(400);
          $res = ['status' => false, 'message' => 'Bad Request'];
        }

        echo json_encode($res);
      }
    }
  }

  public function add() {
    if($_POST) {
      $rules = $this->rules();
      $this->form_validation->set_rules($rules['add']);

      if(!$this->form_validation->run()){
        $res = ['status' => false, 'message' => validation_errors()];
        echo json_encode($res);
      }
      else {
        if(array_key_exists('user', $_SESSION)) {
          redirect('/user/dashboard');
        }
        else {
          $token = base64_decode(base64_decode($this->input->post('_token')));
          if($this->verifyToken($token, 'api_token')) {
            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $email = strtolower($this->input->post('email'));
            $phone = $this->input->post('phone');
            $password = $this->hash(strtolower($this->input->post('password')));

            $user_id = Random::generate(40);
            $data = array(
              'id' => $user_id,
              'firstname' => $firstname,
              'lastname' => $lastname,
              'email' => $email,
              'phone' => $phone,
              'password' => $password
            );

            $log_data = array(
              'user_id' => $user_id,
              'shown' => '',
              'count' => 1
            );
            
            $user = $this->users_model->create($data);
            $log = $this->logs_model->create($log_data);
            
            if($user && $log) {
              $subject = 'Welcome To Clickapay';
              $data = ['email' => $email, 'name' => $firstname.' '.$lastname];
              $body = $this->template('register', $data);
              $sender = 'no-reply@clickapay.com.ng';
              
              $this->mailer->send($email, $subject, $body, $sender);

              $user = $this->users_model->login($email, $password);
              if($user) {
                $banks = $this->banks_model->get(['order_by' => ['name' => 'ASC']]);
                $d_clicks = $this->clicks_model->get(['where' => ['user_id' => $user->id], 'like' => ['created_at' => '2019-'.date('m-d')]]);
                $m_clicks = $this->clicks_model->get(['where' => ['user_id' => $user->id], 'like' => ['created_at' => '2019-'.date('m')]]);

                $account = $this->users_model->account()->getR();
                $user->account = ($account) ? $account : '';

                $this->session->set_userdata(['user'=>$user]);
                $this->session->set_userdata(['data'=>['banks' => $banks, 'clicks_m' => $m_clicks, 'clicks_d' => $d_clicks]]);
                $res = ['status' => true, 'message' => 'Success'];
              }
              else {
                $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
              }
            }
            else {
              $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
            }
          }
          else {
            http_response_code(400);
            $res = ['status' => false, 'message' => 'Bad Request'];
          }

          echo json_encode($res);
        }
      }
    }
    else {
      http_response_code(400);
      $res = ['status' => false, 'message' => 'Bad Request'];
      echo json_encode($res);
    }
  }

  public function edit() {
    if($_POST) {
      $rules = $this->rules();
      $this->form_validation->set_rules($rules['edit']);

      if(!$this->form_validation->run()){
        $res = ['status' => false, 'message' => validation_errors()];
        echo json_encode($res);
      }
      else {
        $token = base64_decode(base64_decode($this->input->post('_token')));
        if($this->verifyToken($token, 'api_token')) {
          $firstname = $this->input->post('firstname');
          $lastname = $this->input->post('lastname');
          $phone = $this->input->post('phone');

          $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'phone' => $phone,
          );

          if(!empty($this->input->post('password'))) {
            $data['password'] = $this->hash(strtolower($this->input->post('password')));
          }
          
          $data = [
            'filter' => ['id' => $_SESSION['user']->id],
            'data' => $data
          ];

          $user = $this->users_model->update($data);
          
          if($user) {
            $user = $this->users_model->getOne(['id' => $_SESSION['user']->id]);
            if($user) {
              $banks = $this->banks_model->get(['order_by' => ['name' => 'ASC']]);
              $account = $this->users_model->account()->getR();
              $user->account = ($account) ? $account : '';

              $this->session->set_userdata(['user'=>$user]);
              $res = ['status' => true, 'message' => 'Success'];
            }
            else {
              $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
            }
          }
          else {
            $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
          }
        }
        else {
          http_response_code(400);
          $res = ['status' => false, 'message' => 'Bad Request'];
        }

        echo json_encode($res);
      }
    }
    else {
      http_response_code(400);
      $res = ['status' => false, 'message' => 'Bad Request'];
      echo json_encode($res);
    }
  }

  public function forgotPassword() {
    if($_POST) {
      $email = strtolower($this->input->post('email'));
      if($this->validateEmail(['email' => $email])){

        $token = base64_decode(base64_decode($this->input->post('_token')));
        if($this->verifyToken($token, 'api_token')) {
          $user = $this->users_model->getCount(['email' => $email, 'disabled' => 0]);
          if($user > 0) {
            $token = Random::generate(40).Random::generate(40);

            $subject = 'Clickapay Password Reset';
						$data = ['email' => $email, 'link' => 'https://www.clickapay.com.ng/reset-password/'.$token];
            $body = $this->template('password', $data);
            $sender = 'no-reply@clickapay.com.ng';
            
						// Email sender status check
						if($this->mailer->send($email, $subject, $body, $sender)) {
              $data = [
                'id' => Random::generate(40),
                'email' => $email,
                'token' => $token
              ];

              $password = $this->passwords_model->create($data);
              if($password) {
                $res = ['status' => true, 'message' => 'Success'];
              }
              else {
                $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
              }
            }
            else {
              $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
            }
          }
          else {
            $res = ['status' => false, 'message' => '<strong>'.$email.'</strong> has not been registered.'];
          }
        }
        else {
          http_response_code(400);
          $res = ['status' => false, 'message' => 'Bad Request'];
        }
      }
      else {
        $res = ['status' => false, 'message' => validation_errors()];
      }

      echo json_encode($res);
    }
    else {
      http_response_code(400);
      $res = ['status' => false, 'message' => 'Bad Request'];
      echo json_encode($res);
    }
  }

  public function resetPassword() {
    if($_POST) {
      $rules = $this->rules();
      $this->form_validation->set_rules($rules['reset-pass']);

      if(!$this->form_validation->run()){
        $this->session->set_flashdata(['error'=>validation_errors()]);
        redirect('/');
      }
      else {
          $data = array(
            'password' => $this->hash(strtolower($this->input->post('password')))
          );
          
          $data = [
            'filter' => ['email' => $_SESSION['res_email']],
            'data' => $data
          ];

          $user = $this->users_model->update($data);
          
          if($user) {
            $data = [
            'filter' => ['email' => $_SESSION['res_email']],
            'data' => ['used' => 1]
          ];

            $this->passwords_model->update($data);
            $this->session->set_flashdata(['success'=>'Password Changed Successfully']);
            redirect('/');
          }
          else {
            $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
          }
      }
    }
    else {
      $token = $this->uri->segment(2);

      $email = $this->passwords_model->getOne(['token' => $token, 'used' => 0]);
      if($email) {
        $email = $email->email;
        $user = $this->users_model->getOne(['email' => $email, 'disabled' => 0]);
        
        if($user) {
          $this->data['_token'] = base64_encode(base64_encode(config_item('api_token')));
          $this->data['title'] = 'Reset Password - Clickapay.ng';

          $this->session->set_userdata(['res_email'=>$email]);

          $this->load->view('templates/header', $this->data);
          $this->load->view('main/reset-password');
          $this->load->view('templates/footer');
        }
        else {
          $this->session->set_flashdata(['error'=>'<strong>Oops</strong> Something went wrong. Try Again']);
          redirect('/');
        }
      }
      else {
        $this->session->set_flashdata(['error'=>'<strong>Oops</strong> Something went wrong. Try Again']);
        redirect('/');
      }
    }
  }



  public function validateEmail($data) {
		$this->form_validation->set_data($data);
		$this->form_validation->set_rules('email', 'Email', 'xss_clean|trim|required|valid_email');

		if($this->form_validation->run()) {
			return true;
		}
		else {
			return false;
		}
	}

  public function logout() {
    $this->session->unset_userdata('user');
    $this->session->unset_userdata('content');
    $this->session->unset_userdata('data');
    $this->session->unset_userdata('active');
    $this->session->unset_userdata('shown');
    $this->session->unset_userdata('count');
    
    delete_cookie('_r_t');
    redirect();
  }

  private function rules() {
    return array(
      'login' => array (
        array(
          'field' => 'emailPhone',
          'label' => 'Email or Phone',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'rememberMe',
          'label' => 'Remember',
          'rules' => 'xss_clean'
        ),
      ),

      'add' => array(
        array(
          'field' => 'firstname',
          'label' => 'Firstname',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'lastname',
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
          'rules' => 'trim|required|xss_clean|exact_length[11]|numeric|is_unique[users.phone]|callback_validatePhone[phone]',
          'errors' => array(
                        'is_unique' => 'Phone number is already taken',
                      ),
        ),
        array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'trim|required|xss_clean|min_length[6]'
        ),
      ),

      'edit' => array(
        array(
          'field' => 'firstname',
          'label' => 'Firstname',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'lastname',
          'label' => 'Lastname',
          'rules' => 'trim|required|xss_clean'
        ),
        array(
          'field' => 'phone',
          'label' => 'Phone',
          'rules' => 'trim|xss_clean|exact_length[11]|numeric|callback_validatePhone[phone]|callback_excludePhone[phone]',
        ),
        array(
          'field' => 'password',
          'label' => 'Password',
          'rules' => 'trim|xss_clean|min_length[6]'
        ),
      ),

      'reset-pass' => array(
        array(
          'field' => 'password',
          'label' => 'New Password',
          'rules' => 'trim|required|xss_clean|min_length[6]'
        ),
      ),

    );
  }

  public function validatePhone($phone) {
    if(strlen($phone) != 11) {
      $this->form_validation->set_message('validatePhone', 'The Phone field must be exactly 11 characters in length.');
      return false;
    }

    $f3 = substr($phone, 0, 3);
    $ph3_array = array(
      '080', '090', '070', '081'
    );

    if(in_array($f3, $ph3_array)) {
      return true;
    }
    else {
      $this->form_validation->set_message('validatePhone', 'Invalid phone number');
      return false;
    }
  }
  
  public function excludePhone($form_phone) {
    $real_phone = $_SESSION['user']->phone;

    $user_count = $this->users_model->getCount([
      'phone' => $form_phone,
      'phone !=' => $real_phone
      ]);

    if($form_phone == $real_phone) {
      return true;
    }
    else {
      if($user_count > 0) {
        $this->form_validation->set_message('excludePhone', 'Phone number is already taken');
        return false;
      }
      else {
        true;
      }
    }
  }

  private function photoUpload($input_name, $file_name)
  {
    $config['upload_path']       = './main-assets/img/users';
    $config['allowed_types']     = 'gif|jpg|png|jpeg';
    $config['file_ext_tolower']  = true;
    $config['file_name']         = $file_name;

    $this->upload->initialize($config);

    if (!$this->upload->do_upload($input_name)) {
      return false;
    } else {
      return true;
    }
  }
  
}

/* End of file User.php */
