<?php

$app->get('/locations/{id}', function ($request, $response, $args) {
    $id = $this->mysql->real_escape_string($args['id']);
    $results = $this->mysql->query("SELECT * FROM locations WHERE id='{$id}'");
    if ($results->num_rows > 0) {
        $result = $results->fetch_assoc()['weather_app'];
    } else {
        try {
            $result = $this->http->get("https://www.metaweather.com/api/location/{$args['id']}/")
                ->getBody()
                ->getContents();

            $cleanResult = $this->mysql->real_escape_string($result);

            if (!$this->mysql->query("INSERT INTO locations (id, weather) VALUES ('{$id}', '${cleanResult}')")) {
                throw new Exception("Location could not be updated.");
            }
        } catch (Exception $e) {
            print("Invalid ID");
            exit();
        }
    }

    return $response->withStatus(200)->withJson(json_decode($result));
});

$app->delete('/locations/{id}', function ($request, $response, $args) {
    return $response->withStatus(200)->write("Location {$args['id']} deleted.");
});
