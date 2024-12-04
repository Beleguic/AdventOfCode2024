<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$corruptedFile = '';
while ($line = fgets($file)) {
    $corruptedFile .= $line;  
}

fclose($file);

$corruptedFile = str_replace("\n", "", $corruptedFile);
$corruptedFile = explode("mul(", $corruptedFile);

var_dump($corruptedFile);

$resultCorrupted = 0;

foreach($corruptedFile as $key => $value) {
    $endOfMul = explode(")", $value)[0];
    $getNumbers = explode(",", $endOfMul);

    if(sizeof($getNumbers) == 2){
        if(is_numeric($getNumbers[0]) && is_numeric($getNumbers[1]) && strlen($getNumbers[0]) < 4 && strlen($getNumbers[1]) < 4){
            $resultCorrupted += $getNumbers[0] * $getNumbers[1];
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump("Result : " . $resultCorrupted);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$corruptedFile = '';
while ($line = fgets($file)) {
    $corruptedFile .= $line;  
}

fclose($file);

$corruptedFile = str_replace("\n", "", $corruptedFile);
$corruptedFile = explode("mul(", $corruptedFile);

$resultCorrupted = 0;
$do = true;

foreach($corruptedFile as $key => $value) {

    $endOfMul = explode(")", $value)[0];
    $getNumbers = explode(",", $endOfMul);

    if($do){
        if(sizeof($getNumbers) == 2){
            if(is_numeric($getNumbers[0]) && is_numeric($getNumbers[1]) && strlen($getNumbers[0]) < 4 && strlen($getNumbers[1]) < 4){
                $resultCorrupted += $getNumbers[0] * $getNumbers[1];
            }
        }
    }

    $length = strlen($value);

    while(strpos($value, 'do()') !== false || strpos($value, "don't()") !== false){
        $posDo = strpos($value, 'do()');
        $posDont = strpos($value, "don't()");

        if($posDo > $posDont){
            $do = true;
            $value = substr($value, $posDo + 4);
        }
        else{
            $do = false;
            $value = substr($value, $posDont + 7);
        }
    }
}

var_dump("---- Partie 2 ----");
var_dump("Result : " . $resultCorrupted);

