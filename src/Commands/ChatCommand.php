<?php

namespace Larabot\Chatbot\Commands;

use Illuminate\Console\Command;
use Larabot\Chatbot\Chatbot;

class ChatCommand extends Command
{
    protected $signature = 'chatbot:chat {message}';
    protected $description = 'Chat with the chatbot';

    protected $chatbot;

    public function __construct(Chatbot $chatbot)
    {
        parent::__construct();
        $this->chatbot = $chatbot;
    }

    public function handle()
    {
        $message = $this->argument('message');
        $response = $this->chatbot->respond($message);
        $this->info($response);
    }
}