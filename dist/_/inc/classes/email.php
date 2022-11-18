<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email {
	
	public static function init() {

		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->Host = $_ENV['MAIL_HOST'];
		$mail->SMTPAuth = true;
		$mail->Port = $_ENV['MAIL_PORT'];
		$mail->Username = $_ENV['MAIL_USERNAME'];
		$mail->Password = $_ENV['MAIL_PASSWORD'];
		$mail->FromName = $_ENV['MAIL_FROM_NAME'];
		$mail->From = $_ENV['MAIL_FROM_ADDRESS'];
		$mail->isHTML(true);
	    
	    return $mail;
	}

	public static function sendEmail($email, $name, $subject, $message, $files = []) {

		$mail = self::init();

		$mail->AddAddress($email, $name);
	    $mail->Subject = $subject;
	    $mail->Body = $message;

	    if (!empty($files)) {

	    	foreach ($files as $file) {
		    
		    	$mail->addAttachment($file);
		    }
	    }

	    $mail->Send();
	
	}


	public static function logEmail($customer_id, $email_id, $order_no, $email_to) {

		$sql = "INSERT INTO customer_emails (customer_id, email_id, order_no, email_to) VALUES (?, ?, ?, ?)";
		DB::run($sql, [$customer_id, $email_id, $order_no, $email_to]);

	}



	public static function all() {

		return DB::run('SELECT * FROM emails');
	}

	public static function get($id) {

		return DB::run('SELECT * FROM emails WHERE id = ?', [$id])->fetch();
	}

	public static function getTemplate($id, $replace = false) {

		$template = self::get($id);

		return [
			'body' => self::replaceVars($template['body'], $replace),
			'subject' => self::replaceVars($template['subject'], $replace)
		];
	}

	public static function replaceVars($text, $replace) {

		if (!empty($replace)) {

			foreach ($replace as $key => $val) {

				$text = str_replace('['.$key.']', $val, $text);
			}
		}
		
		return $text;
	}
}