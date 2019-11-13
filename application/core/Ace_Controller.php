<?php


/**
 * Ace_Controller Class
 * 
 * Controller layer to house needed libraries,
 * helpers, and custom functions to be used
 * by child controllers.
 * 
 * @package Clickapay
 * @author  Gabriel Osuobiem <osuobiem@gmail.com>
 * @link https://github.com/osuobiem
 * @link https://www.linkedin.com/in/gabriel-osuobiem-b22577176/
 */

defined('BASEPATH') OR exit('No direct script access allowed');

class Ace_Controller extends CI_Controller {

  public function __construct() {
		parent::__construct();
		$this->data['errors'] = array();
		$this->load->helper('security');
    $this->load->helper('form');
    $this->load->helper('url');
    $this->load->helper('cookie');
    $this->load->helper('spa_helper');

    $this->load->library('Random');
    $this->load->library('Mailer');
    $this->load->library('session');
    $this->load->library('form_validation');
	}

	/**
   * Data Dump
   * 
	 * Dump variable data and kill script
   * 
	 * @param mixed $var  Variable to dump
   * 
   * @return void
	 */
	public static function dd($var) {
		var_dump($var); die;
	}

  /**
   * Hash String
   * 
   * Hash a supplied string using the hash()
   * function and a salt specified in
   * config/config.php
   * 
   * @param string $string  String to be hashed
   * 
   * @return string   Hashed string
   */
  public function hash($string) {
		return hash("sha512", $string . config_item("encryption_key"));
  }

  /**
   * Session Checker
   * 
   * Check for the existence of a session
   * and redirect to a specified url if
   * the check test fails.
   * 
   * @param string $session           Session key to check for
   * @param string $redirect_url      Redirect url if the check fails
   * @param bool (optional) $reverse  If session exist then redirect
   * 
   * @return void
   */
  public function sech($session, $redirect_url, $reverse = false) {
    $redirect_url = base_url($redirect_url);

    $check = isset($_SESSION[$session]);
    
    if(!$check && !$reverse) {
      $this->session->set_userdata(['action'=>'login']);
      redirect($redirect_url);
    }
    elseif($check && $reverse) {
      redirect($redirect_url);
    }
  }

	public function verifyToken($token) {
		return config_item('api_token') == $token ? true : false;
  }
  
  public function formatCurrency($amount) {
    if(strlen($amount) < 5) {
      return $amount;
    }
    elseif(strlen($amount) == 5) {
      $a = substr($amount, 0, 2);
      $b = substr($amount, 2);
      return $a.','.$b;
    }
    elseif(strlen($amount) == 6) {
      $a = substr($amount, 0, 3);
      $b = substr($amount, 3);
      return $a.','.$b;
    }
    elseif(strlen($amount) == 7) {
      $a = substr($amount, 0, 1);
      $b = substr($amount, 1, 3);
      $c = substr($amount, 4);
      return $a.','.$b.','.$c;
    }
    elseif(strlen($amount) == 8) {
      $a = substr($amount, 0, 2);
      $b = substr($amount, 2, 3);
      $c = substr($amount, 5);
      return $a.','.$b.','.$c;
    }
  }

