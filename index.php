<?php
require "vendor/autoload.php";

$container = new \Slim\Container([
    'http' => function () {
        return new GuzzleHttp\Client();
    }
]);

// Instantiate the app object
$app = new \Slim\App($container);

require "routes/web.php";

$app->run();
