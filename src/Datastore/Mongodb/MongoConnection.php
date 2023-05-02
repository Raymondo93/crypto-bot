<?php

namespace Crypto\Datastore\Mongodb;

use \MongoDB\Client;
use \MongoDB\Database;


class MongoConnection
{

    public function __construct(private readonly string $server, private readonly string $database) {

    }


    public function connect(): Database {
        $client = new Client($this->server);
        return $client->selectDatabase($this->database);
    }
}