<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

/*
    Définisse si j'ai un abba a l'exterieur des [] ET si j'ai pas d'abba a l'intérieur des []

    Lire un par un les carcatere, reperer les abba et definir si a l'interieur ou a l'exterier

    il faut au moin  abba a l'exterieur et 0 abba a l'interieur pour que cela fonctionne
*/

$file = fopen($filename, 'r');
$IPV7TLS = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    $lineSplit = str_split($line);

    $insideBracket = false;
    $abbaPresentInside = false;
    $abbaPresentOutside = false;

    foreach ($lineSplit as $key => $value) {
        if(isset($lineSplit[$key + 1]) && isset($lineSplit[$key + 2]) && isset($lineSplit[$key + 3])){
            if($value == $lineSplit[$key + 3] && $lineSplit[$key + 2] == $lineSplit[$key + 1] && $lineSplit[$key + 2] != $lineSplit[$key + 3]){
                //J'ai un ABBA

                if($insideBracket){
                    $abbaPresentInside = true;
                }
                else{
                    $abbaPresentOutside = true;
                }
            }

            if($value == '['){
                $insideBracket = true;
            }
            elseif($value == ']'){
                $insideBracket = false;
            }
        }
    }

    if(!$abbaPresentInside && $abbaPresentOutside){
        $IPV7TLS++;
    }

}

var_dump($IPV7TLS);

fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$file = fopen($filename, 'r');
$SSL = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    $lineSplit = str_split($line);

    $insideBracket = false;

    $abaInsideBracket = [];
    $abaOutideBracket = [];

    foreach ($lineSplit as $key => $value) {
        if(isset($lineSplit[$key + 1]) && isset($lineSplit[$key + 2]) && isset($lineSplit[$key + 3])){
            if($value == $lineSplit[$key + 2] && $lineSplit[$key + 2] != $lineSplit[$key + 1]){
                //J'ai un ABA

                if($insideBracket){
                    $abaInsideBracket[] = $value.$lineSplit[$key + 1].$lineSplit[$key + 2];
                }
                else{
                    $abaOutideBracket[] = $value.$lineSplit[$key + 1].$lineSplit[$key + 2];
                }
            }

            if($value == '['){
                $insideBracket = true;
            }
            elseif($value == ']'){
                $insideBracket = false;
            }
        }
    }

    $abaInsideBracketInverse = [];

    foreach ($abaInsideBracket as $key => $value) {
        $abaInsideBracketInverse[] = $value[1].$value[0].$value[1];
    }

    foreach ($abaInsideBracketInverse as $key => $value) {
        foreach ($abaOutideBracket as $key2 => $value2) {
            if($value == $value2){
                $SSL++;
            }
        }
    }

}

var_dump($SSL);

fclose($file);

var_dump("---- Partie 2 ----");