<?php

namespace Omnipay\BankTransfer\Message;

use Omnipay\Common\Message\NotificationInterface;

class AcceptNotificationResponse extends AbstractResponse implements NotificationInterface
{
    public function isSuccessful()
    {
        return true;
    }

    public function getTransactionId()
    {
        return $this->data['transaction_id'];
    }

    public function getTransactionStatus()
    {
        return self::STATUS_COMPLETED;
    }

    public function getReply()
    {
        return 'OK';
    }
}
