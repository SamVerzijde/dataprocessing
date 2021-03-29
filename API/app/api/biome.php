<?php
/*
//Display Query
$app->get('/api/biome', function($request, $response, $args) {
    require_once('dbconnect.php');

    $query = "select * from biome where biome = 'coal'";
    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    $response->getBody()->write(json_encode($data));

    if (isset ($data)) {
        #header('Content-Type: application/json');
        return $response;
    }

});
*/

//Display a single row from url
use Slim\Routing\RouteCollectorProxy;

$app->group('/biome', function (RouteCollectorProxy $group) {
    $group->get('', function ($request, $response, $args) {
        require_once('dbconnect.php');

        $query = "select * from biome";
        $result = $mysqli->query($query);
        $x = 0;
        while ($x <= 15) {
            $data[] = $result->fetch_assoc();
            $x++;
        };

        $response->getBody()->write(json_encode($data));

        header('Content-Type: application/json');
        return $response;
    });
    $group->get('/{id}', function ($request, $response, $args) {
        require_once('dbconnect.php');

        $id = $request->getAttribute('id');

        $query = "select * from biome where id = $id";
        $result = $mysqli->query($query);

        $data[] = $result->fetch_assoc();

        $response->getBody()->write(json_encode($data));

        header('Content-Type: application/json');
        return $response;
    });
    $group->delete('/{id}', function ($request, $response, $args) {
        require_once('dbconnect.php');
        $id = $request->getAttribute('id');
        $query = "DELETE FROM biome WHERE id = $id";

        $mysqli->query($query);

        $response->getBody()->write("Doei");
        return $response;
    });
    $group->put('/{id}', function ($request, $response, $args) {
        require_once('dbconnect.php');
        
        $parsedbody = $request->getParsedBody();

        $id = $request->getAttribute('id');
        var_dump($parsedbody);
        $biome = $parsedbody['biome'];
        $rarity = $parsedbody['rarity'];
        $temperature = $parsedbody['temperature'];
        $type = $parsedbody['type'];
        $blocks = $parsedbody['blocks'];

        $query = "UPDATE biome SET 
            biome = '$biome', 
            rarity = '$rarity', 
            temperature = '$temperature', 
            type = '$type', 
            blocks = '$blocks'
            WHERE id = '$id'";

        $mysqli->query($query);

        $response->getBody()->write("Staat er in maat");
        return $response;
    });
});
