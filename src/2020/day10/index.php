<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$joltageList = [];
$min = 999;
$max = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $joltageList[] = $line;
    if($min > $line){
        $min = $line;
    }
    if($max < $line){
        $max = $line;
    }
}

$maxJoltageAdapter = $max + 3;

fclose($file);

$adapterChain = [];
$adapterChain[] = 0;

$plus1JoltageCount = 0;
$plus3JoltageCount = 0;

while(sizeof($joltageList) > 0){
    $lastAdapter = end($adapterChain);
    $find = false;
    foreach ($joltageList as $key => $value) {
        if($value == $lastAdapter + 1){
            $joltageList = removeElementInArray($joltageList, $value);
            $adapterChain[] = $value;
            $plus1JoltageCount++;
            $find = true;
            break;
        }
    }

    if(!$find){
        foreach ($joltageList as $key => $value) {
            if($value == $lastAdapter + 2){
                $joltageList = removeElementInArray($joltageList, $value);
                $adapterChain[] = $value;
                $find = true;
                break;
            }
        }
        if(!$find){
            foreach ($joltageList as $key => $value) {
                if($value == $lastAdapter + 3){
                    $joltageList = removeElementInArray($joltageList, $value);
                    $adapterChain[] = $value;
                    $plus3JoltageCount++;
                    $find = true;
                    break;
                }
            }
        }
    }

}

var_dump("---- Partie 1 ----");
var_dump($plus1JoltageCount * $plus3JoltageCount);
exit;
/*** Part 2 ***/

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

var_dump("---- Partie 2 ----");

function removeElementInArray($array, $valuetoRemove){
    foreach ($array as $key => $value) {
        if($value == $valuetoRemove){
            unset($array[$key]);
            break;
        }
    }
    return array_values($array);
}