<?php

set_time_limit(250);

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
/*
$diskPartRearrange = [];

$files = true;
$cpt = 0;
foreach($diskPart as $key => $value){
    if($files){
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

foreach($diskPartRearrange as $key => $value){
    
    if($value == '.'){
        $lastPosition = defineLastPositionOfArray($diskPartRearrange);

        $diskPartRearrange = swap($diskPartRearrange, $key, $lastPosition);
        if($diskPartRearrange[$lastPosition] != '.'){

            var_dump($lastPosition);
            var_dump($key);

            exit;
        }

    }
}

$done = true;
for($i = 0; $i < sizeof($diskPartRearrange); $i++){
    if($diskPartRearrange[$i] == '.' && $done){
        $lastPosition = defineLastPositionOfArray($diskPartRearrange);
        $diskPartRearrange = swap($diskPartRearrange, $i, $lastPosition);
        $done = false;
    }
}

$checksum = calculateChecksum($diskPartRearrange)

var_dump($diskPartRearrange);

var_dump("---- Partie 1 ----");
var_dump('Checksum : ' . $checksum);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$diskPart = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $diskPart = str_split($line);
}

fclose($file);
$lastKeyEvaluate = 0;
for($i = 0; $i < sizeof($diskPart); $i++){
    $dataFile = defineFileSize($diskPart, $lastKeyEvaluate);

    var_dump($dataFile);
    exit;

    $positionToMove = defineFirstPlaceToMove($diskPart, $dataFile['longueur']);

    if($positionToMove){
        var_dump($dataFile);
        var_dump($positionToMove);
        exit;
    }
}

// trouvé la derniere zone de fihier
// Trouvé la premiere zone de . pouvant accueillir le fichier
// faire un swap
// recommencer
// si pas trouvé d'endroit ou accueilir le fichier, on laisse le fichier comme telle et on passe au prochain



var_dump("---- Partie 2 ----");

function swap($array, $key1, $key2) {
    $temp = $array[$key1];
    $array[$key1] = $array[$key2];
    $array[$key2] = $temp;
    return $array;
}

function defineLastPositionOfArray($array){

    $totalKey = sizeof($array) - 1;
    $tableau2 = array_reverse($array);
    foreach($tableau2 as $key => $value){
        if($value != '.'){
            return $totalKey - $key;
        }
    }

    return $totalKey;

}

function calculateChecksum($array){

    $checksum = 0;
    foreach($array as $key => $value){
        if($value != '.'){
            $checksum += ((int)$key * (int) $value);
        }
    }

    return $checksum;

}

function defineFileSize($array, $lastKeyEvaluate){

    $totalKey = sizeof($array) - 1;
    $lastKeyEvaluateRevserse = $totalKey - $lastKeyEvaluate;
    $reverseArray = array_reverse($array);

    $firstKeyOfNumber = 0;
    $lastKeyOfNumber = 0;
    $numberToCheck = -1;
    $longueurFile = 0;
    for($i = $lastKeyEvaluateRevserse; $i < $totalKey; $i++){

        if($reverseArray[$i] != '.'){
            if($numberToCheck == -1){
                $numberToCheck = $reverseArray[$i];
                $firstKeyOfNumber = $i;
                $longueurFile++;
                var_dump($numberToCheck);
                exit;
            }
        }
        if($numberToCheck == $reverseArray[$i]){
            $longueurFile++;
        }
        if($numberToCheck != -1 && $numberToCheck != $reverseArray[$i]){
            $lastKeyOfNumber = $i - 1;
            return ['numberToMove' => $numberToCheck, 'firstPosition' => $totalKey - $lastKeyOfNumber, 'lastPosition' => $totalKey - $firstKeyOfNumber, 'longueur' => $longueurFile];
        }
    }
}

function defineFirstPlaceToMove($array, $longueur){

    $firstKey = 0;
    $lastKey = 0;

    foreach($array as $key => $value){

        if($value == '.'){
            $isAllPoint = true;
            $firstKey = $key;
            for($i = $key; $i <= $key + $longueur; $i++){
                if($array[$i] != '.'){
                    $isAllPoint = false;
                }
            }
        }

        if($isAllPoint){
            $lastKey = $firstKey + $longueur;
            return ['firstKey' => $firstKey, 'lastKey' => $lastKey, 'longueur' => $longueur];
        }
    }

    return false;

}
