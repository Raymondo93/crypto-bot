<?php

namespace Crypto\Request;

use Crypto\Request\kucoin\ApiSignature;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Request implements RequestInterface {

    public function __construct(private Client $client) {

    }

    /**
     * Creating a public GET request without any settings.
     * Returns: string
     * @throws GuzzleException
     */
    public function createPublicGetRequest(string $uri, array $parameters = []): array {
        if (!empty($parameters)) {
            $uri = $this->bindParametersToUri($uri, $parameters);
        }
        $response = $this->client->request('GET', $uri);
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Creating a private request (GET) request. This function supports kucoin only for now, has to be upgraded.
     * @param string $uri
     * @param array $parameters
     * @return array
     * @throws GuzzleException
     */
    public function createPrivateGetRequest(string $uri, array $parameters = []): array {
        if (!empty($parameters)) {
            $uri = $this->bindParametersToUri($uri, $parameters);
        }
        $yml = yaml_parse_file(ROOT . '/config/kucoin_config.yaml');
        $timestamp = time() * 1000;
        $apiSignature = new ApiSignature($yml['API_SECRET']);
        $sign = $apiSignature->signature($timestamp, $uri, $parameters, 'GET');
        $headers = array(
          'headers' => [
            'KC-API-KEY' => $yml['API_KEY'],
            'KC-API-SIGN' => $sign,
            'KC-API-TIMESTAMP' => $timestamp,
            'KC-API-PASSPHRASE' => $yml['PASSPHRASE'],
            'KC-API-KEY-VERSION' => 2
          ]
        );
        $response = $this->client->request('GET', $uri, $headers);
        return json_decode($response->getBody()->getContents(), true);
    }


    /**
     * Bind query parameters to the uri.
     * @param string $uri
     * @param array $parameters
     * @return string -> uri
     */
    private function bindParametersToUri(string $uri, array $parameters): string {
        $parameterString = '';
        $first = true;
        foreach ($parameters as $key => $data) {
            if ($first) {
                $parameterString .= '?'.$key.'='.$data;
            } else {
                $parameterString .= '&'.$key.'='.$data;
            }
            $first = false;
        }
        return $uri.$parameterString;
    }
}