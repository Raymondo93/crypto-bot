<?php

namespace Crypto\api;

use Crypto\Datastore\Mongodb\MongoConnection;

class AuthenticationController extends BaseController {

    //TODO => function not correct yet
    public static function loginUser(array $params) {
        $mongoConnection = new MongoConnection("mongodb://localhost:27017", "crypto-bot-store");
        $client = $mongoConnection->connect();
        $collection = $client->selectCollection("user_authentication");
        var_dump($collection->findOne(['username' => 'testpersoon', 'password' => 'testwachtwoord'], ['projection' => ['password' => 0]]));
    }

}