<?php

namespace Larabot\Chatbot;

use Illuminate\Support\ServiceProvider;

class ChatbotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/chatbot.php', 'chatbot');

        $this->app->singleton('chatbot', function ($app) {
            return new Chatbot($app['config']->get('chatbot'));
        });
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/chatbot.php' => config_path('chatbot.php'),
            ], 'config');

            $this->commands([
                Commands\ChatCommand::class,
            ]);
        }
    }
}