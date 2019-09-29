<?php

namespace Simonkub\Laravel\Notifications\Sipgate;

use Illuminate\Notifications\Notification;
use Simonkub\Laravel\Notifications\Sipgate\Exceptions\CouldNotSendNotification;

class SipgateChannel
{
    /**
     * @var SipgateClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $smsId;

    public function __construct(SipgateClient $client, string $smsId)
    {
        $this->client = $client;
        $this->smsId = $smsId;
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
     */
    protected function addSmsId(SipgateMessage $message)
    {
        if ($message->getSmsId()) {
            return;
        }

        $message->smsId($this->smsId);
    }
}
