<?php

namespace Notifications;

include "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class Email
{

    CONST USERNAME = 'weryfikacja@wielton.com.pl';

    CONST NAME = 'Weryfikacja Dostawców';
    private PHPMailer $mail;

    public function __construct()
    {
        $env = parse_ini_file('env-dev');
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = $env['SMTP_HOST'] ;
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->CharSet = 'UTF-8';  //not important
        $this->mail->isSMTP(); //important
        $this->mail->Username   = $env['SMTP_USER'];                     //SMTP username
        $this->mail->Password   = $env['SMTP_PASSWORD'];                               //SMTP password
        $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $this->mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $this->mail->SMTPSecure = 'tls'; //important
        $this->mail->SMTPAutoTLS = true;
    }

    public function sendEmail(string $toAddress, string $subject, string $body, string $toName='')
    {
        $this->mail->setFrom(self::USERNAME, self::NAME);
        $this->mail->addAddress($toAddress, $toName);     //Add a recipient


        //Content
        $this->mail->isHTML(true);                                  //Set email format to HTML
        $this->mail->Subject = $subject;
        $this->mail->Body    = $body ;

        $this->mail->send();
        $this->mail->clearAllRecipients();


    }
}