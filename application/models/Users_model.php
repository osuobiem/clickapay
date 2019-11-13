<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends Ace_Model
{

	// Database table name
	protected $table = 'users';

	public function __construct()
	{
		parent::__construct();
	}

	public function login($email_phone, $password)
	{
		if(filter_var($email_phone, FILTER_VALIDATE_EMAIL)) {
			$user_array = ['email' => $email_phone, 'disabled' => 0];
		}
		else {
			$user_array = ['phone' => $email_phone, 'disabled' => 0];
		}
		$user_array['password'] = $password;
		$user = $this->getOne($user_array, 'id');

		return !empty($user) > 0 ? $user : false;
	}

	public function account() {
    $relation = [
      'friend' => 'user_accounts',
      'foreign_key' => 'user_id'
    ];
		
    return $this->hasOne($relation);
  }
}

/* End of file Users_model.php */