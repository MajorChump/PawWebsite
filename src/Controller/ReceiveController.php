<?php
namespace Paw\Controller;

use Paw\AbstractController;
use Paw\Client;
use Paw\Utils;

class ReceiveController extends AbstractController
{
    public function get($pickedUp = false, $err = false, $emailInvite = false)
    {
        $this->addHeader();
        $this->addTemplate('partials/receive.phtml', [
            "pickedUp" => $pickedUp,
            "err" => $err,
            "emailInvite" => $emailInvite
        ]);
        $this->addFooter();
        return $this->getResponse();
    }

    public function post()
    {
        $pickedUp = false;
        $err = false;
        $emailInvite = false;

        if(!isset($_GET['code'])) {
            $err = 'The link you followed does not contain a code to pick up PAW';
        }

        if(!$err) {
            $emailInvite = $this->getDb()->db_get_email_invite($_GET['code']);
            if(!$emailInvite) {
                $err = 'The pickup code in the link given to you does not exist';
            }
        }

        if(isset($_POST['action']) && $_POST['action'] == 'receive') {
            if(!isset($_POST['paw_address'])) {
                $err = 'No PAW address specified';
            }

            if(!$err) {
                if(!Utils::validPawAddress($_POST['paw_address'])) {
                    $err = 'Invalid PAW address entered';
                }
            }

            if(!$err) {
                $client = new \Paw\Distributor\Client();
                $client->sendEmailReward($emailInvite->inviter_address, $_POST['paw_address'], 0, '{"invite_id":"'.$emailInvite->id.'"}');
                $client->sendEmailReward($_POST['paw_address'], $emailInvite->inviter_address, 1, '{"invite_id":"'.$emailInvite->id.'"}');
                $this->getDb()->db_set_email_picked_up($emailInvite->id, $_POST['paw_address']);
                $pickedUp = true;
            }
        }

        return $this->get($pickedUp, $err, $emailInvite);
    }
}