<?php

namespace Crypto\Datastore\Mongodb;

use \MongoDB\Client;
use \MongoDB\Database;


class MongoConnection
{

    public function __construct(private string $server, private string $database, private string $username,
                                private string $password) {

    }


    public function connect(): Database {
        $client = new Client($this->server);
        return $client->selectDatabase($this->database);
    }
}