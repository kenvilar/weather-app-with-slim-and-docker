<?php
require "vendor/autoload.php";

$container = new \Slim\Container([
    'http'  => function () {
        return new GuzzleHttp\Client();
    },
    'msqli' => function () {
        $mysqli = new mysqli(
            'weather_db',
            'kenvilar',
            'kenvilarsamplepassword',
            'weather_app'
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
