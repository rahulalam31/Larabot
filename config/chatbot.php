<?php


return [
    'default_service' => env('CHATBOT_DEFAULT_SERVICE', 'dialogflow'),
    'dialogflow' => [
        'api_key' => env('DIALOGFLOW_API_KEY', ''),
    ],
    'openai' => [
        'api_key' => env('OPENAI_API_KEY', ''),
        'model' => env('OPENAI_MODEL', 'text-davinci-003'),
    ],
    'llama' => [
        'api_key' => env('LLAMA_API_KEY', ''),
    ],
    'default_response' => 'I am not sure how to respond to that.',
];
