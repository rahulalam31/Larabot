<?php

namespace Larabot\Chatbot\Services;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;

class NLPService
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = $this->createClient();
    }


    protected function createClient()
    {
        $stack = HandlerStack::create();
        $stack->push(Middleware::retry(function ($retries) {
            return $retries < 3;
        }));

        return new Client([
            'handler' => $stack,
            'base_uri' => 'https://api.dialogflow.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'timeout' => 2.0,
            'connect_timeout' => 2.0,
        ]);
    }

    public function getResponse($message)
    {
        $response = $this->client->post('query', [
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