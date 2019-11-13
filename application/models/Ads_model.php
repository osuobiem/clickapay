<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ads_model extends Ace_Model {

  // Database table name
  protected $table = 'ads';

  public function __construct()
  {
      parent::__construct();
  }

  public function provider() {
    $foreign = [
        'parent' => 'providers',
        'foreign_key' => 'id'
    ];

    return $this->belongsTo($foreign);
  }
}

/* End of file Ads_model.php */
