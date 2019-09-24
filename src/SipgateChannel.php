<?php

namespace SimonKub\Laravel\Notifications\Sipgate;

use Illuminate\Notifications\Notification;

class SipgateChannel
{
    /**
     * @var SipgateClient
     */
    protected $client;

    public function __construct(SipgateClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     *
     * @throws \SimonKub\Laravel\Notifications\Sipgate\Exceptions\CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var SipgateMessage $message */
        $message = $notification->toSipgate($notifiable);
        $message->setRecipient($notifiable->phone_number)->setSmsId('s9');

        $this->client->send($message);
    }
}
