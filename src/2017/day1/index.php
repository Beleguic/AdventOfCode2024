<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$sum = 0;
$input = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $input = str_split($line);
    $input[sizeof($input)] = $input[0];
}

fclose($file);

foreach ($input as $key => $value) {
    if(isset($input[$key + 1]) && $value == $input[$key + 1]){
        $sum += $value;
    }
}

var_dump("---- Partie 1 ----");
var_dump($sum);


/*** Part 2 ***/

$file = fopen($filename, 'r');
$sum = 0;
$input = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $input = str_split($line);
}

$firsthalf = array_slice($input, 0, intval(sizeof($input) / 2));
$secondhalf = array_slice($input, intval(sizeof($input) / 2));

fclose($file);

foreach ($firsthalf as $key => $value) {
    if(isset($secondhalf[$key]) && $value == $secondhalf[$key]){
        $sum += $value;
    }
}

foreach ($secondhalf as $key => $value) {
    if(isset($firsthalf[$key]) && $value == $firsthalf[$key]){
        $sum += $value;
    }
}


var_dump("---- Partie 2 ----");
var_dump($sum);