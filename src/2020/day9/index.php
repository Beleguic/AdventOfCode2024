<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$numbers = [];
$prembuleLength = 25;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $numbers[] = $line;
}

fclose($file);

$firstWrongNumber = 0;

foreach ($numbers as $key => $value) {
    if($key >= $prembuleLength){
        $preambule = array_slice($numbers, $key - $prembuleLength, $prembuleLength);
        $validNumber = false;
        foreach ($preambule as $key1 => $value1) {
            foreach ($preambule as $key2 => $value2) {
                if(($value1 != $value2) && ($value1 + $value2 == $value)){
                    $validNumber = true;
                }
            }
        }
        if(!$validNumber && $firstWrongNumber == 0){
            $firstWrongNumber = $value;
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump($firstWrongNumber);
/*** Part 2 ***/

$file = fopen($filename, 'r');
$numbers = [];
$prembuleLength = 25;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $numbers[] = $line;
}

fclose($file);

$answerPart2 = 0;

foreach ($numbers as $key => $value) {
    $sum = 0;
    $index = $key;
    $minNumber = 9999999999;
    $maxNumber = 0;
    while($sum < $firstWrongNumber){
        $sum += $numbers[$index];
        if($minNumber > $numbers[$index]){
            $minNumber = $numbers[$index];
        }
        if($maxNumber < $numbers[$index]){
            $maxNumber = $numbers[$index];
        }
        $index++;
    }

    if($sum == $firstWrongNumber){
        $answerPart2 = $minNumber + $maxNumber;
        break;
    }
}

var_dump("---- Partie 2 ----");
var_dump($answerPart2);