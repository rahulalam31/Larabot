<?php

namespace Larabot\Chatbot\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Larabot\Chatbot\Chatbot;

class ChatbotController extends Controller
{
    protected $chatbot;

    public function __construct(Chatbot $chatbot)
    {
        $this->chatbot = $chatbot;
    }

    public function chat(Request $request)
    {
        $message = $request->input('message');
        $response = $this->chatbot->respond($message);

        return response()->json(['response' => $response]);
    }
}