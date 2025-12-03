<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$map = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $map[] = str_split($line);
}

fclose($file);

$startPositionX = 0;
$startPositionY = 0;

$positionX = 1;
$positionY = 3;

$bottomOfMap = sizeof($map) - 1;
$rightOfMap = sizeof($map[0]) -1;

$numberOfTree = 0;

while($startPositionX < $bottomOfMap){

    $startPositionX += $positionX;
    $startPositionY += $positionY;

    if($startPositionY > $rightOfMap){
        $startPositionY -= ($rightOfMap + 1);
    }

    $element = $map[$startPositionX][$startPositionY];

    if($element == '#'){
        $numberOfTree++;
    }
}

var_dump("---- Partie 1 ----");
var_dump($numberOfTree);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$map = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $map[] = str_split($line);
}

fclose($file);

var_dump("---- Partie 2 ----");

$scenario = [0 => ['x' => 1, 'y' => 1], 1 => ['x' => 1, 'y' => 3],2 => ['x' => 1, 'y' => 5],3 => ['x' => 1, 'y' => 7],4 => ['x' => 2, 'y' => 1],];

$numberTotalOfTree = 0;

foreach ($scenario as $key => $value) {

    $startPositionX = 0;
    $startPositionY = 0;

    $positionX = $value['x'];
    $positionY = $value['y'];

    $bottomOfMap = sizeof($map) - 1;
    $rightOfMap = sizeof($map[0]) -1;

    $numberOfTree = 0;

    while($startPositionX < $bottomOfMap){

        $startPositionX += $positionX;
        $startPositionY += $positionY;

        if($startPositionY > $rightOfMap){
            $startPositionY -= ($rightOfMap + 1);
        }

        $element = $map[$startPositionX][$startPositionY];

        if($element == '#'){
            $numberOfTree++;
        }
    }

    var_dump("Scenario " . $key . " Right : " . $value['y'] . " Down : " . $value['x'] . " Numbre of tree : " . $numberOfTree);
    if($numberTotalOfTree != 0){
        $numberTotalOfTree = $numberTotalOfTree * $numberOfTree;
    }
    else{
        $numberTotalOfTree = $numberOfTree;
    }
}


var_dump($numberTotalOfTree);