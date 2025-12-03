<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$accumulator = 0;
$instructions = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    [$instruction, $where] = explode(' ', $line);

    $instructions[] = ['instruction' => $instruction, 'where' => $where, 'alreadyUse' => false];
}
fclose($file);

$alreadyUse = false;
$pointeur = 0;
while(!$alreadyUse){

    $instruction = $instructions[$pointeur]['instruction'];
    $where = $instructions[$pointeur]['where'];
    $alreadyUse = $instructions[$pointeur]['alreadyUse'];

    $sign = substr($where,0,1);
    $number = substr($where,1);

    if($sign == '+'){
        $where = $number;
    }
    elseif($sign == '-'){
        $where = 0 - $number;
    }

    if(!$alreadyUse){
        $instructions[$pointeur]['alreadyUse'] = true;
    
        if($instruction == 'acc'){
            $accumulator += $where;
            $pointeur++;
        }
        elseif($instruction == 'jmp'){
            $pointeur += $where;
        }
        elseif($instruction = 'nop'){
            $pointeur++;
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump($accumulator);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$instructions = [];
$numberOfNopOrJmp = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    [$instruction, $where] = explode(' ', $line);
    if($instruction == 'jmp' || $instruction == 'nop'){
        $numberOfNopOrJmp++;
    }
    $instructions[] = ['instruction' => $instruction, 'where' => $where, 'alreadyUse' => false];
}
fclose($file);

$alreadyUse = false;
$lastJmpOrNopChangeIndex = 0;
$instructionsSave = $instructions;
$goodAccumulator = 0;

for ($i=0; $i < $numberOfNopOrJmp; $i++) {

    $instructions = $instructionsSave;

    foreach ($instructions as $key => $value) {
        $instruction = $value['instruction'];
        if($key > $lastJmpOrNopChangeIndex && ($instruction == 'jmp' || $instruction == 'nop')){
            $lastJmpOrNopChangeIndex = $key;
            if($instructions[$lastJmpOrNopChangeIndex]['instruction'] == 'jmp'){
                $instructions[$lastJmpOrNopChangeIndex]['instruction'] = 'nop';
            }
            else{
                $instructions[$lastJmpOrNopChangeIndex]['instruction'] = 'jmp';
            }
            break;
        }
    }

    $alreadyUse = false;
    $accumulator = 0;
    $iteration = 0;
    $pointeur = 0;

    while(!$alreadyUse && isset($instructions[$pointeur])){

        $instruction = $instructions[$pointeur]['instruction'];
        $where = $instructions[$pointeur]['where'];
        $alreadyUse = $instructions[$pointeur]['alreadyUse'];

        $sign = substr($where,0,1);
        $number = substr($where,1);

        if($sign == '+'){
            $where = $number;
        }
        elseif($sign == '-'){
            $where = 0 - $number;
        }

        if(!$alreadyUse){
            $instructions[$pointeur]['alreadyUse'] = true;
        
            if($instruction == 'acc'){
                $accumulator += $where;
                $pointeur++;
            }
            elseif($instruction == 'jmp'){
                $pointeur += $where;
            }
            elseif($instruction = 'nop'){
                $pointeur++;
            }
        }

        if(!isset($instructions[$pointeur])){
            $goodAccumulator = $accumulator;
            break(2);
        }

        $iteration++;
    }

    
}

var_dump("---- Partie 2 ----");
var_dump($goodAccumulator);