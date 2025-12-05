<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$passwordOK = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    [$requirement, $password] = explode(': ', $line);
    [$interval, $letter] = explode(' ', $requirement);
    [$min, $max] = explode('-', $interval);
    $password = str_split($password);

    $count = 0;
    foreach ($password as $key => $value) {
        if($value == $letter){
            $count ++;
        }
    }

    if($count >= $min && $count <= $max){
        $passwordOK++;
    }
}

fclose($file);

var_dump("---- Partie 1 ----");
var_dump($passwordOK);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$passwordOK = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    [$requirement, $password] = explode(': ', $line);
    [$interval, $letter] = explode(' ', $requirement);
    [$pos1, $pos2] = explode('-', $interval);
    $password = str_split($password);

    if(($password[$pos1 - 1] == $letter && $password[$pos2 - 1] != $letter) || ($password[$pos1 - 1] != $letter && $password[$pos2 - 1] == $letter)){
        $passwordOK++;
    }
}

fclose($file);

var_dump("---- Partie 2 ----");
var_dump($passwordOK);