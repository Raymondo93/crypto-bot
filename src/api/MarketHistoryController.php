<?php

namespace Crypto\api;

use Crypto\Exceptions\ParameterException;
use Crypto\Exchange\ExchangeFactory;
use Crypto\Exchange\kuCoin\History\Kline\KlineHistory;
use Crypto\Request\RequestClient;
use GuzzleHttp\Exception\GuzzleException;

class MarketHistoryController extends BaseController {


    /**
     * Creates a RequestClient and get the candlesticks from the exchange. Kucoin only for now. I need a sort of
     * factory for ExchangeClientFactory to decide which exchange to get the klines from.
     * Example URL => ?type=1min&symbol=BTC-USDT&startAt=1566703297&endAt=1566789757&exchange=kucoin
     * @param array $params -> Parameters from the request.
     * TODO -> Handle the exception in a log.
     */
    public static function getKlinesFromExchange(array $params) {
        try {
            $exchange = ExchangeFactory::getExchange($params['exchange']);
            $client = RequestClient::createClient($exchange->getBaseUri());
            $klineHistory = new KlineHistory();
            if (isset($params['symbol']) && isset($params['type']) && isset($params['startAt']) &&
              isset($params['endAt'])) {
                $data = $klineHistory->getKlineHistory($client, $params['symbol'], $params['type'], $params['startAt'],
                  $params['endAt']);
            } else if (isset($params['symbol']) && isset($params['type']) && !isset($params['startAt']) &&
              !isset($params['endAt'])) {
                $data = $klineHistory->getKlineHistory($client, $params['symbol'], $params['type']);
            }
            if (isset($data)) {
                print_r($data);
            }
        } catch (GuzzleException $e) {
            echo $e->getCode();
            echo $e->getMessage();
        } catch (ParameterException $e) {
            echo $e->getMessage();
        }
    }
}