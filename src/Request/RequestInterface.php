<?php

namespace Crypto\Request;

interface RequestInterface {

    function createPublicGetRequest(string $uri, array $parameters = []): array;
}