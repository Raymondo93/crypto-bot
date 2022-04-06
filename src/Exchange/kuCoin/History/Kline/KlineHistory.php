<?php

namespace Crypto\Exchange\kuCoin\History\Kline;

use Crypto\Exceptions\ParameterException;
use Crypto\Request\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class KlineHistory {

    private $klines;
    /**
     * @var string -> endpoint of the API. This endpoint has three parameters: symbol, startAt & endAt.
     */
    private $endpoint = '/api/v1/market/candles';

    /**
     * @param Client $requestClient ->
     * @param string $symbol
     * @param string $type
     * @param float|null $start
     * @param float|null $end
     * @return string
     * @throws GuzzleException
     * @throws ParameterException
     */
    public function getKlineHistory(Client $requestClient, string $symbol, string $type, float $start = null,
                                    float  $end = null): array {
        if (!(!$this->checkType($type))) {
            // TODO -> else if other options
            if (!isset($start) && !isset($end)) {
                $parameters = array(
                  "symbol" => $symbol,
                  "type" => $type
                );
            } else if (isset($start) && isset($end)) {
                $parameters = array(
                  "symbol" => $symbol,
                  "type" => $type,
                  "startAt" => $start,
                  "endAt" => $end
                );
            }
        }
        if (isset($parameters)) {
            $request = new Request($requestClient);
            return $request->createPublicGetRequest($this->endpoint, $parameters);
        } else {
            throw new ParameterException('Invalid parameters!');
        }

    }

    /**
     * @author: Raymond de Bruine
     * Checks if given type is valid with types in KuCoin
     * @param string $type
     * @return bool
     */
    private function checkType(string $type): bool {
        return match ($type) {
            '1min', '3min', '5min', '15min', '30min', '1hour', '2hour', '4hour', '6hour', '8hour', '12hour', '1day', '1week' => true,
            default => false,
        };
    }
}