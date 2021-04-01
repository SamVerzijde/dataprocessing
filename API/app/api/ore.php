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
        $dataType = $request->getHeader('Content-Type');

        require_once('dbconnect.php');

        if ($dataType[0] == 'application/json') {
            $query = "select * from ore";
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
        } elseif ($dataType[0] == 'application/xml') {
            function jsonToXML($array, $xml = false)
            {

                if ($xml === false) {
                    $xml = new SimpleXMLElement('<result/>');
                }

                foreach ($array as $key => $value) {
                    if (is_array($value)) {
                        jsonToXML($value, $xml->addChild($key));
                    } else {
                        $xml->addChild($key, $value);
                    }
                }

                return $xml->asXML();
            };

            $query = "select * from ore";
            $result = $mysqli->query($query);
            $rowsAmount   = mysqli_num_rows($result);

            $x = 0;
            while ($x < $rowsAmount) {
                $data[] = $result->fetch_assoc();
                $x++;
            };

            $jsonEncoded = json_encode($data);

            $jsonDecoded = json_decode($jsonEncoded, true);

            $xml = jsonToXML($jsonDecoded, false);

            $response->getBody()->write($xml);
            return $response;
        } else {
            $response->getBody()->write("Hier is niks te vinden");
            return $response;
        };
    });
    $group->get('/{id}', function ($request, $response, $args) {
        $dataType = $request->getHeader('Content-Type');

        require_once('dbconnect.php');

        $id = $request->getAttribute('id');

        if ($dataType[0] == 'application/json') {
            $query = "select * from ore where id = $id";
            $result = $mysqli->query($query);

            $data[] = $result->fetch_assoc();

            $response->getBody()->write(json_encode($data));

            header('Content-Type: application/json');
            return $response;
        } elseif ($dataType[0] == 'application/xml') {
            function jsonToXML($array, $xml = false)
            {

                if ($xml === false) {
                    $xml = new SimpleXMLElement('<result/>');
                }

                foreach ($array as $key => $value) {
                    if (is_array($value)) {
                        jsonToXML($value, $xml->addChild($key));
                    } else {
                        $xml->addChild($key, $value);
                    }
                }

                return $xml->asXML();
            };

            $query = "select * from ore where id = $id";
            $result = $mysqli->query($query);
            $rowsAmount   = mysqli_num_rows($result);

            $x = 0;
            while ($x < $rowsAmount) {
                $data[] = $result->fetch_assoc();
                $x++;
            };

            $jsonEncoded = json_encode($data);

            $jsonDecoded = json_decode($jsonEncoded, true);

            $xml = jsonToXML($jsonDecoded, false);

            $response->getBody()->write($xml);
            return $response;
        } else {
            $response->getBody()->write("Hier is niks te vinden");
            return $response;
        };
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
        $dataType = $request->getHeader('Content-Type');

        require_once('dbconnect.php');

        $parsedbody = $request->getParsedBody();

        $id = $request->getAttribute('id');
        var_dump($parsedbody);

        if ($dataType[0] == 'application/json') {
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
        } elseif ($dataType[0] == 'application/xml') {
            $xmlValid = new DOMDocument();
            $postmanBody = $request->getBody();
            $xmlValid->loadXML($postmanBody);

            if ($xmlValid->schemaValidate("xsd/ore.xsd")) {
                $ore = $parsedbody->ore;
                $tool = $parsedbody->tool;
                $abundance = $parsedbody->abundance;
                $biome = $parsedbody->biome;
                $most_found_in_layers = $parsedbody->most_found_in_layers;
                $none_at_or_above = $parsedbody->none_at_or_above;
                $rare_on_layers = $parsedbody->rare_on_layers;
                $commonly_up_to_layers = $parsedbody->commonly_up_to_layers;

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
            } else {
                $response->getBody()->write("Niet gevalideerd helaas");
                return $response;
            }
        } else {
            $response->getBody()->write("Hier is niks te vinden");
            return $response;
        };
    });
    $group->post('', function ($request, $response, $args) {
        $dataType = $request->getHeader('Content-Type');

        require_once('dbconnect.php');

        $parsedbody = $request->getParsedBody();

        var_dump($parsedbody);
        if ($dataType[0] == 'application/json') {
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
        } elseif ($dataType[0] == 'application/xml') {
            $xmlValid = new DOMDocument();
            $postmanBody = $request->getBody();
            $xmlValid->loadXML($postmanBody);

            if ($xmlValid->schemaValidate("xsd/ore.xsd")) {

                $ore = $parsedbody->ore;
                $tool = $parsedbody->tool;
                $abundance = $parsedbody->abundance;
                $biome = $parsedbody->biome;
                $most_found_in_layers = $parsedbody->most_found_in_layers;
                $none_at_or_above = $parsedbody->none_or_at_above;
                $rare_on_layers = $parsedbody->rare_on_layers;
                $commonly_up_to_layers = $parsedbody->commonly_up_to_layers;

                $query = "INSERT INTO block (ore, tool, abundance, biome, most_found_in_layers, none_at_or_above, rare_on_layers, commonly_up_to_layers) VALUES 
            ('$ore', '$tool', '$abundance', '$biome', '$most_found_in_layers', '$none_at_or_above', '$rare_on_layers', '$commonly_up_to_layers')";

                $mysqli->query($query);

                $response->getBody()->write("Nieuwe row is aangemaakt");
                return $response;
            } else {
                $response->getBody()->write("Niet gevalideerd helaas");
                return $response;
            }
        } else {
            $response->getBody()->write("Hier is niks te vinden");
            return $response;
        };
    });
});
