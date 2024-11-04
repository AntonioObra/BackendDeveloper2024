<?php

/**
 * Database config
 *
 * Ovaj config je za sqlite i mysql
 **/

return [
    "sqlite" => [
        "path" => __DIR__ . "/database.sqlite",
    ],
    "mysql" => [
        "host" => "localhost",
        "port" => 3306,
        "database" => "napredni-php-ispit-db",
        "username" => "root",
        "password" => "",
        "charset" => "utf8mb4",
    ],
];
