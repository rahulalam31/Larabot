<?php

namespace Larabot\Chatbot;

use Illuminate\Support\Facades\Cache;
use Larabot\Chatbot\Services\NLPService;
use Larabot\Chatbot\Services\NLPServiceInterface;
use Larabot\Chatbot\Services\DialogflowService;
use Larabot\Chatbot\Services\OpenAIService;
use Larabot\Chatbot\Services\LLaMAService;

class Chatbot
{
    protected $config;
    protected $nlpService;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->nlpService = new NLPService($config['api_key']);
    }

    protected function createNLPService(string $service): NLPServiceInterface
    {
        switch ($service) {
            case 'openai':
                return new OpenAIService($this->config['openai']['api_key'], $this->config['openai']['model']);
            case 'llama':
                return new LLaMAService($this->config['llama']['api_key']);
            case 'dialogflow':
            default:
                return new DialogflowService($this->config['dialogflow']['api_key']);
        }
    }

    public function respond($message)
    {
        $cacheKey = 'chatbot_response_' . md5($message);

        return Cache::remember($cacheKey, 3600, function () use ($message) {
            return $this->nlpService->getResponse($message) ?: $this->config['default_response'];
        });
    }

    public function respondAsync($message)
    {
        $cacheKey = 'chatbot_response_' . md5($message);

        return Cache::remember($cacheKey, 3600, function () use ($message) {
            $promise = $this->nlpService->getResponseAsync($message);
            $promise->then(
                function ($response) {
                    return $response ?: $this->config['default_response'];
                },
                function ($exception) {
                    Log::error('Async NLP service request failed: ' . $exception->getMessage());
                    return $this->config['default_response'];
                }
            );

            return $promise;
        });
    }
}
