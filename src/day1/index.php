<?php

/*** Part 1 ***/

$filename = './input';

$file = fopen($filename, 'r');
$leftList = [];
$rightList = [];
while ($line = fgets($file)) {
    $number = explode("   ", $line);
    $leftList[] = (int) $number[0];
    $rightList[] = (int) $number[1];
}

fclose($file);

sort($leftList);
sort($rightList);

$distanceTotal = 0;

foreach($leftList as $key => $value) {


    $distanceTotal += abs($leftList[$key] - $rightList[$key]);
}

echo("<pre>");
var_dump("---- Partie 1 ----");
var_dump("Distance Total : " . $distanceTotal);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$leftList = [];
$rightList = [];
$similarity = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $number = explode("   ", $line);

    $leftList[] = (int) $number[0];

    if(isset($rightList[$number[1]])) {
        $rightList[$number[1]]++;
    } else {
        $rightList[$number[1]] = 1;
    }
}

fclose($file);

foreach($leftList as $value) {
    if(isset($rightList[$value])) {
        $similarity += ($value * $rightList[$value]);
    }
}
var_dump("---- Partie 2 ----");
var_dump("Similarité total : " . $similarity);
