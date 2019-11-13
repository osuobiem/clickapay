<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserAccounts_model extends Ace_Model
{

	// Database table name
	protected $table = 'user_accounts';

	public function __construct()
	{
		parent::__construct();
  }
}

/* End of file UserAccounts_model.php */