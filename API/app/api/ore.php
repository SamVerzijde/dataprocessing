<?php
/*
//Display Query
$app->get('/api/ore', function($request, $response, $args) {
    require_once('dbconnect.php');

    $query = "select * from ore where ore = 'coal'";
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

$app->group('/ore', function (RouteCollectorProxy $group) {
    $group->get('', function ($request, $response, $args) {
        require_once('dbconnect.php');

        $query = "select * from ore";
        $result = $mysqli->query($query);
        $x = 0;
        while ($x <= 10) {
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

        $query = "select * from ore where id = $id";
        $result = $mysqli->query($query);

        $data[] = $result->fetch_assoc();

        $response->getBody()->write(json_encode($data));

        header('Content-Type: application/json');
        return $response;
    });
    $group->delete('/{id}', function ($request, $response, $args) {
        require_once('dbconnect.php');
        $id = $request->getAttribute('id');
        $query = "DELETE FROM ore WHERE id = $id";

        $mysqli->query($query);

        $response->getBody()->write("Doei");
        return $response;
    });
    $group->put('/{id}', function ($request, $response, $args) {
        require_once('dbconnect.php');

        $parsedbody = $request->getParsedBody();

        $id = $request->getAttribute('id');
        var_dump($parsedbody);
        $ore = $parsedbody['ore'];
        $tool = $parsedbody['tool'];
        $abundance = $parsedbody['abundance'];
        $biome = $parsedbody['biome'];
        $most_found_in_layers = $parsedbody['most_found_in_layers'];
        $none_at_or_above = $parsedbody['none_at_or_above'];
        $rare_on_layers = $parsedbody['rare_on_layers'];
        $commonly_up_to_layers = $parsedbody['commonly_up_to_layers'];

        $query = "UPDATE ore SET 
            ore = '$ore', 
            tool = '$tool', 
            abundance = '$abundance', 
            biome = '$biome', 
            most_found_in_layers = '$most_found_in_layers',
            none_at_or_above = '$none_at_or_above',
            rare_on_layers = '$rare_on_layers',
            commonly_up_to_layers = '$commonly_up_to_layers'
            WHERE id = '$id'";

        $mysqli->query($query);

        $response->getBody()->write("Staat er in maat");
        return $response;
    });
    $group->post('', function ($request, $response, $args) {
        require_once('dbconnect.php');

        $parsedbody = $request->getParsedBody();

        var_dump($parsedbody);
        $ore = $parsedbody['ore'];
        $tool = $parsedbody['tool'];
        $abundance = $parsedbody['abundance'];
        $biome = $parsedbody['biome'];
        $most_found_in_layers = $parsedbody['most_found_in_layers'];
        $none_at_or_above = $parsedbody['none_at_or_above'];
        $rare_on_layers = $parsedbody['rare_on_layers'];
        $commonly_up_to_layers = $parsedbody['commonly_up_to_layers'];

        $query = "INSERT INTO ore (ore, tool, abundance, biome, most_found_in_layers, none_at_or_above, rare_on_layers, commonly_up_to_layers) VALUES 
            ('$ore', '$tool', '$abundance', '$biome', '$most_found_in_layers', '$none_at_or_above', '$rare_on_layers', '$commonly_up_to_layers')";

        $mysqli->query($query);

        $response->getBody()->write("Nieuwe row is aangemaakt");
        return $response;
    });
});
