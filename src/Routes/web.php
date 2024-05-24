<?php

use Larabot\Chatbot\Controllers\ChatbotController;

Route::post('/chatbot', [ChatbotController::class, 'chat']);