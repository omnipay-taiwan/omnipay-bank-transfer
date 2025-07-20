<?php

namespace Omnipay\BankTransfer\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Common\Message\NotificationInterface;
use Omnipay\BankTransfer\Hasher;
use Omnipay\BankTransfer\Traits\HasBankTransfer;

class AcceptNotificationRequest extends AbstractRequest implements NotificationInterface
{
    use HasBankTransfer;

    /**
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $data = $this->httpRequest->request->all();

        $validate = ['transaction_id', 'account_number', 'amount', 'created_at', 'hash'];
        foreach ($validate as $key) {
            if (! array_key_exists($key, $data)) {
                throw new InvalidRequestException("The $key parameter is required");
            }
        }

        $hasher = new Hasher($this->getSecret());
        if (! array_key_exists('hash', $data) || ! $hasher->check($data['hash'], $data)) {
            throw new InvalidRequestException('Incorrect Hash');
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new AcceptNotificationResponse($this, $data);
    }

    public function getTransactionId()
    {
        return $this->getNotificationResponse()->getTransactionId();
    }

    public function getTransactionReference()
    {
        return $this->getNotificationResponse()->getTransactionReference();
    }

    public function getTransactionStatus()
    {
        return $this->getNotificationResponse()->getTransactionStatus();
    }

    public function getMessage()
    {
        return $this->getNotificationResponse()->getMessage();
    }

    public function getReply()
    {
        return $this->getNotificationResponse()->getReply();
    }

    /**
     * @return AcceptNotificationResponse
     */
    private function getNotificationResponse()
    {
        return ! $this->response ? $this->send() : $this->response;
    }
}
