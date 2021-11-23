<?php
namespace Paw\Controller;

use Paw\AbstractController;
use Paw\Email;
use Paw\Utils;

class EmailController extends AbstractController
{
    public function get($sendResult = false, $err = false)
    {
        $this->addHeader();
        $this->addTemplate('partials/email.phtml', [
            "sendResult" => $sendResult,
            "err" => $err
        ]);
        $this->addFooter();
        return $this->getResponse();
    }

    public function post()
    {
        $sendResult = false;
        $err = false;

        if(isset($_POST['action']) && $_POST['action'] == 'send') {
            if(!isset($_POST['email'])) {
                $err = 'No email specified';
            }
            if(!isset($_POST['paw_address'])) {
                $err = 'No PAW address specified';
            }
            if(!isset($_POST['paw_reward_key'])) {
                $err = 'No reward key specified!';
            }
            if(!isset($_POST['terms'])) {
                $err = 'Please check the vouch checkbox!';
            }
            $dbRewardKey = FALSE;
            if(!$err) {
                $dbRewardKey = $this->getDb()->db_reward_key($_POST['paw_reward_key']);
                if(!$dbRewardKey) {
                    $err = 'Reward Key Not Found';
                } else if($dbRewardKey->disabled) {
                    $err = 'Reward Key Suspended';
                }
            }

            if(!$err) {
                $emailInvited = $this->getDb()->db_email_invited($_POST['email']);
                if($emailInvited) {
                    $err = 'Email got invited already';
                }

            }

            if(!$err) {
                $lastInvite = $this->getDb()->db_last_email_invite($_POST['paw_reward_key']);
                if ($lastInvite && (($lastInvite->time_invited + 60 * 10) > time())) {
                    $err = 'Please wait 10 minutes between invites';
                }
            }

            if(!$err) {
                if(!Utils::validPawAddress($_POST['paw_address'])) {
                    $err = 'Invalid PAW address entered';
                }

            }

            if(!$err) {
                $email = $_POST['email'];
                $address = $_POST['paw_address'];
                $pawRewardKey = $_POST['paw_reward_key'];
                $pickupCode = Utils::randSha1(24);
                $this->getDb()->db_insert_email_invite($email, $pawRewardKey, $pickupCode, $address);

                $inviteeRewardKey = Utils::randSha1(24);
                $this->getDb()->db_insert_reward_key($inviteeRewardKey, $dbRewardKey->id);

                $sendResult = (new Email())->sendEmailInvite($_POST["email"], $inviteeRewardKey, $pickupCode);
            }
        }
        return $this->get($sendResult, $err);
    }
}