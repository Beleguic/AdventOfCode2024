<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$topologyMap = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $topologyMap[] = str_split($line);
}

fclose($file);
$numberOfTraihead = 0;
foreach($topologyMap as $line => $columns){
    foreach($columns as $column => $value){
        if($value == '0'){
            $pathPossibleFor9 = determineNumberOfTraiHead($line, $column, $topologyMap);

            $finalPos = [];
            foreach($pathPossibleFor9 as $value){
                $x = $value['x'];
                $y = $value['y'];
                $key = $x.'-'.$y;
                if(!isset($finalPos[$key])){
                    $finalPos[$key] = 0;
                }
                $finalPos[$key]++;
            }

            $numberOfTraihead += sizeof($finalPos);
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump('Number of TrailHead : ' . $numberOfTraihead);
/*** Part 2 ***/

$file = fopen($filename, 'r');
$safeReport = 0;
$topologyMap = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $topologyMap[] = str_split($line);
}

fclose($file);
$numberOfTraihead = 0;
foreach($topologyMap as $line => $columns){
    foreach($columns as $column => $value){
        if($value == '0'){
            $pathPossibleFor9 = determineNumberOfTraiHead($line, $column, $topologyMap);
            $numberOfTraihead += sizeof($pathPossibleFor9);
        }
    }
}

var_dump("---- Partie 2 ----");
var_dump('Number of TrailHead : ' . $numberOfTraihead);


function determineNumberOfTraiHead($line, $column, $topologyMap){

    $origineX = $column;
    $origineY = $line;

    $pathPossible = [];

    $pathPossible[0][] = ['x' => $origineX, 'y' => $origineY, 'height' => 0];

    // on prend 0, on regarde toute les possibilité
    // on prend la possibilité d'apres, on regarde toute les possibilité suivante, etc
    // a chaque 9 on enleve le 9 de la carte pour le valider

    for($i = 0; $i < 10; $i++){

        foreach($pathPossible[$i] as $key => $value){
            $actualX = $value['x'];
            $actualY = $value['y'];

            if(isset($topologyMap[$actualY][$actualX + 1]) && $topologyMap[$actualY][$actualX + 1] == $i + 1){
                //$numberOfTryPossible++;
                $pathPossible[$i + 1][] = ['x' => $actualX + 1, 'y' => $actualY, 'height' => $i + 1];
                //$actualX++;
            }
            if(isset($topologyMap[$actualY][$actualX - 1]) && $topologyMap[$actualY][$actualX - 1] == $i + 1){
                $pathPossible[$i + 1][] = ['x' => $actualX - 1, 'y' => $actualY, 'height' => $i + 1];
                //$actualX--;
                //$numberOfTryPossible++;
            }
            if(isset($topologyMap[$actualY + 1][$actualX]) && $topologyMap[$actualY + 1][$actualX] == $i + 1){
                $pathPossible[$i + 1][] = ['x' => $actualX, 'y' => $actualY + 1, 'height' => $i + 1];
                //$actualY++;
                //$numberOfTryPossible++;
            }
            if(isset($topologyMap[$actualY - 1][$actualX]) && $topologyMap[$actualY - 1][$actualX] == $i + 1){
                //$numberOfTryPossible++;
                $pathPossible[$i + 1][] = ['x' => $actualX, 'y' => $actualY - 1, 'height' => $i + 1];
                //$actualY--;
            }
        }
    }

    return $pathPossible[9];

}