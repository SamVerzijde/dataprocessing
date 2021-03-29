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
});
