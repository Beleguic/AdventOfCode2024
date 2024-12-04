<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $number = explode(" ", $line);

    $safe = calculateSafer($number);
    if($safe){
        $safeReport++;
    }
}

fclose($file);

var_dump("---- Partie 1 ----");
var_dump("Safe Report : " . $safeReport);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {

    $line = str_replace("\n", "", $line);
    $number = explode(" ", $line);
    $safeReportBool = false;

    foreach($number as $key => $value){
        $numberTemp = $number;
        unset($numberTemp[$key]);
        $numberTemp = array_values($numberTemp);
        $safe = calculateSafer($numberTemp);
        if($safe){
            $safeReportBool = true;
        }
    }

    if($safeReportBool){
        $safeReport++;
    }
}

fclose($file);

var_dump("---- Partie 2 ----");
var_dump("Safe Report : " . $safeReport);

function calculateSafer($number){

    $decresing = false;
    $increasing = false;
    $choosing = true;

    foreach($number as $key => $value) {
        if(isset($number[$key + 1]) && $choosing) {
            if($value > $number[$key + 1]) {
                $decresing = true;
                $choosing = false;
            } else if($value < $number[$key + 1]) {
                $increasing = true;
                $choosing = false;
            }
            else{
                return false;
            }
        }
        
        if(isset($number[$key + 1])){
            if($increasing){
                if(!($value < $number[$key + 1] && $number[$key + 1] != $value && ($number[$key + 1] - $value) < 4)){
                    return false;
                }

            }
            elseif($decresing){
                if(!($value > $number[$key + 1] && $number[$key + 1] != $value && ($value - $number[$key + 1]) < 4)){
                    return false;
                }
            }
        }
    }

    return true;


}
