<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$horizontalValue = 0;
$depthValue = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $instructions = explode(' ', $line);
    $move = $instructions[0];
    $unit = $instructions[1];

    if($move == 'forward'){
    	$horizontalValue += $unit;
    }
    elseif($move == 'down'){
    	$depthValue += $unit;
    }
    elseif($move == 'up'){
    	$depthValue -= $unit;
    }
}

fclose($file);

$finalValue = $horizontalValue * $depthValue;

var_dump("---- Partie 1 ----");
var_dump("position : " . $finalValue);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$horizontalValue = 0;
$depthValue = 0;
$aimValue = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $instructions = explode(' ', $line);
    $move = $instructions[0];
    $unit = $instructions[1];

    if($move == 'forward'){
    	$horizontalValue += $unit;
    	$depthValue += ($aimValue * $unit);
    }
    elseif($move == 'down'){
    	$aimValue += $unit;
    }
    elseif($move == 'up'){
    	$aimValue -= $unit;
    }
}

fclose($file);

$finalValue = $horizontalValue * $depthValue;

var_dump("---- Partie 2 ----");
var_dump("position : " . $finalValue);