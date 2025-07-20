<?php

namespace Omnipay\BankTransfer\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\BankTransfer\Hasher;
use Omnipay\BankTransfer\Traits\HasBankTransfer;

class GetPaymentInfoRequest extends AbstractRequest
{
    use HasBankTransfer;

    /**
     * @throws InvalidRequestException
     */
    public function getData()
    {
        $data = $this->httpRequest->request->all();
        $hasher = new Hasher($this->getSecret());
        if (! array_key_exists('hash', $data) || ! $hasher->check($data['hash'], $data)) {
            throw new InvalidRequestException('Incorrect Hash');
        }

        return $data;
    }

    public function sendData($data)
    {
        return $this->response = new GetPaymentInfoResponse($this, $data);
    }
}
