<?php

/*** Part 1 ***/
/*echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

/*$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

var_dump("---- Partie 2 ----");

*/

/*** Part 1 ***/

echo("<pre>");

$idDoor = "ugkcyxxp";
//$idDoor = "abc";
$index = 0;

$password = "";

while (strlen($password) < 8){
    $md5tohash = $idDoor.$index;
    $md5 = md5($md5tohash);

    $zero = substr($md5, 0,5);
    $passwordPart = substr($md5, 5,1);

    if($zero === "00000"){
        $password .= $passwordPart;
    }

    $index++;
}


var_dump("---- Partie 1 ----");
var_dump($password);

/*** Part 2 ***/

$index = 0;
$passwordFiled = true;
$password = "________";

while ($passwordFiled){
    $md5tohash = $idDoor.$index;
    $md5 = md5($md5tohash);

    $zero = substr($md5, 0,5);
    $passwordindex = substr($md5, 5,1);
    $passwordPart = substr($md5, 6,1);

    if($zero === "00000" && $passwordindex >= 0 && $passwordindex < 8){
        if($password[$passwordindex] == "_"){
            $password[$passwordindex] = $passwordPart;
        }
    }

    if(!str_contains($password, '_')){
        $passwordFiled = false;
    }

    $index++;
}

var_dump("---- Partie 2 ----");
var_dump($password);
