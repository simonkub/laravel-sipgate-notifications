<?php

namespace SimonKub\Laravel\Notifications\Sipgate;

use Illuminate\Support\Facades\Config;
use Illuminate\Notifications\Notification;
use SimonKub\Laravel\Notifications\Sipgate\Exceptions\CouldNotSendNotification;

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
     * @param  mixed  $notifiable
     * @param  Notification  $notification
     *
     * @throws CouldNotSendNotification
     */
    public function send($notifiable, Notification $notification)
    {
        /** @var SipgateMessage $message */
        $message = $notification->toSipgate($notifiable);

        $this->addRecipient($message, $notifiable);

        $this->addSmsId($message);

        $this->client->send($message);
    }

    /**
     * @param  SipgateMessage  $message
     * @param $notifiable
     * @throws CouldNotSendNotification
     */
    protected function addRecipient(SipgateMessage $message, $notifiable)
    {
        if ($message->getRecipient()) {
            return;
        }

        if ($recipient = $notifiable->routeNotificationFor('sipgate', $notifiable)) {
            $message->recipient($recipient);

            return;
        }

        throw CouldNotSendNotification::noRecipient();
    }

    /**
     * @param  SipgateMessage  $message
     * @throws CouldNotSendNotification
     */
    protected function addSmsId(SipgateMessage $message)
    {
        if ($message->getSmsId()) {
            return;
        }

        if ($smsId = Config::get('services.sipgate.smsId')) {
            $message->smsId($smsId);

            return;
        }

        throw CouldNotSendNotification::noSmsId();
    }
}
