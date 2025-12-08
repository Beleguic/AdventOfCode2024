<?php

set_time_limit(-1);

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$idDeparture = 0;
$busLine = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if($idDeparture == 0){
        $idDeparture = $line;
    }
    else{
        $busLine = explode(',',str_replace(',x', '', $line));
    }
}

fclose($file);
$busIs = 0;
for ($i=$idDeparture; $i < $idDeparture + 50; $i++) { 
    foreach ($busLine as $key => $value) {
        $busDepart = $i % $value;
        if($busDepart == 0){
            $busIs = $value;
            break(2);
        }
    }
}

$minuteWaited = $i - $idDeparture;

var_dump("---- Partie 1 ----");
var_dump($busIs * $minuteWaited);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$idDeparture = 0;
$busLine = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if($idDeparture == 0){
        $idDeparture = $line;
    }
    else{
        $busLine = explode(',',$line);
    }
}

fclose($file);

$bus = [];
foreach ($busLine as $key => $value) {
    if($value != 'x'){
        $bus[] = ['id' => $value, 'offset' => $key];
    }
}

$timestamps = 0;
$i = 1;

// Théoreme des reste chinois
foreach ($bus as $key => $value) {
    $id = $value['id'];
    $offset = $value['offset'];

    while ( ($timestamps + $offset) % $id !== 0 ) {
        $timestamps += $i;
    }

    $i *= $id;
}


var_dump("---- Partie 2 ----");
var_dump($timestamps);