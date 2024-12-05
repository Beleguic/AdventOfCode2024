<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');

$rule = [];
$bookRule = [];

$getRule = true;

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if($line == "") {
        $getRule = false;
    }

    if($getRule) {
        $rule[] = explode('|',$line);
    } else {
        if($line == "") {
            continue;
        }
        $bookRule[] = explode(',',$line);
    }
}

fclose($file);

$correctPageOrder = [];

foreach ($bookRule as $key => $value) {
    $resultPageOrder = defineIfRuleIsOk($rule, $value);
    if($resultPageOrder) {
        $correctPageOrder[] = $value;
    }
}

$middleNumber = defineMiddleNumber($correctPageOrder);
$result = calculateResult($middleNumber);

var_dump("---- Partie 1 ----");
var_dump($result);

/*** Part 2 ***/

$file = fopen($filename, 'r');

$rule = [];
$bookRule = [];

$getRule = true;

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if($line == "") {
        $getRule = false;
    }

    if($getRule) {
        $rule[] = explode('|',$line);
    } else {
        if($line == "") {
            continue;
        }
        $bookRule[] = explode(',',$line);
    }
}

fclose($file);

$incorrectPageOrder = [];

foreach ($bookRule as $key => $value) {
    $resultPageOrder = defineIfRuleIsOk($rule, $value);
    if(!$resultPageOrder) {
        $incorrectPageOrder[] = $value;
    }
}

foreach ($incorrectPageOrder as $key => $value) {
    $incorrectPageOrder[$key] = reOrderPage($rule, $value);
}

$middleNumber = defineMiddleNumber($incorrectPageOrder);
$result = calculateResult($middleNumber);

var_dump("---- Partie 2 ----");
var_dump($result);

function defineIfRuleIsOk($rule, $bookRule) {

    $isRuleOk = true;

    $listOfRuleUsed = [];

    $valuePossible = [];
    foreach ($bookRule as $key => $value) {
        if(isset($bookRule[$key+1])){
            $valuePossible = array_slice($bookRule, $key);
        }
        foreach ($rule as $key2 => $value2) {
            if(in_array($value2[0], $valuePossible) && in_array($value2[1], $valuePossible)) {
                $listOfRuleUsed[] = $value2;
            }
        }

        $firstNumber = $valuePossible[0];
        foreach ($listOfRuleUsed as $ruled) {
            foreach($valuePossible as $valuePossibleSolo) {
                if($valuePossibleSolo == $ruled[0] && $firstNumber == $ruled[1]){
                    return false;
                }
            }
        }
         
    }

    return $isRuleOk;
}

function defineMiddleNumber($books){

    $middleNumber = [];

    foreach ($books as $key => $book) {
        $middlePosition = round((sizeof($book)/2) - 1);
        $middleNumber[] = $book[$middlePosition];
    }

    return $middleNumber;
    
}

function calculateResult($middleNumber) {
    $result = 0;

    foreach ($middleNumber as $key => $value) {
        $result += $value;
    }

    return $result;
}

function reOrderPage($rule, $bookRule) {

    $isRuleOk = true;
    $listOfRuleUsed = [];
    $valuePossible = [];

    foreach ($bookRule as $key => $value) {
        if(isset($bookRule[$key+1])){
            $valuePossible = array_slice($bookRule, $key);
        }
        foreach ($rule as $key2 => $value2) {
            if(in_array($value2[0], $valuePossible) && in_array($value2[1], $valuePossible)) {
                $listOfRuleUsed[] = $value2;
            }
        }
    }

    while(!defineIfRuleIsOk($rule, $bookRule)) {
        $bookRule = reOrderPageProcess($listOfRuleUsed, $bookRule);
    }

    return $bookRule;
}

function reOrderPageProcess($rule, $bookRule){

    foreach($rule as $key => $value) {
        
        $key1 = getKeyOfNumber($bookRule, $value[0]);
        $key2 = getKeyOfNumber($bookRule, $value[1]);

        if($key2 < $key1) {
            $bookRule = swap($bookRule, $key1, $key2);
        }

    }

    return $bookRule;

}

function getKeyOfNumber($array, $number){
    foreach($array as $key => $value){
        if($value == $number){
            return $key;
        }
    }
}

function swap($array, $key1, $key2) {
    $temp = $array[$key1];
    $array[$key1] = $array[$key2];
    $array[$key2] = $temp;
    return $array;
}
