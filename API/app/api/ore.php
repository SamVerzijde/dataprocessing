<?php
$app->get('/api/ore', function() {
    require_once('dbconnect.php');

    $query = "select * from ore where ore = 'coal'";
    $result = $mysqli->query($query);

    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    
    if (isset ($data)) {
        #header('Content-Type: application/json');
        echo json_encode($data);
    }

});