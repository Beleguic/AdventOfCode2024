<?php

/*** Part 1 ***/
echo("<pre>");

$width  = 50; // largeur
$height = 6;  // hauteur

// Une ligne de 50 points
$row = array_fill(0, $width, '.');

// Le tableau 2D : 6 lignes de 50 points
$grid = array_fill(0, $height, $row);

$filename = './input';

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $lineExploded = explode(' ', $line);

    $instruction = $lineExploded[0];

    if($instruction == 'rect'){
        [$y, $x] = explode('x', $lineExploded[1]);

        for ($i=0; $i < $x; $i++) { 
            for ($j=0; $j < $y; $j++) { 
                $grid[$i][$j] = "#";
            }
        }
    }
    else{
        $type = $lineExploded[1];
        $number = explode('=', $lineExploded[2])[1];
        $decalage = $lineExploded[4];

        var_dump($type, $number, $decalage);

        if($type == "row"){
            $max = $width;
            $row = $grid[$number];
            foreach ($row as $key => $value) {
                if($key + $decalage >= $max){
                    $newIndex = $key + $decalage - $max;
                }
                else{
                    $newIndex = $key + $decalage;
                }
                $grid[$number][$newIndex] = $value;
            }
        }
        else{
            $max = $height;
            $column = $grid;
            foreach ($grid as $row => $colonnes) {
                foreach ($colonnes as $colonnesKey => $data) {
                    if($colonnesKey == $number){
                        if($row + $decalage >= $max){
                            $newIndex = $row + $decalage - $max;
                        }
                        else{
                            $newIndex = $row + $decalage;
                        }

                        $grid[$newIndex][$colonnesKey] = $data;
                    }
                }
            }

        }

        foreach ($grid as $row => $columns) {
            foreach ($columns as $columnsNumber => $data) {
                echo($data);
            }
            echo("<br>");
        }

    }
}

$numberOfPixel = 0;
foreach ($grid as $row => $columns) {
    foreach ($columns as $columnsNumber => $data) {
        if($data == '#'){
            $numberOfPixel++;
        }
    }
}

var_dump($numberOfPixel);

exit;

fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

var_dump("---- Partie 2 ----");