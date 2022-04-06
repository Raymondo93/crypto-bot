<?php

namespace Crypto\Exchange\kuCoin;

use Crypto\Exchange\BaseExchange;

class KuCoinExchange extends BaseExchange {

    private string $baseUri = 'https://api.kucoin.com';
    private string $sandboxBaseUri = 'https://openapi-sandbox.kucoin.com';

    public function __construct() {
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getBaseUri(): string {
        return $this->baseUri;
    }

    /**
     * @return string
     */
    public function getSandboxBaseUri(): string {
        return $this->sandboxBaseUri;
    }
}