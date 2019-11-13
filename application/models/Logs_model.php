<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logs_model extends Ace_Model {

  // Database table name
  protected $table = 'click_log';

  public function __construct()
  {
    parent::__construct();
  }

}
