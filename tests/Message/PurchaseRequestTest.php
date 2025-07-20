<?php

namespace Omnipay\BankTransfer\Tests\Message;

use Omnipay\Tests\TestCase;
use Omnipay\BankTransfer\Message\PurchaseRequest;

class PurchaseRequestTest extends TestCase
{
    public function testGetData()
    {
        $request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $request->initialize(array_merge([
            'bank_code' => '000',
            'account_number' => '123456789',
            'secret' => 'secret_key',
        ], [
            'transaction_id' => '123456',
            'amount' => 100,
            'return_url' => 'https://foo.bar/return',
            'notify_url' => 'https://foo.bar/notify',
            'payment_info_url' => 'https://foo.bar/payment-info',
        ]));

        $response = $request->send();

        self::assertFalse($response->isSuccessful());
        self::assertTrue($response->isRedirect());
        self::assertEquals('https://foo.bar/payment-info', $response->getRedirectUrl());
        self::assertEquals('POST', $response->getRedirectMethod());
        self::assertEquals([
            'bank_code' => '000',
            'account_number' => '123456789',
            'transaction_id' => '123456',
            'amount' => 100,
            'notify_url' => 'https://foo.bar/notify',
            'payment_info_url' => 'https://foo.bar/payment-info',
            'hash' => '15b2a636fbd449173288749071ba4a38d885fcbb54d82cffccf06088e21474ec',
        ], $response->getRedirectData());
    }
}
