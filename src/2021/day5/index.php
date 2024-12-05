<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

/*$file = fopen($filename, 'r');
$table = [];

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $combi = explode(" -> ", $line);
    $combi1 = explode(",", $combi[0]);
    $combi2 = explode(",", $combi[1]);
    $x1 = $combi1[0];
    $y1 = $combi1[1];
    $x2 = $combi2[0];
    $y2 = $combi2[1];

    if($x1 == $x2 || $y1 == $y2) {
        if($x1 == $x2){
            // Remplir toute les y
            $numberY = abs($y1 - $y2);
            $minY = min($y1, $y2);
            for($i = 0; $i <= $numberY; $i++){
                $y = $minY + $i;
                if(!isset($table[$x1][$y])) {
                    $table[$x1][$y] = 1;
                }
                else{
                    $table[$x1][$y]++;
                }
            }
        }
        if($y1 == $y2){
            // Remplir toute les x
            $numberX = abs($x1 - $x2);
            $minX = min($x1, $x2);
            for($i = 0; $i <= $numberX; $i++){
                $x = $minX + $i;
                if(!isset($table[$x][$y1])) {
                    $table[$x][$y1] = 1;
                }
                else{
                    $table[$x][$y1]++;
                }
            }
        }
    }
}

fclose($file);

$numberOfGoodPosition = 0;
foreach($table as $x => $y){
    foreach($y as $y => $value){
        if($value > 1){
            $numberOfGoodPosition++;
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump($numberOfGoodPosition);
/*** Part 2 ***/

$file = fopen($filename, 'r');

$table = [];

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $combi = explode(" -> ", $line);
    $combi1 = explode(",", $combi[0]);
    $combi2 = explode(",", $combi[1]);
    $x1 = $combi1[0];
    $y1 = $combi1[1];
    $x2 = $combi2[0];
    $y2 = $combi2[1];

    if($x1 == $x2 || $y1 == $y2 || (abs($x1 - $y1) == abs($x2 - $y2))) {
        if($x1 == $x2){
            // Remplir toute les y
            $numberY = abs($y1 - $y2);
            $minY = min($y1, $y2);
            for($i = 0; $i <= $numberY; $i++){
                $y = $minY + $i;
                if(!isset($table[$x1][$y])) {
                    $table[$x1][$y] = 1;
                }
                else{
                    $table[$x1][$y]++;
                }
            }
        }
        if($y1 == $y2){
            // Remplir toute les x
            $numberX = abs($x1 - $x2);
            $minX = min($x1, $x2);
            for($i = 0; $i <= $numberX; $i++){
                $x = $minX + $i;
                if(!isset($table[$x][$y1])) {
                    $table[$x][$y1] = 1;
                }
                else{
                    $table[$x][$y1]++;
                }
            }
        }
        if(abs($x1 - $y1) == abs($x2 - $y2)){
            // Remplir toute les x
            var_dump($x1 . ' ' . $y1 . ' => ' . $x2 . ' ' . $y2);
            $numberX = abs($x1 - $x2);
            $minX = min($x1, $x2);
            $minY = min($y1, $y2);
            for($i = 0; $i <= $numberX; $i++){
                $x = $minX + $i;
                $y = $minY + $i;
                if(!isset($table[$x][$y])) {
                    $table[$x][$y] = 1;
                }
                else{
                    $table[$x][$y]++;
                }
            }
        }
    }
}

fclose($file);

$numberOfGoodPosition = 0;
foreach($table as $x => $y){
    foreach($y as $y => $value){
        if($value > 1){
            $numberOfGoodPosition++;
        }
    }
}

var_dump("---- Partie 2 ----");
var_dump($numberOfGoodPosition);