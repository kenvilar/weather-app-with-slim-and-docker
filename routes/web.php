<?php

$app->get('/locations/{id}', function ($request, $response, $args) {
    return $response->withStatus(200)->write("Location {$args['id']} retrieved.");
});

$app->delete('/locations/{id}', function ($request, $response, $args) {
    return $response->withStatus(200)->write("Location {$args['id']} deleted.");
});
