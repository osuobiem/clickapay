<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends Ace_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model(array(
      'users_model',
      'banks_model',
      'userAccounts_model',
      'withdraw_model'
    ));
  }

  public function addAccount() {
    $rules = $this->rules();
    $this->form_validation->set_rules($rules['add-account']);

    if(!$this->form_validation->run()){
      $res = ['status' => false, 'message' => validation_errors()];
      echo json_encode($res);
    }
    else {
      $token = base64_decode(base64_decode($this->input->post('_token')));
      if($this->verifyToken($token, 'api_token')) {
        $acc_name = $this->input->post('account_name');
        $acc_num = $this->input->post('account_number');
        $bank = base64_decode($this->input->post('bank'));

        $opt = [
          'number' => $acc_num,
          'bank_id' => $bank
        ];
        $accs = $this->userAccounts_model->getCount($opt);
        if($accs > 0) {
          $res = ['status' => false, 'message' => 'Account number already exists'];
        }
        else {
          $ac = $this->userAccounts_model->getCount(['user_id' => $_SESSION['user']->id]);
          if($ac > 0) {
            $res = ['status' => false, 'message' => 'You already have a registered <strong>Bank Account</strong>'];
          }
          else {
            $data = array(
              'id' => Random::generate(40),
              'name' => $acc_name,
              'number' => $acc_num,
              'bank_id' => $bank,
              'user_id' => $_SESSION['user']->id
            );

            $acc = $this->userAccounts_model->create($data);
            if($acc) {
              $_SESSION['user']->account = (object)$data;
              $res = ['status' => true, 'message' => 'Success'];
            }
            else {
              $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
            }
          }
        }
        
        echo json_encode($res);
      }
      else {
        http_response_code(400);
        $res = ['status' => false, 'message' => 'Bad Request'];
      }
    }
  }

  public function editAccount() {
    $rules = $this->rules();
    $this->form_validation->set_rules($rules['add-account']);

    if(!$this->form_validation->run()){
      $res = ['status' => false, 'message' => validation_errors()];
      echo json_encode($res);
    }
    else {
      $token = base64_decode(base64_decode($this->input->post('_token')));
      if($this->verifyToken($token, 'api_token')) {
        $acc_name = $this->input->post('account_name');
        $acc_num = $this->input->post('account_number');
        $bank = base64_decode($this->input->post('bank'));

        $opt = [
          'number' => $acc_num,
          'bank_id' => $bank
        ];
        $accs = $this->userAccounts_model->getCount($opt);
        if($accs > 1) {
          $res = ['status' => false, 'message' => 'Account number already exists'];
        }
        else {
          $ac = $this->userAccounts_model->getCount(['user_id' => $_SESSION['user']->id]);
          if($ac < 0) {
            $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
          }
          else {
            $data = array(
              'filter' => [
                'user_id' => $_SESSION['user']->id
              ],
              'data' => [
                'name' => $acc_name,
                'number' => $acc_num,
                'bank_id' => $bank
              ]
            );

            $acc = $this->userAccounts_model->update($data);
            if($acc) {
              $_SESSION['user']->account->name = $data['data']['name'];
              $_SESSION['user']->account->number = $data['data']['number'];
              $_SESSION['user']->account->bank_id = $data['data']['bank_id'];
              $res = ['status' => true, 'message' => 'Success'];
            }
            else {
              $res = ['status' => false, 'message' => '<strong>Oops!</strong> Something went wrong. Please try again'];
            }
          }
        }
        
        echo json_encode($res);
      }
      else {
        http_response_code(400);
        $res = ['status' => false, 'message' => 'Bad Request'];
      }
    }
  }

  public function withdraw() {
    $rules = $this->rules();
    $this->form_validation->set_rules('amount', 'Withdrawal Amount', 'trim|required|xss_clean|min_length[4]|numeric|greater_than_equal_to[1000]');

    if(!$this->form_validation->run()){
      $res = ['status' => false, 'message' => validation_errors()];
      echo json_encode($res);
    }
    else {
      $token = base64_decode(base64_decode($this->input->post('_token')));
      if($this->verifyToken($token, 'api_token')) {
        $amount = $this->input->post('amount');
        if($_SESSION['user']->account) {
          $reqs = $this->withdraw_model->getCount([
            'where' => ['user_id' => $_SESSION['user']->id],
            'like' => ['created_at' => date('Y-m')]
          ]);
          
          if($reqs > 0) {
            $res = ['status' => false, 'message' => 'You have already requested for <strong>Withdrawal</strong> this month'];
          }
          else {
            if($_SESSION['user']->balance < 1000) {
              $res = ['status' => false, 'message' => 'You must earn at least <strong>₦1000</strong> to be eligible for withdrawal'];
            }
            else {
              if(($_SESSION['user']->balance - $amount) < 0) {
                $res = ['status' => false, 'message' => 'You cannot withdraw more than your available balance of <strong>₦'.$this->formatCurrency($_SESSION['user']->balance).'</strong>'];
              }
              else {
                $withdraw = $this->withdraw_model->create(['id' => Random::generate(40), 'amount' => $amount, 'user_id' => $_SESSION['user']->id]);
                if($withdraw) {
                  $sub = $this->users_model->update([
                    'filter' => ['id' => $_SESSION['user']->id],
                    'data' => ['balance' => ($_SESSION['user']->balance - $amount)]
                  ]);
                  if($sub) {
                    $_SESSION['user']->balance = $_SESSION['user']->balance - $amount;
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
            }
          }
        }
        else {
          $res = ['status' => false, 'message' => 'You have not added your bank details'];
        }
      }
      else {
        http_response_code(400);
        $res = ['status' => false, 'message' => 'Bad Request'];
      }

      echo json_encode($res);
    }
  }

  private function rules() {
    return array(
      'add-account' => array(
        array(
          'field' => 'account_name',
          'label' => 'Account Name',
          'rules' => 'trim|required|xss_clean|min_length[3]'
        ),
        array(
          'field' => 'bank',
          'label' => 'Bank',
          'rules' => 'trim|required|xss_clean|min_length[40]'
        ),
        array(
          'field' => 'account_number',
          'label' => 'Account Number',
          'rules' => 'trim|required|xss_clean|min_length[8]|max_length[12]|numeric'
        ),
      ),

    );
  }
}