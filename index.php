<?php
require "vendor/autoload.php";

$container = new \Slim\Container([
    'http' => function () {
        return new GuzzleHttp\Client();
    },
    'mysql' => function () {
        $mysqli = new mysqli(
            getenv('DATABASE_HOST'),
            getenv('DATABASE_USER'),
            getenv('DATABASE_PASSWORD'),
            getenv('DATABASE_NAME')
        );
        if ($mysqli->connect_errno) {
            echo "Failed to connect to MYSQL: " . $mysqli->connect_error;
            exit();
        } else {
            return $mysqli;
        }
    }
]);

// Instantiate the app object
$app = new \Slim\App($container);

require "routes/web.php";

$app->run();
