<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
class Mailer{
	
	function send($email, $subject, $body, $sender, $name = 'User'){
		//parent::__construct();
		/* $this->CI =& get_instance();
		
        $this->CI->load->model('smtp_m');
        
        $config = $this->CI->smtp_m->get_settings(); */

        //if($config->server == "SMTP Server"){
		$mail = new PHPMailer(true);

		try {
			//Server settings
			$mail->SMTPDebug = 0;                                       // Enable verbose debug output
			$mail->isSMTP(); 
			$mail->Host = 'clickapay.com.ng';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = 'no-reply@clickapay.com.ng';                 // SMTP username
			$mail->Password = '';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                               // TCP port to connect to
			//Recipients 
			$mail->setFrom($sender, 'Clickapay');
			$mail->addAddress($email, $name);     // Add a recipient
			
			// Attachments
			//$mail->addAttachment('/var/tmp/file.ta$mail->send()r.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

			// Content
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = $subject;
			$mail->Body    = $body;
			//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			if (!$mail->send()) {
				return false;
			} else {
				return true;
			}
		} catch (Exception $e) {
			//return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			return false;
		}
        //}
    }
}
