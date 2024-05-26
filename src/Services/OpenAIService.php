<?php

namespace Larabot\Chatbot\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;

class OpenAIService implements NLPServiceInterface
{
    protected $apiKey;
    protected $model;
    protected $client;

    public function __construct($apiKey, $model)
    {
        $this->apiKey = $apiKey;
        $this->model = $model;
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/',
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);
    }

    public function getResponse(string $message): ?string
    {
        try {
            $response = $this->client->post('completions', [
                'json' => [
                    'model' => $this->model,
                    'prompt' => $message,
                    'max_tokens' => 150,
                ],
            ]);

            $body = json_decode((string) $response->getBody(), true);
            return $body['choices'][0]['text'] ?? null;
        } catch (RequestException $e) {
            Log::error('OpenAI API request failed: ' . $e->getMessage());
            return null;
        }
    }
}
