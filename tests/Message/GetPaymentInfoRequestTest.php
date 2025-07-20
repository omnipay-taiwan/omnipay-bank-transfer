<?php

namespace Omnipay\BankTransfer\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\BankTransfer\Message\GetPaymentInfoRequest;

class GetPaymentInfoRequestTest extends TestCase
{
    public function testGetData()
    {
        $request = new GetPaymentInfoRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->getHttpRequest()->request->add([
            'bank_code' => '000',
            'account_number' => '123456789',
            'transaction_id' => '123456',
            'amount' => 100,
            'notify_url' => 'https://foo.bar/notify',
            'payment_info_url' => 'https://foo.bar/payment-info',
            'hash' => '15b2a636fbd449173288749071ba4a38d885fcbb54d82cffccf06088e21474ec',
        ]);
        $request->initialize([
            'bank_code' => '000',
            'account_number' => '123456789',
            'secret' => 'secret_key',
        ]);

        $response = $request->send();

        self::assertFalse($response->isSuccessful());
        self::assertEquals([
            'bank_code' => '000',
            'account_number' => '123456789',
            'transaction_id' => '123456',
            'amount' => 100,
            'notify_url' => 'https://foo.bar/notify',
            'payment_info_url' => 'https://foo.bar/payment-info',
            'hash' => '15b2a636fbd449173288749071ba4a38d885fcbb54d82cffccf06088e21474ec',
        ], $response->getData());
    }
}
