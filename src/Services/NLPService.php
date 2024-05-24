<?php

namespace Larabot\Chatbot\Services;

use GuzzleHttp\Client;

class NLPService
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client();
    }

    public function getResponse($message)
    {
        $response = $this->client->post('https://api.dialogflow.com/v1/query', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'query' => $message,
                'lang' => 'en',
                'sessionId' => uniqid(),
            ],
        ]);

        $body = json_decode((string) $response->getBody(), true);

        return $body['result']['fulfillment']['speech'] ?? null;
    }
}