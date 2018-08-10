<?php

$app->get('/locations/{id}', function ($request, $response, $args) {
    $result = $this->http->get("https://www.metaweather.com/api/location/{$args['id']}/")
                         ->getBody()
                         ->getContents();

    return $response->withStatus(200)->withJson(json_decode($result));
});

$app->delete('/locations/{id}', function ($request, $response, $args) {
    return $response->withStatus(200)->write("Location {$args['id']} deleted.");
});
