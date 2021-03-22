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
$app->get('/api/ore/{ore}', function ($request, $response, $args) {
    require_once('dbconnect.php');

    $ore = $request->getAttribute('ore');

    $query = "select * from ore where ore = '$ore'";
    $result = $mysqli->query($query);

    $data[] = $result->fetch_assoc();

    $response->getBody()->write(json_encode($data));

    header('Content-Type: application/json');
    return $response;
});
