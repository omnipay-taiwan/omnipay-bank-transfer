<?php

namespace Omnipay\BankTransfer;

class Hasher
{
    /**
     * @var string
     */
    private $secret;

    public function __construct($secret)
    {
        $this->secret = $secret;
    }

    public function make($data)
    {
        if (array_key_exists('hash', $data)) {
            unset($data['hash']);
        }

        ksort($data);

        return hash_hmac('sha256', http_build_query($data), $this->secret);
    }

    public function check($hash, $data)
    {
        if (array_key_exists('hash', $data)) {
            unset($data['hash']);
        }

        return hash_equals($hash, $this->make($data));
    }
}
