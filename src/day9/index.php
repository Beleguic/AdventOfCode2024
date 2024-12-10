<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$diskPart = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $diskPart = str_split($line);
}

fclose($file);

$diskPartRearrange = [];

$files = true;
$cpt = 0;
$numberOfFile = 0;
foreach($diskPart as $key => $value){
    if($files){
    	$numberOfFile += $value;
        for($i = 0; $i < $value; $i++){
            $diskPartRearrange[] = $cpt;
        }
        $cpt++;
        $files = false;
    }
    else{
        for($i = 0; $i < $value; $i++){
            $diskPartRearrange[] = '.';
        }
        $files = true;
    }
}
$arrayDroite = $diskPartRearrange;
$arrayEnver = array_reverse($diskPartRearrange);
$finalArray = [];
$keyReverse = 0;
$totalKey = sizeof($arrayDroite) - 1;
foreach ($arrayDroite as $key => $value) {
	if($value == '.'){
		while($arrayEnver[$keyReverse] == '.'){
			$keyReverse++;
		}
		$finalArray[] = $arrayEnver[$keyReverse];
		$keyReverse++;
	}
	else{
		$finalArray[] = $value;
	}
}

$finalArray = array_slice($finalArray, 0, $numberOfFile, true);

var_dump("--- Partie 1 ---");
var_dump("CheckSum : " . calculateChecksum($finalArray));

function calculateChecksum($array){

    $checksum = 0;
    foreach($array as $key => $value){
        if($value != '.'){
            $checksum += ((int)$key * (int) $value);
        }
    }

    return $checksum;

}


$file = fopen($filename, 'r');
$diskPart = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $diskPart = str_split($line);
}

fclose($file);

$files = true;
$cpt = 0;
$numberOfFileToMove = 0;
$diskPartRearrange = [];
foreach($diskPart as $key => $value){
    if($files){
    	$numberOfFileToMove++;
    	$diskPartRearrange[] = ['id' => $cpt, 'longueur' => $value, 'type' => 'file'];
        $cpt++;
        $files = false;
    }
    else{
        $diskPartRearrange[] = ['id' => '.', 'longueur' => $value, 'type' => 'empty'];
        $files = true;
    }
}

$idToEvaluate = $cpt - 1;
for ($i=0; $i < $numberOfFileToMove; $i++) { 
	$lastThingToMove = findLastThingToMove($diskPartRearrange, $idToEvaluate);
	$diskPartRearrange = insertValueIntoEmptyPlace($diskPartRearrange, $lastThingToMove);
	$idToEvaluate--;
}
$diskPartRearrangeForChecksum = [];
foreach($diskPartRearrange as $key => $value){
	for ($i=0; $i < $value['longueur']; $i++) { 
		$diskPartRearrangeForChecksum[] = $value['id'];
	}
}

var_dump("--- Partie 2 ---");
var_dump("CheckSum : " . calculateChecksum($diskPartRearrangeForChecksum));

function findLastThingToMove($diskPartRearrange, $idToEvaluate){

	$diskPartRearrangeReverse = array_reverse($diskPartRearrange);
	$totalKey = sizeof($diskPartRearrange) - 1;
	foreach ($diskPartRearrangeReverse as $key => $value) {
		if($value['type'] == 'file' && $idToEvaluate == $value['id']){
			$value['position'] = $totalKey - $key;
			return $value;
		}
	}

	return false;

}

function insertValueIntoEmptyPlace($diskPartRearrange, $lastThingToMove){

	$longueurToFind = $lastThingToMove['longueur'];

	foreach ($diskPartRearrange as $key => $value) {
		if($value['type'] == 'empty' && $longueurToFind <= $value['longueur'] && $key < $lastThingToMove['position']){
			$diskPartRearrange[$key]['longueur'] -= $longueurToFind;
			$diskPartRearrange[$lastThingToMove['position']]['type'] = 'empty';
			$diskPartRearrange[$lastThingToMove['position']]['id'] = '.';
			array_splice($diskPartRearrange, $key, 0, [$lastThingToMove]);
			return $diskPartRearrange;
		}
	}

	return $diskPartRearrange;

}




