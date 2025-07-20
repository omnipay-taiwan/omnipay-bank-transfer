<?php

namespace Omnipay\BankTransfer\Traits;

trait HasBankTransfer
{
    public function getBankCode()
    {
        return $this->getParameter('bank_code');
    }

    public function setBankCode($value)
    {
        return $this->setParameter('bank_code', $value);
    }

    public function getAccountNumber()
    {
        return $this->getParameter('account_number');
    }

    public function setAccountNumber($value)
    {
        return $this->setParameter('account_number', $value);
    }

    public function getSecret()
    {
        return $this->getParameter('secret');
    }

    public function setSecret($value)
    {
        return $this->setParameter('secret', $value);
    }
}
