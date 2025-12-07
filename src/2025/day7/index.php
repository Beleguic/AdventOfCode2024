<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$splitTime = 0;
$previousLine = [];
$index = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = str_split($line);
    if($index == 0){
        $previousLine = $line;
    }
    else{
        $previousLineTemp = [];
        //var_dump("@@@@@@@@@@@@@@@@@@@@" . $index);
        foreach ($line  as $key => $value) {
            if($value == '^' && $previousLine[$key] == '|'){
                $previousLineTemp[$key] = '^';
                $previousLineTemp[$key - 1] = '|';
                $previousLineTemp[$key + 1] = '|';
                $splitTime++;
            }
            elseif(($value == '.' && $previousLine[$key] == '|') || ($previousLine[$key] == 'S')){
                $previousLineTemp[$key] = '|';
            }
            elseif(!isset($previousLineTemp[$key])){
                $previousLineTemp[$key] = '.';
            }
            //var_dump($previousLineTemp);
        }
        var_dump(implode('', $previousLine));
        $previousLine = $previousLineTemp;
    }
    $index++;
}

fclose($file);

var_dump("---- Partie 1 ----");
var_dump($splitTime);


/*** Part 2 ***/
$file = fopen($filename, 'r');
$splitTime = 0;
$previousLine = [];
$index = 0;
$count = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = str_split($line);
    if($index == 0){
        $previousLine = $line;
        foreach ($line as $key => $value) {
            if($value == 'S'){
                $count[$index][$key] = 1;
                break;
            }
        }
    }
    else{
        $previousLineTemp = [];
        //var_dump("@@@@@@@@@@@@@@@@@@@@" . $index);
        foreach ($line  as $key => $value) {
            if($value == '^' && $previousLine[$key] == '|'){
                $previousLineTemp[$key] = '^';
                $previousLineTemp[$key - 1] = '|';
                $previousLineTemp[$key + 1] = '|';
                $splitTime++;
                if(!isset($count[$index][$key - 1])){
                    $count[$index][$key - 1] = 0;
                }
                $count[$index][$key - 1] += $count[$index - 1][$key];
                if(!isset($count[$index][$key + 1])){
                    $count[$index][$key + 1] = 0;
                }
                $count[$index][$key + 1] += $count[$index - 1][$key];
                
            }
            elseif(($value == '.' && $previousLine[$key] == '|') || ($previousLine[$key] == 'S')){
                $previousLineTemp[$key] = '|';
                if(!isset($count[$index][$key])){
                    $count[$index][$key] = 0;
                }
                $count[$index][$key] += $count[$index - 1][$key];
            }
            elseif(!isset($previousLineTemp[$key])){
                $previousLineTemp[$key] = '.';
            }
            //var_dump($previousLineTemp);
        }
        $previousLine = $previousLineTemp;
    }
    $index++;
}

fclose($file);


var_dump("---- Partie 2 ----");
$countTotal = 0;
foreach (end($count) as $key => $value) {
    $countTotal += $value;
}
var_dump($countTotal);
exit;