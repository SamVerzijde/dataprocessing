<?php
$app->get('/api/biome', function($request, $response, $args) {
    $response->getBody()->write("Hallo Boom");

    return $response;
});