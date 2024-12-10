<?php

namespace Notifications;

include "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email
{
    CONST HOST = 'smtp.office365.com';
    CONST USERNAME = 'weryfikacja@wielton.com.pl';
    CONST PASSWORD = '33XX14X1aW';
    CONST NAME = 'Weryfikacja Dostawców';
    private PHPMailer $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
        $this->mail->isSMTP();                                            //Send using SMTP
        $this->mail->Host       = self::HOST ;
        $this->mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $this->mail->CharSet = 'UTF-8';  //not important
        $this->mail->isSMTP(); //important
        $this->mail->Username   = self::USERNAME;                     //SMTP username
        $this->mail->Password   = self::PASSWORD;                               //SMTP password
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