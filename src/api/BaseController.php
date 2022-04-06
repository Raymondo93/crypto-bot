<?php

namespace Crypto\api;

class BaseController {

    public static function handle($object, string $func, array $params) {
        if (method_exists($object, $func)) {
            call_user_func(array($object, $func), $params);
        };
    }

}