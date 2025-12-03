<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$passportValid = 0;
$passport = [];
$passportNumber = 0;
$passport[$passportNumber] = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if(strlen($line) == 0){
        
        $obligatoryElement = validatePassPort($passport[$passportNumber]);

        if($obligatoryElement == 7){
            $passportValid++;
        }

        $passportNumber++;
        $passport[$passportNumber] = [];
    }
    else{
        $data = explode(' ', $line);
        $passport[$passportNumber] = array_merge($passport[$passportNumber], $data);
    }
}

$obligatoryElement = validatePassPort($passport[$passportNumber]);

if($obligatoryElement == 7){
    $passportValid++;
}

fclose($file);

var_dump("---- Partie 1 ----");
var_dump($passportValid);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$passportValid = 0;
$passport = [];
$passportNumber = 0;
$passport[$passportNumber] = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if(strlen($line) == 0){
        
        $obligatoryElement = validatePassPort($passport[$passportNumber]);

        if($obligatoryElement == 7){
            $dataCheck = validateDataOfPassPort($passport[$passportNumber]);
            if($dataCheck == 7){
                $passportValid++;
            }
        }

        $passportNumber++;
        $passport[$passportNumber] = [];
    }
    else{
        $data = explode(' ', $line);
        $passport[$passportNumber] = array_merge($passport[$passportNumber], $data);
    }
}

$obligatoryElement = validatePassPort($passport[$passportNumber]);

if($obligatoryElement == 7){
    $dataCheck = validateDataOfPassPort($passport[$passportNumber]);
    if($dataCheck == 7){
        $passportValid++;
    }
}

fclose($file);

var_dump("---- Partie 2 ----");
var_dump($passportValid);

function validatePassPort($passport){

    $obligatoryElement = 0;
    foreach ($passport as $key => $value) {
        [$element,$data] = explode(':', $value);
        if($element != 'cid'){
            $obligatoryElement++;
        }
    }

    return $obligatoryElement;

}

function validateDataOfPassPort($passport){

    $obligatoryElement = 0;
    foreach ($passport as $key => $value) {
        [$element,$data] = explode(':', $value);
        if($element == 'byr' && validateNumber($data, 4, 1920, 2002)){
            $obligatoryElement++;
        }
        elseif($element == 'iyr' && validateNumber($data, 4, 2010, 2020)){
            $obligatoryElement++;
        }
        elseif($element == 'eyr' && validateNumber($data, 4, 2020, 2030)){
            $obligatoryElement++;
        }
        elseif($element == 'hgt' && validateHeight($data)){
            $obligatoryElement++;
        }
        elseif($element == 'hcl' && validateColor($data)){
            $obligatoryElement++;
        }
        elseif($element == 'ecl' && validateEyeColor($data)){
            $obligatoryElement++;
        }
        elseif($element == 'pid' && validatePassPortId($data)){
            $obligatoryElement++;
        }
    }

    return $obligatoryElement;

}


function validateNumber($value, $length, $min, $max){

    if(!is_numeric($value)){
        return false;
    }

    if(strlen($value) != $length){
        return false;
    }

    if(!($value >= $min && $value <= $max)){
        return false;
    }

    return true;

}

function validateHeight($value){

    $unite = substr($value, -2);
    $height = substr($value,0,-2);

    if($unite == 'cm'){
        return validateNumber($height, 3, 150, 193);
    }
    elseif($unite == 'in'){
        return validateNumber($height, 2, 59, 76);
    }
    else{
        return false;
    }

    return false;

}

function validateColor($value){

    $value = str_split($value);

    if($value[0] != "#"){
        return false;
    }

    array_shift($value);

    foreach ($value as $key1 => $value1) {
        if(!((ord($value1) >= 48 && ord($value1) <= 57) || (ord($value1) >= 97 && ord($value1) <= 102))){
            return false;
        }
    }

    return true;


}

function validatePassPortId($value){

    if(is_numeric($value) && strlen($value) == 9){
        return true;
    }
    return false;
}

function validateEyeColor($value){

    if($value == 'amb'){
        return true;
    }
    elseif($value == 'blu'){
        return true;
    }
    elseif($value == 'brn'){
        return true;
    }
    elseif($value == 'gry'){
        return true;
    }
    elseif($value == 'grn'){
        return true;
    }
    elseif($value == 'hzl'){
        return true;
    }
    elseif($value == 'oth'){
        return true;
    }
    return false;

}