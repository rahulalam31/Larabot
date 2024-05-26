<?php

namespace Larabot\Chatbot\Services;

interface NLPServiceInterface
{
    public function getResponse(string $message): ?string;
}
