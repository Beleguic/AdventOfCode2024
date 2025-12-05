<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$occurance = [];

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    $lineSplit = str_split($line);
    foreach ($lineSplit as $key => $value) {
        if(!isset($occurance[$key][$value])){
            $occurance[$key][$value] = 0;
        }
        $occurance[$key][$value]++;
    }
}

$message = "";

foreach ($occurance as $key => $value) {
    arsort($occurance[$key]);
    $message .= array_key_first($occurance[$key]);
}

var_dump($message);

fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$occurance = [];

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    $lineSplit = str_split($line);
    foreach ($lineSplit as $key => $value) {
        if(!isset($occurance[$key][$value])){
            $occurance[$key][$value] = 0;
        }
        $occurance[$key][$value]++;
    }
}

$message = "";

foreach ($occurance as $key => $value) {
    asort($occurance[$key]);
    $message .= array_key_first($occurance[$key]);
}

var_dump($message);

fclose($file);

var_dump("---- Partie 2 ----");