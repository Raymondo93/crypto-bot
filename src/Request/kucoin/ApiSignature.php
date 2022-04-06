<?php

namespace Crypto\Request\kucoin;

class ApiSignature {

    public function __construct(private string $secret) {

    }

    public function signature(int $timestamp, string $request_path, array $body, $method = 'GET'): string {
        $body = json_encode($body);
        $what = $timestamp . $method . $request_path . $body;
        return base64_encode(hash_hmac("sha256", $what, $this->secret, true));
    }
}