  // Load email teamplate body
	public function template($page, $data){
    switch ($page) {
      case 'register':
        return '<!DOCTYPE html>
                  <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                  <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="x-apple-disable-message-reformatting">
                    <title>Welcome - Clickapay</title>
                    
                    <style>
                      html,
                      body {
                        margin: 0 auto !important;
                        padding: 0 !important;
                        height: 100% !important;
                        width: 100% !important;
                        font-family: "Poppins", sans-serif !important;
                        font-size: 14px;
                        margin-bottom: 10px;
                        line-height: 22px;
                        color:#558b2fd9;
                        font-weight: 400;
                      }
                      * {
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                        margin: 0;
                        padding: 0;
                      }
                      table,
                      td {
                        mso-table-lspace: 0pt !important;
                        mso-table-rspace: 0pt !important;
                      }
                      table {
                        border-spacing: 0 !important;
                        border-collapse: collapse !important;
                        table-layout: fixed !important;
                        margin: 0 auto !important;
                        background-color: #6e6e6e12;
                      }
                      table table table {
                        table-layout: auto;
                      }
                      a {
                        text-decoration: none;
                      }
                      img {
                        -ms-interpolation-mode:bicubic;
                      }
                    </style>

                  </head>

                  <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #fffffff5;">
                    <center style="width: 100%; background-color: #fafafab0;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#eaf3fc">
                        <tr>
                          <td>
                            <table
                              style="width:100%;max-width:620px;background-color:#ffffff;border-bottom:4px solid #558b2fd9;">
                              <tbody>
                                <tr>
                                  <td style="text-align: center; padding: 25px 0">
                                    <a href="https://clickapay.com.ng"><img style="height:50px"
                                        src="clickapay.com.ng/assets/img/cp-logo-full.png"></a>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding: 30px 30px 15px 30px;">
                                    <h2 style="font-size: 18px; color: #558b2fd9; font-weight: 600; margin: 0;">Welcome to Clickapay</h2>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding: 0 30px 20px">
                                    <p style="margin-bottom: 10px;">Hello '.$data['name'].',</p>
                                    <p style="margin-bottom: 25px;">You have started your journey to getting rich off the internet.
                                      <br>Success is a few clicks away.
                                      </p>
                                    <a href="www.clickapay.com.ng"
                                      style="background-color:#558b2fd9; border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 30px">Start Earning</a>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding: 20px 30px 40px">
                                    <p>You received this email because an account was registered on <a
                                        href="https://www.clickapay.com.ng">Clickapay</a>
                                      using the address '.$data['email'].'</p>
                                    <p style="margin: 0; font-size: 13px; line-height: 22px; color:#080a088e;">
                                      Please do not reply to this email. For support please contact us at
                                      <a href="mailto:support@clickapay.com.ng">support@clickapay.com.ng</a></p>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table style="width:100%;max-width:620px;margin:0 auto; background: inherit;">
                              <tbody>
                                <tr>
                                  <td style="text-align: center; padding:25px 20px">
                                    <p style="font-size: 13px; color: #0000009a">Copyright © '.date('Y').' Clickapay.
                                    </p>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </center>
                  </body>
                </html>';
        break;
      
      case 'password':
        return '<!DOCTYPE html>
                  <html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
                  <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="x-apple-disable-message-reformatting">
                    <title>Password Reset - Clickapay</title>
                    
                    <style>
                      html,
                      body {
                        margin: 0 auto !important;
                        padding: 0 !important;
                        height: 100% !important;
                        width: 100% !important;
                        font-family: "Poppins", sans-serif !important;
                        font-size: 14px;
                        margin-bottom: 10px;
                        line-height: 22px;
                        color:#558b2fd9;
                        font-weight: 400;
                      }
                      * {
                        -ms-text-size-adjust: 100%;
                        -webkit-text-size-adjust: 100%;
                        margin: 0;
                        padding: 0;
                      }
                      table,
                      td {
                        mso-table-lspace: 0pt !important;
                        mso-table-rspace: 0pt !important;
                      }
                      table {
                        border-spacing: 0 !important;
                        border-collapse: collapse !important;
                        table-layout: fixed !important;
                        margin: 0 auto !important;
                        background-color: #6e6e6e12;
                      }
                      table table table {
                        table-layout: auto;
                      }
                      a {
                        text-decoration: none;
                      }
                      img {
                        -ms-interpolation-mode:bicubic;
                      }
                    </style>

                  </head>

                  <body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #fffffff5;">
                    <center style="width: 100%; background-color: #fafafab0;">
                      <table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#eaf3fc">
                        <tr>
                          <td>
                            <table
                              style="width:100%;max-width:620px;background-color:#ffffff;border-bottom:4px solid #558b2fd9;">
                              <tbody>
                                <tr>
                                  <td style="text-align: center; padding: 25px 0">
                                    <a href="https://clickapay.com.ng"><img style="height:50px"
                                        src="clickapay.com.ng/assets/img/cp-logo-full.png"></a>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding: 30px 30px 15px 30px;">
                                    <h2 style="font-size: 18px; color: #558b2fd9; font-weight: 600; margin: 0;">Reset Your Password</h2>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding: 0 30px 20px">
                                    <p style="margin-bottom: 10px;">Hello '.$data['email'].',</p>
                                    <p style="margin-bottom: 25px;">Click on the button/link below to reset your password.</p>
                                    <p style="margin-bottom: 25px;">Once you reset your password, be sure to keep it secure. Never reveal your password to anyone.</p>
                                    <a href="'.$data['link'].'"
                                      style="background-color:#558b2fd9; border-radius:4px;color:#ffffff;display:inline-block;font-size:13px;font-weight:600;line-height:44px;text-align:center;text-decoration:none;text-transform: uppercase; padding: 0 30px">Reset Password
                                </tr>
                                <tr>
                                  <td style="padding: 0 30px">
                                    <h4 style="font-size: 15px; color: #000000; font-weight: 600; margin: 0; text-transform: uppercase; margin-bottom: 10px">or</h4>
                                    <p style="margin-bottom: 10px;">If the button above does not work, paste this link in your web browser:</p>
                                    <a href="'.$data['link'].'"
                                      style="color: #558b2fd9; text-decoration:none;word-break: break-all;">'.$data['link'].'</a>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding: 20px 30px 40px">
                                    <p>If you did not make this request, please contact us or ignore this message.</p>
                                    <p style="margin: 0; font-size: 13px; line-height: 22px; color:#080a088e;">This is an
                                      automatically generated email please do not reply. If you face any
                                      issues, please contact us at <a
                                        href="mailto:support@clickapay.com.ng">support@clickapay.com.ng</a></p>
                                      <p style="margin: 0; font-size: 13px; line-height: 22px; color:#080a088e;">
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                            <table style="width:100%;max-width:620px;margin:0 auto; background: inherit;">
                              <tbody>
                                <tr>
                                  <td style="text-align: center; padding:25px 20px">
                                    <p style="font-size: 13px; color: #0000009a">Copyright © '.date('Y').' Clickapay.
                                    </p>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </center>
                  </body>
                </html>';
        break;
      default:
        # code...
        break;
    }
  }
	
}

/* End of file Ace_Controller.php */