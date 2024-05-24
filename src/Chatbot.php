<?php

namespace Larabot\Chatbot;

use Illuminate\Support\Facades\Cache;
use Larabot\Chatbot\Services\NLPService;

class Chatbot
{
    protected $config;
    protected $nlpService;

    public function __construct(array $config)
    {
        $this->config = $config;
        $this->nlpService = new NLPService($config['api_key']);
    }

    public function respond($message)
    {
        $cacheKey = 'chatbot_response_' . md5($message);

        return Cache::remember($cacheKey, 3600, function () use ($message) {
            $response = $this->nlpService->getResponse($message);
            return $response ?: $this->config['default_response'];
        });
    }
}
