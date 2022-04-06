<?php

namespace Crypto\Request;

use GuzzleHttp\Client;

class RequestClient {


    /**
     * Create a client to send requests from
     * @param string $baseUri -> Base URI of the API
     * @return Client
     * TODO => find out how about cacert.pem
     */
    public static function createClient(string $baseUri): Client {
        return new Client([
          'verify' => 'C:\\Users\\R\\Workspace\\php80\\extras\\cacert\\cacert.pem',
          'base_uri' => $baseUri
        ]);
    }
}