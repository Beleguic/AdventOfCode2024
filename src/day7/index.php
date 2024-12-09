<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$calibrationList = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $calibrationTemp = explode(': ', $line);
    $calibrationCalcul = explode(' ', $calibrationTemp[1]);
    $calibrationList[] = ['result' => $calibrationTemp[0], 'numberOfCalcul' => $calibrationCalcul];
}

fclose($file);
$trueCalibration = 0;
foreach($calibrationList as $calibrationNumber => $calibrationData){

    $solutions = [];

    foreach($calibrationData['numberOfCalcul'] as $value){
        $solutionTemp = [];
        if(sizeof($solutions) == 0){
            array_push($solutionTemp, $value);
        }
        else{
            foreach($solutions as $key => $solution){
                array_push($solutionTemp, $solution * $value);
                array_push($solutionTemp, $solution + $value);
            }
        }

        $solutions = $solutionTemp;

    }

    $resultAlreadyDone = false;
    foreach($solutions as $value){
        if($value == $calibrationData['result'] && !$resultAlreadyDone){
            $resultAlreadyDone = true;
            $trueCalibration += $calibrationData['result'];
        }
    }

}

var_dump("---- Partie 1 ----");
var_dump("Number of Good Calibration : " . $trueCalibration);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$calibrationList = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $calibrationTemp = explode(': ', $line);
    $calibrationCalcul = explode(' ', $calibrationTemp[1]);
    $calibrationList[] = ['result' => $calibrationTemp[0], 'numberOfCalcul' => $calibrationCalcul];
}

fclose($file);
$trueCalibration = 0;
foreach($calibrationList as $calibrationNumber => $calibrationData){

    $solutions = [];

    foreach($calibrationData['numberOfCalcul'] as $value){
        $solutionTemp = [];
        if(sizeof($solutions) == 0){
            array_push($solutionTemp, $value);
        }
        else{
            foreach($solutions as $key => $solution){
                array_push($solutionTemp, $solution * $value);
                array_push($solutionTemp, $solution + $value);
                array_push($solutionTemp, $solution . $value);
            }
        }
        
        $solutions = $solutionTemp;

    }

    $resultAlreadyDone = false;
    foreach($solutions as $value){
        if($value == $calibrationData['result'] && !$resultAlreadyDone){
            $resultAlreadyDone = true;
            $trueCalibration += $calibrationData['result'];
        }
    }

}

var_dump("---- Partie 2 ----");
var_dump("Number of Good Calibration : " . $trueCalibration);