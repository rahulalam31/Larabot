<?php

namespace Larabot\Chatbot\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Support\Facades\Log;

class DialogflowService implements NLPServiceInterface
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api.dialogflow.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getResponse(string $message): ?string
    {
        try {
            $response = $this->client->post('query', [
                'json' => [
                    'query' => $message,
                    'lang' => 'en',
                    'sessionId' => uniqid(),
                ],
            ]);

            $body = json_decode((string) $response->getBody(), true);
            return $body['result']['fulfillment']['speech'] ?? null;
        } catch (RequestException $e) {
            Log::error('Dialogflow API request failed: ' . $e->getMessage());
            return null;
        }
    }

    public function getResponseAsync(string $message): PromiseInterface
    {
        return $this->client->postAsync('query', [
            'json' => [
                'query' => $message,
                'lang' => 'en',
                'sessionId' => uniqid(),
            ],
        ])->then(
            function ($response) {
                $body = json_decode((string) $response->getBody(), true);
                return $body['result']['fulfillment']['speech'] ?? null;
            },
            function (RequestException $e) {
                Log::error('Dialogflow API async request failed: ' . $e->getMessage());
                return null;
            }
        );
    }
}
