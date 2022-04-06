<?php

namespace Crypto\Exchange;

use Crypto\Exchange\kuCoin\KuCoinExchange;

class ExchangeFactory
{
    public static function getExchange($exchangeName) {
        switch(strtolower($exchangeName)) {
            case 'kucoin': return new KuCoinExchange();
        }
    }
}