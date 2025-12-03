<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$numbers = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $numbers[] = $line;
}

fclose($file);

$answer = 0;
$find = false;
foreach ($numbers as $key1 => $value1) {
    foreach ($numbers as $key2 => $value2) {
        if(!$find){
            if($value2 != $value1){
                if($value1 + $value2 == 2020){
                    $find = true;
                    $answer = $value1 * $value2;
                }
            }
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump($answer);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$numbers = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $numbers[] = $line;
}

fclose($file);

$answer = 0;
$find = false;
foreach ($numbers as $key1 => $value1) {
    foreach ($numbers as $key2 => $value2) {
        foreach ($numbers as $key3 => $value3) {
            if(!$find){
                if($value1 != $value2 && $value2 != $value3 && $value1 != $value3){
                    if($value1 + $value2 +$value3 == 2020){
                        $find = true;
                        $answer = $value1 * $value2 * $value3;
                    }
                }
            }
        }
    }
}

var_dump("---- Partie 2 ----");
var_dump($answer);