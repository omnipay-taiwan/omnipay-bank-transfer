<?php

namespace Omnipay\BankTransfer\Message;

use Omnipay\BankTransfer\Hasher;
use Omnipay\BankTransfer\Traits\HasBankTransfer;

class PurchaseRequest extends AbstractRequest
{
    use HasBankTransfer;

    public function getPaymentInfoUrl()
    {
        return $this->getParameter('payment_info_url');
    }

    public function setPaymentInfoUrl($value)
    {
        return $this->setParameter('payment_info_url', $value);
    }

    public function getData()
    {
        $this->validate('transactionId', 'amount', 'payment_info_url');

        return array_filter([
            'bank_code' => $this->getBankCode(),
            'account_number' => $this->getAccountNumber(),
            'transaction_id' => $this->getTransactionId(),
            'amount' => (int) $this->getAmount(),
            'description' => $this->getDescription(),
            'notify_url' => $this->getNotifyUrl(),
            'payment_info_url' => $this->getPaymentInfoUrl(),
        ], function ($value) {
            return $value !== null;
        });
    }

    public function sendData($data)
    {
        $hasher = new Hasher($this->getSecret());
        $data['hash'] = $hasher->make($data);

        return $this->response = new PurchaseResponse($this, $data);
    }
}
