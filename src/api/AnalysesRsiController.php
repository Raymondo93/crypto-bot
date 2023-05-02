<?php

namespace Crypto\api;


use Crypto\Analysis\indicators\rsi\RelativeStrengthIndex;
use Crypto\Exceptions\ParameterException;
use Crypto\Exchange\ExchangeFactory;
use Crypto\Exchange\kuCoin\History\Kline\KlineHistory;
use Crypto\Request\RequestClient;
use GuzzleHttp\Exception\GuzzleException;

class AnalysesRsiController extends BaseController {

    // TODO => php doc with url and example
    public static function calculateRelativeStrengthIndex(array $params, int $period = 14) {
        try {
            $klines = (new AnalysesRsiController)->getKlinesFromExchange($params['exchange'], $params['symbol'],
              $params['type']);
            $rsiClass = new RelativeStrengthIndex($klines);
            $rsi = $rsiClass->calculate($period);
            echo '<pre>';
            print_r($rsi);
            echo '</pre>';
        } catch (ParameterException $e) {
            echo $e->getMessage();
        } catch (GuzzleException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        }
    }

    /**
     * @throws GuzzleException
     * @throws \Crypto\Exceptions\ParameterException
     */
    private function getKlinesFromExchange(string $exchangeName, string $symbol, string $type): array {
        $exchange = ExchangeFactory::getExchange($exchangeName);
        $client = RequestClient::createClient($exchange->getBaseUri());
        $klineHistory = new KlineHistory();
        $data = $klineHistory->getKlineHistory($client, $symbol, $type);
        return $data['data'];
    }
}