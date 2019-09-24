<?php

namespace SimonKub\Laravel\Notifications\Sipgate;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Log;

class SipgateClient
{
    /**
     * @var HttpClient
     */
    protected $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    public function send(SipgateMessage $message)
    {
        $response = $this->http->post('sessions/sms', ['json' => $message->toArray()]);

        Log::debug($response->getBody());
        Log::debug($response->getStatusCode());
    }
}
