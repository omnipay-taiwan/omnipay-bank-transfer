<?php

namespace Omnipay\BankTransfer;

use Omnipay\Common\AbstractGateway;
use Omnipay\BankTransfer\Message\AcceptNotificationRequest;
use Omnipay\BankTransfer\Message\GetPaymentInfoRequest;
use Omnipay\BankTransfer\Message\PurchaseRequest;
use Omnipay\BankTransfer\Traits\HasBankTransfer;

class Gateway extends AbstractGateway
{
    use HasBankTransfer;

    public function getName()
    {
        return 'BankTransfer';
    }

    public function getDefaultParameters()
    {
        return [
            'bank_code' => '',
            'account_number' => '',
            'secret' => '',
            'testMode' => false,
        ];
    }

    public function purchase(array $options = [])
    {
        return $this->createRequest(PurchaseRequest::class, $options);
    }

    public function acceptNotification(array $options = [])
    {
        return $this->createRequest(AcceptNotificationRequest::class, $options);
    }

    public function getPaymentInfo(array $options = [])
    {
        return $this->createRequest(GetPaymentInfoRequest::class, $options);
    }
}
