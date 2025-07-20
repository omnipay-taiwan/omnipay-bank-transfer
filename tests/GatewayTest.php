<?php

namespace Omnipay\BankTransfer\Tests;

use Omnipay\Tests\GatewayTestCase;
use Omnipay\BankTransfer\Gateway;

class GatewayTest extends GatewayTestCase
{
    /** @var Gateway */
    protected $gateway;

    protected function setUp(): void
    {
        parent::setUp();

        $this->markTestSkipped();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->options = [
            'amount' => '10.00',
            'card' => $this->getValidCard(),
        ];
    }

    public function testPurchase() {}
}
