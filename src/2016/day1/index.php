<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$x = 0;
$y = 0;
$direction = 'North';

/*
    NORD
Ouest   Est
    Sud

R = right = droit
L = left = gauche

donc R de north = Est

nord = x+
sud = x-
est = y+
ouest = y-
*/
$location = [];


$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $instruction = explode(", ", $line);
}

//$instruction = ['R8', 'R4', 'R4', 'R8'];
$alreadyPass = false;
foreach ($instruction as $key => $value) {
    if(!$alreadyPass){
        [$direction, $x, $y, $location, $alreadyPass] = process($value, $direction, $x, $y, $location, $alreadyPass);
    }
}

$result = abs($x) + abs($y);
var_dump($result);

function process($instruction, $direction, $x, $y, $location, $alreadyPass){
    $turn = $instruction[0];
    $number = substr($instruction, 1);

    if($direction == 'North'){
        if($turn == 'R'){
            $direction = 'East';
            for ($i=1; $i <= $number; $i++) {
                if(isset($location[$x][$y+$i])){
                    return [$direction, $x, $y+$i, $location, true];
                }
                $location[$x][$y+$i] = "1";
            }
            $y += $number;

        }
        elseif($turn == 'L'){
            $direction = 'West';
            for ($i=1; $i <= $number; $i++) {
                if(isset($location[$x][$y-$i])){
                    return [$direction, $x, $y-$i, $location, true];
                }
                $location[$x][$y-$i] = "1";
            }
            $y -= $number;
        }
    }
    elseif($direction == 'East'){
        if($turn == 'R'){
            $direction = 'South';
            for ($i=1; $i <= $number; $i++) {
                if(isset($location[$x-$i][$y])){
                    return [$direction, $x-$i, $y, $location, true];
                }
                $location[$x-$i][$y] = "1";
            }
            $x -= $number;
        }
        elseif($turn == 'L'){
            $direction = 'North';
            for ($i=1; $i <= $number; $i++) {
                if(isset($location[$x+$i][$y])){
                    return [$direction, $x+$i, $y, $location, true];
                }
                $location[$x+$i][$y] = "1";
            }
            $x += $number;
        }
    }
    elseif($direction == 'South'){
        if($turn == 'R'){
            $direction = 'West';
            for ($i=1; $i <= $number; $i++) {
                if(isset($location[$x][$y-$i])){
                    return [$direction, $x, $y-$i, $location, true];
                }
                $location[$x][$y-$i] = "1";
            }
            $y -= $number;
        }
        elseif($turn == 'L'){
            $direction = 'East';
            for ($i=1; $i <= $number; $i++) {
                if(isset($location[$x][$y+$i])){
                    return [$direction, $x, $y+$i, $location, true];
                } 
                $location[$x][$y+$i] = "1";
            }
            $y += $number;
        }
    }
    elseif($direction == 'West'){
        if($turn == 'R'){
            $direction = 'North';
            for ($i=1; $i <= $number; $i++) {
                if(isset($location[$x+$i][$y])){
                    return [$direction, $x+$i, $y, $location, true];
                } 
                $location[$x+$i][$y] = "1";
            }
            $x += $number;
        }
        elseif($turn == 'L'){
            $direction = 'South';
            for ($i=1; $i <= $number; $i++) { 
                if(isset($location[$x-$i][$y])){
                    return [$direction, $x-$i, $y, $location, true];
                } 
                $location[$x-$i][$y] = "1";
            }
            $x -= $number;
        }
    }


    return [$direction, $x, $y, $location, $alreadyPass];
}


fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

var_dump("---- Partie 2 ----");