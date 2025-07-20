<?php

namespace Omnipay\BankTransfer\Tests;

use Omnipay\BankTransfer\Hasher;
use PHPUnit\Framework\TestCase;

class HasherTest extends TestCase
{
    public function testMakeHash()
    {
        $hasher = new Hasher('123456789');
        $data = ['bank_code' => '000', 'account_number' => '123456789'];
        $hash = $hasher->make($data);

        self::assertEquals('4b5b6b67525d541994fff0e858114c24c9192014d2ffb277cfc02a3a7a997519', $hash);
        self::assertTrue($hasher->check($hash, $data));
    }
}
