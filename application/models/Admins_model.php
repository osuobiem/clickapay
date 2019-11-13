<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admins_model extends Ace_Model {

  // Database table name
  protected $table = 'admins';

  public function __construct()
  {
      parent::__construct();
  }

  public function login($username, $password)
  {
    $admin_array = ['username' => $username, 'password' => $password];
    $admin = $this->getOne($admin_array);

    return !empty($admin) > 0 ? $admin : false;
  }

}

/* End of file Admins_model.php */
