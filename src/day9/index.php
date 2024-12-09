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

$checksum = 0;
foreach($diskPartRearrange as $key => $value){
    if($value != '.'){
        $checksum += ((int)$key * (int) $value);
    }
}

var_dump($diskPartRearrange);

var_dump("---- Partie 1 ----");
var_dump('Checksum : ' . $checksum);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

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
