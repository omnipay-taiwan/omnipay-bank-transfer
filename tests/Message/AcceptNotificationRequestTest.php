<?php

namespace Omnipay\BankTransfer\Tests\Message;

use Omnipay\Common\Message\NotificationInterface;
use Omnipay\Tests\TestCase;
use Omnipay\BankTransfer\Hasher;
use Omnipay\BankTransfer\Message\AcceptNotificationRequest;

class AcceptNotificationRequestTest extends TestCase
{
    public function testGetData()
    {
        $data = [
            'transaction_id' => 'A12345678',
            'account_number' => '0000711111111111',
            'amount' => '1000',
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $hasher = new Hasher('secret_key');
        $data['hash'] = $hasher->make($data);

        $httpRequest = $this->getHttpRequest();
        $httpRequest->request->add($data);
        $request = new AcceptNotificationRequest($this->getHttpClient(), $httpRequest);
        $request->initialize([
            'bank_code' => '000',
            'account_number' => '123456789',
            'secret' => 'secret_key',
        ]);

        self::assertEquals('A12345678', $request->getTransactionId());
        self::assertEquals(NotificationInterface::STATUS_COMPLETED, $request->getTransactionStatus());
        self::assertEquals('OK', $request->getReply());
    }
}
