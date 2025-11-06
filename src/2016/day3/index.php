<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$possibleTriangle = 0;

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $sideTriangle = explode(' ', $line);
    rsort($sideTriangle);

    if(($sideTriangle[1] + $sideTriangle[2]) > $sideTriangle[0]){
        $possibleTriangle++;
    }
}

var_dump($possibleTriangle);

fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$file = fopen($filename, 'r');
$possibleTriangle = 0;
$cpt = 0;
$triangleTemp = [];
while ($line = fgets($file)) {

    $line = str_replace("\n", "", $line);
    
    $sideTriangle = explode(' ', $line);
    $sideTriangle = array_filter($sideTriangle, function ($value) {
        return $value !== '';
    });

    $sideTriangle = array_values($sideTriangle);

    $triangleTemp[0][] = $sideTriangle[0];
    $triangleTemp[1][] = $sideTriangle[1];
    $triangleTemp[2][] = $sideTriangle[2];

    $cpt++;
    if($cpt % 3 == 0){
        foreach ($triangleTemp as $key => $value) {
            rsort($value);
            if(($value[1] + $value[2]) > $value[0]){
                $possibleTriangle++;
            }
        }

        $triangleTemp = [];
    }
    
}

var_dump($possibleTriangle);

fclose($file);

var_dump("---- Partie 2 ----");