<?php
/*
//Display Query
$app->get('/api/block', function($request, $response, $args) {
    require_once('dbconnect.php');

    $query = "select * from block where block = 'coal'";
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

$app->group('/block', function (RouteCollectorProxy $group) {
    $group->get('', function ($request, $response, $args) {
        require_once('dbconnect.php');

        $query = "select * from block";
        $result = $mysqli->query($query);
        $rowsAmount   = mysqli_num_rows($result);

        $x = 0;
        while ($x < $rowsAmount) {
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

        $query = "select * from block where id = $id";
        $result = $mysqli->query($query);

        $data[] = $result->fetch_assoc();

        $response->getBody()->write(json_encode($data));

        header('Content-Type: application/json');
        return $response;
    });
    $group->delete('/{id}', function ($request, $response, $args) {
        require_once('dbconnect.php');
        $id = $request->getAttribute('id');
        $query = "DELETE FROM block WHERE id = $id";

        $mysqli->query($query);

        $response->getBody()->write("Doei");
        return $response;
    });
    $group->put('/{id}', function ($request, $response, $args) {
        require_once('dbconnect.php');
        
        $parsedbody = $request->getParsedBody();

        $id = $request->getAttribute('id');
        var_dump($parsedbody);
        $block = $parsedbody['block'];
        $biome = $parsedbody['biome'];
        $renewable = $parsedbody['renewable'];
        $tool = $parsedbody['tool'];
        $flammable = $parsedbody['flammable'];
        $breaking_time = $parsedbody['breaking_time'];

        $query = "UPDATE block SET 
            block = '$block', 
            biome = '$biome', 
            renewable = '$renewable', 
            tool = '$tool', 
            flammable = '$flammable',
            breaking_time = '$breaking_time'
            WHERE id = '$id'";

        $mysqli->query($query);

        $response->getBody()->write("Staat er in maat");
        return $response;
    });
    $group->post('', function ($request, $response, $args) {
        require_once('dbconnect.php');
        
        $parsedbody = $request->getParsedBody();

        var_dump($parsedbody);
        $block = $parsedbody['block'];
        $biome = $parsedbody['biome'];
        $renewable = $parsedbody['renewable'];
        $tool = $parsedbody['tool'];
        $flammable = $parsedbody['flammable'];
        $breaking_time = $parsedbody['breaking_time'];

        $query = "INSERT INTO block (block, biome, renewable, tool, flammable, breaking_time) VALUES 
            ('$block', '$biome', '$renewable', '$tool', '$flammable', '$breaking_time')";

        $mysqli->query($query);

        $response->getBody()->write("Nieuwe row is aangemaakt");
        return $response;
    });
});
