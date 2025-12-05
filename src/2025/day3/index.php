<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
<<<<<<< HEAD
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



=======
$totatJoltage = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    // Position du premier
    // pour le premier passage,ne pas prendre en compte le derniere caractere
    // pour le deuxieme, commencer uniquement apres la position du premier
    $batterieBank = str_split($line);

    $firstNumber = 0;
    $positionFirst = -1;
    $joltage = "";
    
    $lastBatterie = sizeof($batterieBank) - 1;
    foreach ($batterieBank as $key => $value) {
        if($key != $lastBatterie){
            if($value > $firstNumber){
                $firstNumber = $value;
                $positionFirst = $key;
            }
        }
    }
    $secondNumber = 0;
    foreach ($batterieBank as $key => $value) {
        if($key > $positionFirst){
            if($value > $secondNumber){
                $secondNumber = $value;
            }
        }
    }

    $joltage = $firstNumber.$secondNumber;

    $totatJoltage += $joltage;
>>>>>>> 0349dc4b4786af03c3715c1ecc30795f12b0a53e
}

fclose($file);

var_dump("---- Partie 1 ----");
<<<<<<< HEAD
=======
var_dump($totatJoltage);
>>>>>>> 0349dc4b4786af03c3715c1ecc30795f12b0a53e

/*** Part 2 ***/

$file = fopen($filename, 'r');
<<<<<<< HEAD
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);


=======
$totatJoltage = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    $batterieBank = str_split($line);

    $joltage = "";
    $positionFirst = -1;
    $numberOfBatteryOn = 12;

    for ($i=$numberOfBatteryOn; $i > 0; $i--) { 
        $lastBatterie = sizeof($batterieBank) - $i + 1;

        $firstNumber = 0;

        foreach ($batterieBank as $key => $value) {
            if($key < $lastBatterie && $key > $positionFirst){
                if($value > $firstNumber){
                    $firstNumber = $value;
                    $positionFirst = $key;
                }
            }
        }


        $joltage .= $firstNumber;
    }

    $totatJoltage += $joltage;
>>>>>>> 0349dc4b4786af03c3715c1ecc30795f12b0a53e

}

fclose($file);

<<<<<<< HEAD
var_dump("---- Partie 2 ----");
=======
var_dump("---- Partie 2 ----");
var_dump($totatJoltage);
>>>>>>> 0349dc4b4786af03c3715c1ecc30795f12b0a53e
