<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$fresh = [];
$freshItem = 0;
$steelFresh = true;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if(strlen($line) == 0){
        $steelFresh = false;
    }
    elseif($steelFresh){
        $fresh[] = $line;
    }
    elseif(!$steelFresh){
        foreach ($fresh as $key => $value) {
            if(checkIsInInterval($value, $line)){
                $freshItem++;
                break;
            }
        }
    }
}

fclose($file);

var_dump("---- Partie 1 ----");
var_dump($freshItem);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$freshConsiderItem = 0;
$interval = [];
$steelFresh = true;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if(strlen($line) == 0){
        $steelFresh = false;
    }
    elseif($steelFresh){ 
        $findInterval = false;
        foreach ($interval as $key => $value) {

            if(!$findInterval){
                $returnValue = whereIntervalIsOnOtherInterval($value, $line);
                //var_dump($returnValue . "==");
                if($returnValue){ // J'ai deux interval qui ne sont pas l'un dans l'autre
                    $interval[$key] = $returnValue;
                    $findInterval = true;
                }
            }
        }
        if(!$findInterval){
            $interval[] = $line;
        }

        $isIntervalChange = true;
        while($isIntervalChange){
            $numberOfIntervalChange = 0;
            foreach ($interval as $keyA => $valueA) {
                foreach ($interval as $keyB => $valueB) {
                    if($keyA != $keyB){
                        $returnValue = whereIntervalIsOnOtherInterval($valueA, $valueB);
                        if($returnValue){ // J'ai deux interval qui ne sont pas l'un dans l'autre
                            $interval[$keyA] = $returnValue;
                            unset($interval[$keyB]);
                            $numberOfIntervalChange++;
                            break(2);
                        }
                    }
                }
            }
            if($numberOfIntervalChange == 0){
                $isIntervalChange = false;
            }
        }
    }
    elseif(!$steelFresh){
        // lol part 2
        break;
    }
}

fclose($file);

var_dump("---- Partie 2 ----");
var_dump(countInterval($interval));



function checkIsInInterval($interval, $value){
    [$min, $max] = explode('-',$interval);
    if($value >= $min && $value <= $max){
        return true;
    }
    return false;
}

function whereIntervalIsOnOtherInterval($intervalA, $intervalB){
    [$minA, $maxA] = explode('-', $intervalA);
    [$minB, $maxB] = explode('-',$intervalB);

    $croise = false;
    $up = false;
    $down = false;

    //var_dump("$minA, $maxA / $minA, $maxB");

    if($minB >= $minA && $minB <= $maxA){
        // min B est a l'interieur de intervale A
        $croise = true;
        $down = true;
    }

    if($maxB >= $minA && $maxB <= $maxA){
        // max B est a l'interieur de intervale A
        $croise = true;
        $up = true;
    }

    if($croise){ // mon interval B est forcement commu avec mon interval A
        if($up && $down){
            // Mon interval B est a l'interieur de mon interval A
            return $intervalA;
        }
        elseif($up && !$down){
            // le min de l'interval B est a l'exterieur de A, mais le max est a l'interieur
            return "$minB-$maxA";
        }
        elseif(!$up && $down){
            // le min de l'interval B est a l'interieur de A, mais le max est a l'exterieur
            return "$minA-$maxB";
        }
    }
    else{
        return false;
    }

}

function countInterval($interval){
    $count = 0;
    foreach ($interval as $key => $value) {
        [$min, $max] = explode('-', $value);
        $count += ($max + 1) - $min;
    }
    return $count;
}