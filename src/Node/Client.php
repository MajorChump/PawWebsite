<?php
namespace Paw\Node;

use GuzzleHttp\Client as HttpClient;

class Client
{
    protected $client;

    public function __construct()
    {
        $this->setClient(new HttpClient());
    }

    public function send($post)
    {
        try {
            $response = $this->getClient()->post(NODE_ADDRESS, [], [
                "json" => $post
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        return json_decode((string) $response->getBody());
    }

    public function getBalance($account)
    {
        return $this->send([
            "action" => "account_balance",
            "account" => $account
        ]);
    }

    public function getClient()
    {
        return $this->client;
    }

    public function setClient(HttpClient $client)
    {
        $this->client = $client;
        return $this;
    }
}