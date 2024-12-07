<?php

ini_set('memory_limit', '81G');
ini_set('max_execution_time', '0'); // Temps en secondes



/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$lanternFish = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $lanternFishInitial = explode(',', $line);
  	foreach ($lanternFishInitial as $fish) {
  		if(!isset($lanternFish[$fish])){
  			$lanternFish[$fish] = 0;
  		}
  		$lanternFish[$fish] ++;
  	}
}

fclose($file);
$numberOfDay = 80;
for ($i=0; $i < $numberOfDay; $i++) {
	$lanternFish = simulateLanterFishDay($lanternFish);
}

$numberOfFishDay80 = 0;
foreach ($lanternFish as $numberOfFish) {
	$numberOfFishDay80 += $numberOfFish;
}

var_dump("---- Partie 1 ----");
var_dump("number of lanternFish after 80 day : " . $numberOfFishDay80);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$lanternFish = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $lanternFishInitial = explode(',', $line);
  	foreach ($lanternFishInitial as $fish) {
  		if(!isset($lanternFish[$fish])){
  			$lanternFish[$fish] = 0;
  		}
  		$lanternFish[$fish] ++;
  	}
}

fclose($file);
$numberOfDay = 256;
for ($i=0; $i < $numberOfDay; $i++) {
	$lanternFish = simulateLanterFishDay($lanternFish);
}

$numberOfFishDay256 = 0;
foreach ($lanternFish as $numberOfFish) {
	$numberOfFishDay256 += $numberOfFish;
}

var_dump("---- Partie 2 ----");
var_dump("number of lanternFish after 256 day : " . $numberOfFishDay256);

// La fonction fonctionne quand on a 80 jour
// mais le probleme est un probleme exponentielle
// on arrive donc a une variable qui dépasse la taille max de memoire
/*function simulateLanterFishDay($lanternFish){

	$newLantern = 0;
	foreach ($lanternFish as $key => $fish) {
		if($fish == 0){
			$lanternFish[$key] = 6;
			$newLantern++;
		}
		else{
			$lanternFish[$key] -= 1;
		}
	}

	for ($i=0; $i < $newLantern; $i++) { 
		array_push($lanternFish, 8);
	}

	return $lanternFish;

}*/

function simulateLanterFishDay($lanternFish){

	ksort($lanternFish);

	$newLanternFish = [];
	foreach ($lanternFish as $dayOfMaturation => $numberOfFish) {
		if($dayOfMaturation == 0){
			$newLanternFish[8] = $numberOfFish;
			$newLanternFish[6] = $numberOfFish;
		}
		else{
			if(!isset($newLanternFish[$dayOfMaturation - 1])){
				$newLanternFish[$dayOfMaturation - 1] = 0;
			}
			$newLanternFish[$dayOfMaturation - 1] += $numberOfFish;
		}
	}

	return $newLanternFish;

}