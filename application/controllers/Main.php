<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Ace_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model(array(
      'users_model',
      'banks_model',
      'withdraw_model',
      'faqs_model',
      'ads_model',
      'clicks_model',
      'logs_model'
    ));
  }

	public function index() {
    $this->session->unset_userdata('active');
    $_SESSION['page'] = 'home';
    //$this->autoLogin();

    $this->data['_token'] = base64_encode(base64_encode(config_item('api_token')));
    $this->data['title'] = 'Pay Day is a Click Away - Clickapay.ng';
    $this->data['bal'] = isset($_SESSION['user'])?$this->formatCurrency($_SESSION['user']->balance):''; 

    if(isset($_SESSION['user'])) {
      redirect('click');
    }
    else {
      $this->load->view('templates/header', $this->data);
      $this->load->view('main/index');
      $this->load->view('templates/footer');
    }
    
  }
  
  public function click() {
    $_SESSION['page'] = 'home';

    $log = $this->logs_model->getOne(['user_id' => $_SESSION['user']->id]);
    $_SESSION['count'] = $log->count;

    if(empty($log->shown)) {
      $ad = $this->ads_model->getOne(['count' => $log->count]);
      $_SESSION['shown'] = $ad->id;
    }
    else {
      $_SESSION['shown'] = $log->shown;
    }
  
    $this->data['ad'] = $this->ads_model->getOne(['id' => $_SESSION['shown']])->i_medium;

    $this->data['_token'] = base64_encode(base64_encode(config_item('api_token')));
    $this->data['title'] = 'Pay Day is a Click Away - Clickapay.ng';
    $this->data['bal'] = isset($_SESSION['user'])?$this->formatCurrency($_SESSION['user']->balance):''; 

    $this->load->view('templates/header', $this->data);
    $this->load->view('main/click');
    $this->load->view('templates/footer');
  }

  public function processClick() {
    $api_token = base64_decode(base64_decode($this->input->post('_token')));
    
    if($this->verifyToken($api_token, 'api_token') && isset($_SESSION['shown'])) {
      if(isset($_POST['skip'])) {
        $ad_id = $_SESSION['shown'];
        $count = $_SESSION['count'];
        $ads = $this->ads_model->getCount();

        if($_SESSION['count'] == $ads) {
          $count = 0;
        }

        $ad = $this->ads_model->getOne(['count' => $count+1]);
        $_SESSION['shown'] = $ad->id;
        $_SESSION['count'] = $count+1;
        
        $this->logs_model->update(['filter' => ['user_id' => $_SESSION['user']->id], 'data' => ['shown' => $_SESSION['shown'], 'count' => $_SESSION['count']]]);

        echo $ad->i_medium.'<script src="'.base_url().'main-assets/js/click.js"></script>';
      }
      else {
        $log = $this->logs_model->getOne(['user_id' => $_SESSION['user']->id]);
        if($log->count != $_SESSION['count']) {
          $_SESSION['shown'] = $log->shown;
          $_SESSION['count'] = $log->count;

          $ad = $this->ads_model->getOne(['count' => $_SESSION['count']]);
          echo $ad->i_medium.'<script src="'.base_url().'main-assets/js/click.js"></script>';
        }
        else {
          $ad_id = $_SESSION['shown'];
          $count = $_SESSION['count'];
          
          $user = $_SESSION['user']->id;
          $ip = '';
          if(getenv('REMOTE_ADDR'))
              $ip = getenv('REMOTE_ADDR');
          else
              $ip = 'UNKNOWN';

          $paid = 1;

          $data = [
            'id' => Random::generate(),
            'ip_address' => $ip,
            'user_id' => $user,
            'ad_id' => $ad_id,
            'paid' => $paid
          ];

          $this->clicks_model->create($data);
          $_SESSION['user']->balance = $_SESSION['user']->balance + 1;
          $this->users_model->update(['filter' => ['id' => $user], 'data' => ['balance' => $_SESSION['user']->balance]]);

          $ads = $this->ads_model->getCount();
          if($_SESSION['count'] == $ads) {
            $count = 0;
          }

          $ad = $this->ads_model->getOne(['count' => $count+1]);
          $_SESSION['shown'] = $ad->id;
          $_SESSION['count'] = $count+1;
          
          $this->logs_model->update(['filter' => ['user_id' => $user], 'data' => ['shown' => $_SESSION['shown'], 'count' => $_SESSION['count']]]);

          echo $ad->i_medium.'<script src="'.base_url().'main-assets/js/click.js"></script>';
        }
      }
    }
    else {
      http_response_code(400);
    }
  }

  public function faq() {
    $this->session->unset_userdata('active');
    $_SESSION['page'] = 'faq';

    $this->data['_token'] = base64_encode(base64_encode(config_item('api_token')));
    $this->data['title'] = 'FAQ - Clickapay.ng';
    $this->data['bal'] = isset($_SESSION['user'])?$this->formatCurrency($_SESSION['user']->balance):''; 
    $this->data['faqs'] = $this->faqs_model->get(['where' => ['disabled' => 0]]);

    $this->load->view('templates/header', $this->data);
    $this->load->view('main/faq');
    $this->load->view('templates/footer');
  }

  public function aboutUs() {
    $this->session->unset_userdata('active');
    $_SESSION['page'] = 'about';

    $this->data['_token'] = base64_encode(base64_encode(config_item('api_token')));
    $this->data['title'] = 'About Us - Clickapay.ng';
    $this->data['bal'] = isset($_SESSION['user'])?$this->formatCurrency($_SESSION['user']->balance):'';

    $this->load->view('templates/header', $this->data);
    $this->load->view('main/about-us');
    $this->load->view('templates/footer');
  }

  public function page404() {
    $this->session->unset_userdata('active');
    $_SESSION['page'] = '404';

    $this->data['_token'] = base64_encode(base64_encode(config_item('api_token')));
    $this->data['title'] = 'Page Not Found - Clickapay.ng';
    $this->data['bal'] = isset($_SESSION['user'])?$this->formatCurrency($_SESSION['user']->balance):'';

    $this->load->view('templates/header', $this->data);
    $this->load->view('main/404');
    $this->load->view('templates/footer');
  }

  public function autoLogin() {
    if (array_key_exists('_r_t', $_COOKIE)) {
      $remember_token = get_cookie('_r_t');

      $user = $this->users_model->getOne(['remember_token' => $remember_token]);
      if (!empty($user)) {
        $user = ['user' => $user];
        $this->session->set_userdata($user);

        //redirect(base_url('/'));
      }
    }
  }

  public function loadUser() {
    $view = $this->uri->segment(2);

    $_SESSION['view'] = $view;
    redirect(base_url('user'));
  }

  public function loadView() {
    $view = $this->uri->segment(2);
    $_SESSION['view'] = $view;

    $data = [
      'tb' => 0,
      'mb' => 0,
      'tc' => 0,
      'mc' => 0,
      'bal' => $this->formatCurrency($_SESSION['user']->balance)
    ];
    
    if($view == 'dashboard') {
      if(!empty($_SESSION['data']['clicks_m'])) {

        $cd = $_SESSION['data']['clicks_d'];
        $cm = $_SESSION['data']['clicks_m'];

        $tb = '';
        $mb = '';
        $tc = count($cd);
        $mc = count($cm);
        $bal = $this->formatCurrency($_SESSION['user']->balance);

        foreach($cd as $c) {
          $tb += $c->paid;
        }
        foreach($cm as $c) {
          $cm += $c->paid;
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

    if($view == 'bank' && $_SESSION['user']->account) {
      $view = 'account';
    }
    $_SESSION['active'] = ($view == 'account') ? 'bank' : $view;
    $content = spa::view($view, $data);
    $this->session->set_userdata(['view'=>($view == 'account') ? 'bank' : $view]);
    
    $res = ['status' => true, 'content' => $content];

    echo json_encode($res);
  }
}

/* End of file Main.php */
