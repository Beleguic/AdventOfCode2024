<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$horinzontalPosition = [];

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $horinzontalPosition = explode(',', $line);
}

fclose($file);

$maxPosition = max($horinzontalPosition);
$fuelUsed = 999999999999999999999999999;

for ($horinzontalTarget = 0; $horinzontalTarget <= $maxPosition; $horinzontalTarget++) { 
	$fuelUsedTemp = 0;
	foreach ($horinzontalPosition as $value) {
		$fuelUsedTemp += abs($horinzontalTarget - $value);
		if($fuelUsedTemp > $fuelUsed){
			continue;
		}
	}
	if($fuelUsedTemp < $fuelUsed){
		$fuelUsed = $fuelUsedTemp;
	}
}

var_dump("---- Partie 1 ----");
var_dump("Fuel Burn : " . $fuelUsed);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$horinzontalPosition = [];

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $horinzontalPosition = explode(',', $line);
}

fclose($file);

$maxPosition = max($horinzontalPosition);
$fuelUsed = 999999999999999999999999999;

for ($horinzontalTarget = 0; $horinzontalTarget <= $maxPosition; $horinzontalTarget++) { 
	$fuelUsedTemp = 0;
	foreach ($horinzontalPosition as $value) {
		$PositionParcourue = abs($horinzontalTarget - $value);
		$fuelUsedTemp += ($PositionParcourue * ($PositionParcourue + 1)) / 2;
		if($fuelUsedTemp > $fuelUsed){
			continue;
		}
	}
	if($fuelUsedTemp < $fuelUsed){
		$fuelUsed = $fuelUsedTemp;
	}
}

var_dump("---- Partie 2 ----");
var_dump("Fuel Burn : " . $fuelUsed);