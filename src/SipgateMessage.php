<?php

namespace SimonKub\Laravel\Notifications\Sipgate;

use Illuminate\Contracts\Support\Arrayable;

class SipgateMessage implements Arrayable
{
    protected $smsId;
    protected $message;
    protected $recipient;
    protected $sendAt;

    public function __construct($message = '', $smsId = '', $recipient = '', $sendAt = null)
    {
        $this->message = $message;
        $this->smsId = $smsId;
        $this->recipient = $recipient;
        $this->sendAt = $sendAt;
    }

    /**
     * @return string
     */
    public function getSmsId()
    {
        return $this->smsId;
    }

    /**
     * @param  string  $smsId
     *
     * @return SipgateMessage
     */
    public function setSmsId(string $smsId)
    {
        $this->smsId = $smsId;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param  string  $message
     * @return SipgateMessage
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * @return string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @param  string  $recipient
     * @return SipgateMessage
     */
    public function setRecipient(string $recipient)
    {
        $this->recipient = $recipient;

        return $this;
    }

    /**
     * @return int | null
     */
    public function getSendAt()
    {
        return $this->sendAt;
    }

    /**
     * @param  int  $sendAt
     * @return SipgateMessage
     */
    public function setSendAt($sendAt)
    {
        $this->sendAt = $sendAt;

        return $this;
    }

    public function toArray()
    {
        return [
            "smsId" => $this->smsId,
            "message" => $this->message,
            "recipient" => $this->recipient,
            "sendAt" => $this->sendAt
        ];
    }
}
