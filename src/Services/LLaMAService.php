<?php

namespace Larabot\Chatbot\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class LLaMAService implements NLPServiceInterface
{
    protected $apiKey;
    protected $client;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client([
            'base_uri' => 'https://api.llama.ai/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getResponse(string $message): ?string
    {
        try {
            $response = $this->client->post('generate', [
                'json' => [
                    'input' => $message,
                    'model' => 'llama',
                ],
            ]);

            $body = json_decode((string) $response->getBody(), true);
            return $body['output'] ?? null;
        } catch (RequestException $e) {
            Log::error('LLaMA API request failed: ' . $e->getMessage());
            return null;
        }
    }
}
