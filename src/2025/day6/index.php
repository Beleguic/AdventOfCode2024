<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$countGlobal = 0;
$numbers = [];
$sign = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = trim($line);
    $line = str_replace('      ', ' ',$line);
    $line = str_replace('     ', ' ',$line);
    $line = str_replace('    ', ' ',$line);
    $line = str_replace('   ', ' ',$line);
    $line = str_replace('  ', ' ',$line);
    $line = explode(' ',$line);
    if($line[0] == '+' || $line[0] == '*'){
        foreach ($line as $key => $value) {
            $sign[$key] = $value;
        }
    }
    else{
        foreach ($line as $key => $value) {
            if(!isset($numbers[$key])){
                $numbers[$key] = [];
            }
            $numbers[$key][] = $value;
        }
    } 
}

fclose($file);

foreach ($numbers as $key => $value) {
    $count = 0;
    if($sign[$key] == '+'){
        foreach ($value as $data) {
            $count += $data;
        }
    }
    elseif($sign[$key] == '*'){
        foreach ($value as $data) {
            if($count == 0){
                $count = $data;
            }
            else{
                $count *= $data;
            }
        }
    }
    $countGlobal += $count;
}

var_dump("---- Partie 1 ----");
var_dump($countGlobal);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$countGlobal = 0;
$lines = [];
$signLine = "";
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if($line[0] == '+' || $line[0] == '*'){
        $signLine = $line;
    }
    else{
        $lines[] = $line;
    }
}

fclose($file);

$signLine = str_split($signLine);
$position = [];
$index = 0;
$length = 0;
foreach ($signLine as $key => $value) {
    if($value == '+' || $value == '*'){
        $position[$index]['length'] = $length - 1;
        $index++;
        $position[$index]['start'] = $key;
        $position[$index]['sign'] = $value;
        $length = 0;
    }
    $length++;
}
$position[$index]['length'] = $length;
unset($position[0]);
$position = array_values($position);

$numbers = [];
foreach ($lines as $key => $value) {
    $line = str_split($value);
    foreach ($position as $positionKey => $positionData) {
        for ($i=$positionData['start']; $i < $positionData['start'] + $positionData['length']; $i++) {
            if(!isset($numbers[$positionKey][$i])){
                $numbers[$positionKey][$i] = "";
            }
            $numbers[$positionKey][$i] .= $line[$i];
        }
    }
}

foreach ($numbers as $key => $value) {
    $sign = $position[$key]['sign'];
    $count = 0;
    if($sign == '+'){
        foreach ($value as $data) {
            $count += $data;
        }
    }
    elseif($sign == '*'){
        foreach ($value as $data) {
            if($count == 0){
                $count = $data;
            }
            else{
                $count *= $data;
            }
        }
    }
    $countGlobal += $count;
}

var_dump("---- Partie 2 ----");
var_dump($countGlobal);