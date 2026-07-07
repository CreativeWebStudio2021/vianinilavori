<?php

namespace App\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require base_path('vendor/autoload.php'); // o il path corretto

class MailHelper
{
    public static function sendMail($from_email, $from_name, $to_email, $to_name, $subject, $body, $attachments = [])
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings
            /*$mail->isSMTP();
            $mail->Host       = "mail.smtp2go.com";
            $mail->SMTPAuth   = true;
            $mail->Username   = "vianinilavori.it";
            $mail->Password   = "yz8DQkVwIMKc4BvB";
            $mail->SMTPSecure = "ssl";
            //$mail->SMTPSecure = ssl;
            $mail->Port       = 465;
			
			$mail->isSMTP();
			$mail->Host = 'smtp.office365.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'web@vianinilavori.it'; // Email completa
			$mail->Password = 'S1t0W3bD!ff1c1l3';
			$mail->SMTPSecure = 'tls'; // STARTTLS
			$mail->Port = 587;*/
			
			$mail->isSMTP();
			$mail->Host       = 'mail.smtp2go.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'vianini';  // es: user@dominio.com o username assegnato
			$mail->Password   = 'iD7XZphOBFBGRFh8';
			$mail->SMTPSecure = 'tls';  // usa 'ssl' se scegli la porta 465
			$mail->Port       = 587;    // oppure 465 con ssl
			
			//$mail->Timeout = 10;
			//$mail->SMTPDebug = 3;
			
			$mail->CharSet = 'UTF-8';
			$mail->Encoding = 'base64';
	
            // Sender and recipient
            $mail->setFrom("web@vianinilavori.it", $from_name);
            $mail->addAddress($to_email, $to_name);

            // Attachments
            foreach ($attachments as $file) {
                $mail->addAttachment($file['path'], $file['name']);
            }

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;
			
            $mail->send();
            return "OK";
        } catch (Exception $e) {
            return "Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
