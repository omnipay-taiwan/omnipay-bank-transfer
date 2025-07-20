<?php

namespace Omnipay\BankTransfer\Message;

class GetPaymentInfoResponse extends AbstractResponse
{
    public function isSuccessful()
    {
        return false;
    }
}
