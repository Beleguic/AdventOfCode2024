<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$digicode = [0 => [0 => '1', 1 => '2', 2 => '3'], 1 => [0 => '4', 1 => '5', 2 => '6'], 2 => [0 => '7', 1 => '8', 2 => '9']];

$x = 1;
$y = 1;

$maxX = 2;
$maxY = 2;
$minX = 0;
$minY = 0;

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    foreach (str_split($line) as $key => $value) {
        if($value == 'R'){
            if(($y + 1) <= $maxY){
                $y++;
            }
        }
        elseif($value == 'U'){
            if(($x - 1) >= $minX){
                $x--;
            }
        }
        elseif($value == 'D'){
            if(($x + 1) <= $maxX){
                $x++;
            }
        }
        elseif($value == 'L'){
            if(($y - 1) >= $minY){
                $y--;
            }
        }
    }
    var_dump($digicode[$x][$y]);
}

fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$x = 2;
$y = 0;

$maxX = 4;
$maxY = 4;
$minX = 0;
$minY = 0;

$digicodeP2 = [0 => [0 => '', 1 => '', 2 => '1', 3 => '', 4 => ''], 1 => [0 => '', 1 => '2', 2 => '3', 3 => '4', 4 => ''], 2 => [0 => '5', 1 => '6', 2 => '7', 3 => '8', 4 => '9'], 3 => [0 => '', 1 => 'A', 2 => 'B', 3 => 'C', 4 => ''], 4=> [0 => '', 1 => '', 2 => 'D', 3 => '', 4 => '']];

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {

    $line = str_replace("\n", "", $line);
    foreach (str_split($line) as $key => $value) {
        if($value == 'R'){
            if(($y + 1) <= $maxY && $digicodeP2[$x][$y + 1] != ''){
                $y++;
            }
        }
        elseif($value == 'U'){
            if(($x - 1) >= $minX && $digicodeP2[$x - 1][$y] != ''){
                $x--;
            }
        }
        elseif($value == 'D'){
            if(($x + 1) <= $maxX && $digicodeP2[$x + 1][$y] != ''){
                $x++;
            }
        }
        elseif($value == 'L'){
            if(($y - 1) >= $minY && $digicodeP2[$x][$y - 1] != ''){
                $y--;
            }
        }
    }
    var_dump($digicodeP2[$x][$y]);

}

fclose($file);

var_dump("---- Partie 2 ----");