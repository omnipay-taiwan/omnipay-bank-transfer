<?php

namespace PHPSTORM_META {

    /** @noinspection PhpIllegalArrayKeyTypeInspection */
    /** @noinspection PhpUnusedLocalVariableInspection */
    $STATIC_METHOD_TYPES = [
      \Omnipay\Omnipay::create('') => [
        'BankTransfer' instanceof \Omnipay\BankTransfer\Gateway,
      ],
      \Omnipay\Common\GatewayFactory::create('') => [
        'BankTransfer' instanceof \Omnipay\BankTransfer\Gateway,
      ],
    ];
}
