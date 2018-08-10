<?php
require "vendor/autoload.php";

// Instantiate the app object
$app = new \Slim\App();

require "routes/web.php";

$app->run();
