<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Passwords_model extends Ace_Model {

  // Database table name
  protected $table = 'password_resets';

  public function __construct()
  {
    parent::__construct();
  }

}
