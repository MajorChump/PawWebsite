<?php
namespace Paw;

use GuzzleHttp\Client;

class DistributorClient
{
    protected $client;

    public function __construct()
    {
        $this->setClient(new Client());
    }

    public function send($post)
    {
        try {
            $response = $this->getClient()->post(API_DISTRIBUTOR, [], [
                "json" => $post
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return json_decode((string) $response->getBody());
    }

    public function sendEmailReward($address, $reference, $target, $additional_data = '')
    {
        return $this->send([
            "action" => "insertReward",
            "target" => $target,
            "address" => $address,
            "reference" => $reference,
            "platform" => 1,
            "additional_data" => str_replace('"', '\"', $additional_data),
            "auth" => API_DISTRIBUTOR_KEY
        ]);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
        return $this;
    }
}