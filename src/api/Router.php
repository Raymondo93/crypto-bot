<?php

namespace Crypto\api;

class Router {

    public function __construct(array $uri, string $method) {
        switch(strtoupper($method)) {
            case 'GET':
                $this->get(implode('/', $uri));
                break;
            case 'POST':
                $this->post(implode('/', $uri));
                break;
            case 'PUT':
                $this->put(implode('/', $uri));
                break;
            case 'DELETE':
                $this->delete(implode('/', $uri));
                break;
            default: header('HTTP/1.1 405 Method not allowed.');
        }
    }

    private function get(string $uri) {
        switch($uri) {
            case 'kucoin/markethistory/klines': //kucoin could be removed, but this endpoint was for testing purpose only
                $params = $this->parseGetVarsInArray($_GET);
                MarketHistoryController::handle(MarketHistoryController::class, 'getKlinesFromExchange',
                  $params);
                break;
            case 'analysis/rsi':
                $params = $this->parseGetVarsInArray($_GET);
                AnalysesRsiController::handle(AnalysesRsiController::class, 'calculateRelativeStrengthIndex', $params);
                break;
        }
    }

    private function post(string $uri) {
        switch($uri) {
            default: header('HTTP/1.1 404 Not found.');
        }
    }

    private function put(string $uri) {
        switch($uri) {
            default: header('HTTP/1.1 404 Not found.');
        }
    }

    private function delete(string $uri) {
        switch($uri) {
            default: header('HTTP/1.1 404 Not found.');
        }
    }

    private function uriChecker(array $uri): bool {
        return false;
    }

    private function parseGetVarsInArray($get): array {
        $data = array();
        foreach($get as $key => $value) {
            $data[$key] = $value;
        }
        return $data;
    }
}