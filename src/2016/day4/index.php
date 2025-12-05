<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

/*
    Séparé lettre, id et checksul
    compté les occurance 
    puis faire un tableau avec dans l'ordre d'apparition des lettre et de leur occurance
    et apores check avec le checksum si l'ordre des lettres est bon
    si real, additionnner l'id
*/

$file = fopen($filename, 'r');
$idRoom = 0;
while ($line = fgets($file)) {

    $occurance = [];
    $order = [];

    $line = str_replace("\n", "", $line);
    $lineExploded = explode('[', $line);
    $checksum = substr($lineExploded[1], 0, -1);
    $dataExploded = explode('-', $lineExploded[0]);
    $id = end($dataExploded);
    array_pop($dataExploded);
    $data = implode('', $dataExploded);

    //----

    $dataSplit = str_split($data);

    foreach ($dataSplit as $key => $value) {
        if(!isset($occurance[$value])){
            $occurance[$value] = 0;
        }
        $occurance[$value]++;
    }

    arsort($occurance);

    foreach ($occurance as $lettre => $nombre) {
        $order[$nombre][] = $lettre;
        sort($order[$nombre]);
    }

    $orderSort = "";
    foreach ($order as $nombre => $lettres) {
        foreach ($lettres as $key => $value) {
            $orderSort .= $value;
        }
    }

    $checksumCheck = substr($orderSort, 0, strlen($checksum));

    if($checksum == $checksumCheck){
        $idRoom += $id;
    }

}

var_dump($idRoom);

fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$cesar = "abcdefghijklmnopqrstuvwxyzabcdefghijklmnopqrstuvwxyz";

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $lineExploded = explode('[', $line);
    $checksum = substr($lineExploded[1], 0, -1);
    $dataExploded = explode('-', $lineExploded[0]);
    $id = end($dataExploded);
    array_pop($dataExploded);
    $data = implode('-', $dataExploded);

    $data = str_split($data);

    $decrypt = "";
    $modulo = $id % 26;
    foreach ($data as $key => $value) {
        if($value == '-'){
            $decrypt .= " ";
        }
        else{
            $haveLetter = false;
            foreach (str_split($cesar) as $cesarKey => $cesarValue) {
                if($value == $cesarValue && !$haveLetter){
                    $haveLetter = true;
                    $decrypt .= $cesar[$cesarKey + $modulo];
                }
            }
        }
    }

    if($decrypt == "northpole object storage"){
        var_dump($id);
    }

}

fclose($file);

var_dump("---- Partie 2 ----");