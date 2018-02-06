<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 06/02/2018
 * Time: 02:29 PM
 */

namespace framework\services;

use League\Plates\Engine;
use PHPMailer\PHPMailer\PHPMailer;

class EmailService
{

    static function SendEmail($templatePath,$templateName,$data,$subject,$recipients,$attachments=[],$replyTo=false,$config  = false)
    {
        $config = (empty($config))?RouteService::CheckConfiguration(true):$config;
        $mail = new PHPMailer(false);
        if(!empty($config["email_smtp_secure"]))
        {
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->SMTPSecure = $config["email_smtp_secure"];
        }

        $mail->Host = $config["email_host"];  // Specify main and backup SMTP servers
        $mail->Username = $config["email_username"];                 // SMTP username
        $mail->Password = $config["email_password"];                           // SMTP password
        $mail->Port = $config["email_port"];                                    // TCP port to connect to

        $mail->setFrom($config["email_address"]);

        foreach ($recipients as $recipient)
        {
            $mail->addAddress($recipient);
        }

        if($replyTo)
        {
            $mail->addReplyTo($replyTo);
        }
        foreach ($attachments as $attachment)
        {
            $mail->addAttachment($attachment);
        }

        $tplEngine = new Engine($templatePath);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body =$tplEngine->render($templateName,$data);

        return $mail->send();

    }
}