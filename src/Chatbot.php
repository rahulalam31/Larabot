<?php

namespace Larabot\Chatbot;

use YourNamespace\Chatbot\Services\NLPService;

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
        $response = $this->nlpService->getResponse($message);

        return $response ?: $this->config['default_response'];
    }
}