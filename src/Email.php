<?php
namespace Paw;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{
    protected $mail;

    public function __construct()
    {
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtppro.zoho.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'paws@paw.digital';                     //SMTP username
        $mail->Password   = '3b53D!2ed4f2';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->setFrom('paws@paw.digital', 'PAW Digital');

        $this->setMail($mail);
    }

    public function sendEmailInvite($email, $inviteeRewardKey, $pickupCode)
    {
        try {
            $this->getMail()->addAddress($email);
            $this->getMail()->isHTML(true);
            $this->getMail()->Subject = 'You have PAW for pickup';
            $this->getMail()->Body    = 'Your Reward Key ' . $inviteeRewardKey . '.<br />Keep this key confidential! The paw reward key allows you to receive more PAW rewards.<br /><br />Pick up your PAW at <a href="https://paw.digital/receive.php?code=' . $pickupCode . '" /><b>https://paw.digital/receive.php?code=' . $pickupCode . '</b></a>';
            $this->getMail()->AltBody = "Your Reward Key ' . $inviteeRewardKey . '.\r\nKeep this key confidential! The paw reward key allows you to receive more PAW rewards.\r\n\r\nPick up your PAW at https://paw.digital/receive.php?code=" . $pickupCode . "";

            $this->getMail()->send();
            $sendResult = 'Message has been sent';
        } catch (\Exception $e) {
            $sendResult = "Message could not be sent. Mailer Error: {$this->getMail()->ErrorInfo}";
        }
        return $sendResult;
    }

    public function getMail()
    {
        return $this->mail;
    }

    public function setMail(PHPMailer $mail)
    {
        $this->mail = $mail;
        return $this;
    }
}