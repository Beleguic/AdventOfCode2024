<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$x = 0; // sud/nord
$y = 0; // est/ouest
$facing = "E";

$cardinalePointOrderRight = ['N', 'E', 'S', 'W', 'N', 'E', 'S', 'W'];
$cardinalePointOrderLeft = ['N', 'W', 'S', 'E', 'N', 'W', 'S', 'E'];

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $action = substr($line, 0,1);
    $value = substr($line, 1);

    var_dump("action : " . $action . " value : " . $value . " facing : " . $facing . " x : " . $x . " y : " . $y);

    switch($action){
        case 'N':
            $x += $value;
            break;
        case 'S':
            $x -= $value;
            break;
        case 'E': 
            $y += $value;
            break;
        case 'W':
            $y -= $value;
            break;
        case 'R': 
            $numberOfDecal = $value / 90;
            foreach ($cardinalePointOrderRight as $key1 => $value1) {
                if($value1 == $facing){
                    $facing = $cardinalePointOrderRight[$key1 + $numberOfDecal];
                    break;
                }
            }
            break;
        case 'L':
            $numberOfDecal = $value / 90;
            foreach ($cardinalePointOrderLeft as $key1 => $value1) {
                if($value1 == $facing){
                    $facing = $cardinalePointOrderLeft[$key1 + $numberOfDecal];
                    break;
                }
            }
            break;
        case 'F':
            switch($facing){
                case 'N':
                    $x += $value;
                    break;
                case 'S':
                    $x -= $value;
                    break;
                case 'E': 
                    $y += $value;
                    break;
                case 'W':
                    $y -= $value;
                    break;
            }
            break;
    }

    var_dump("action : " . $action . " value : " . $value . " facing : " . $facing . " x : " . $x . " y : " . $y);
    var_dump("==");
}

fclose($file);

var_dump("---- Partie 1 ----");
var_dump(abs($x),abs($y), abs($x)+abs($y));
/*** Part 2 ***/

$file = fopen($filename, 'r');
$xShip = 0; // sud/nord
$yShip = 0; // est/ouest
$xWayPoint = 1; // sud/nord
$yWayPoint = 10; // est/ouest
$facing = "E";

$cardinalePointOrderRight = ['N', 'E', 'S', 'W', 'N', 'E', 'S', 'W', 'N', 'E', 'S', 'W'];
$cardinalePointOrderLeft = ['N', 'W', 'S', 'E', 'N', 'W', 'S', 'E', 'N', 'W', 'S', 'E'];

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $action = substr($line, 0,1);
    $value = substr($line, 1);

    var_dump("action : " . $action . " value : " . $value . " facing : " . $facing . " x : " . $x . " y : " . $y);

    switch($action){
        case 'N':
            $xWayPoint += $value;
            break;
        case 'S':
            $xWayPoint -= $value;
            break;
        case 'E': 
            $yWayPoint += $value;
            break;
        case 'W':
            $yWayPoint -= $value;
            break;
        case 'R': 
            $numberOfDecal = $value / 90;
            foreach ($cardinalePointOrderRight as $key1 => $value1) {
                if($value1 == $facing){
                    $facing = $cardinalePointOrderRight[$key1 + $numberOfDecal];
                    $facing1 = $cardinalePointOrderRight[$key1 + $numberOfDecal - 1];
                    

                    switch($facing){
                        case 'N':
                            $xWayPoint += $value;
                            break;
                        case 'S':
                            $xWayPoint -= $value;
                            break;
                        case 'E': 
                            $yWayPoint += $value;
                            break;
                        case 'W':
                            $yWayPoint -= $value;
                            break;
                    }
                    $tempWayPoint = $xWayPoint;
                    $xWayPoint = $yWayPoint;
                    $yWayPoint = $tempWayPoint;
                    break;
                }
            }
            break;
        case 'L':
            $numberOfDecal = $value / 90;
            foreach ($cardinalePointOrderLeft as $key1 => $value1) {
                if($value1 == $facing){
                    $facing = $cardinalePointOrderLeft[$key1 + $numberOfDecal];
                    break;
                }
            }
            break;
        case 'F':
            switch($facing){
                case 'N':
                    $x += $value;
                    break;
                case 'S':
                    $x -= $value;
                    break;
                case 'E': 
                    $y += $value;
                    break;
                case 'W':
                    $y -= $value;
                    break;
            }
            break;
    }

    var_dump("action : " . $action . " value : " . $value . " facing : " . $facing . " x : " . $x . " y : " . $y);
    var_dump("==");
}

fclose($file);

var_dump("---- Partie 2 ----");