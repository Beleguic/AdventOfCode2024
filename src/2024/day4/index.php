<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$grid = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = str_split($line);
    $grid[] = $line;
}
fclose($file);
$xmasCount = 0;
foreach ($grid as $lineKey => $line) {
    foreach ($line as $charKey => $char) {
        if($char == "X"){
            if(isset($line[$charKey + 1]) && $line[$charKey + 1] == "M"){
                if(isset($line[$charKey + 2]) && $line[$charKey + 2] == "A"){
                    if(isset($line[$charKey + 3]) && $line[$charKey + 3] == "S"){
                        $xmasCount++;
                    }
                }
            }
            if(isset($line[$charKey - 1]) && $line[$charKey - 1] == "M"){
                if(isset($line[$charKey - 2]) && $line[$charKey - 2] == "A"){
                    if(isset($line[$charKey - 3]) && $line[$charKey - 3] == "S"){
                        $xmasCount++;
                    }
                }
            }
            if(isset($grid[$lineKey + 1][$charKey]) && $grid[$lineKey + 1][$charKey] == "M"){
                if(isset($grid[$lineKey + 2][$charKey]) && $grid[$lineKey + 2][$charKey] == "A"){
                    if(isset($grid[$lineKey + 3][$charKey]) && $grid[$lineKey + 3][$charKey] == "S"){
                        $xmasCount++;
                    }
                }
            }
            if(isset($grid[$lineKey - 1][$charKey]) && $grid[$lineKey - 1][$charKey] == "M"){
                if(isset($grid[$lineKey - 2][$charKey]) && $grid[$lineKey - 2][$charKey] == "A"){
                    if(isset($grid[$lineKey - 3][$charKey]) && $grid[$lineKey - 3][$charKey] == "S"){
                        $xmasCount++;
                    }
                }
            }
            if(isset($grid[$lineKey + 1][$charKey + 1]) && $grid[$lineKey + 1][$charKey + 1] == "M"){
                if(isset($grid[$lineKey + 2][$charKey + 2]) && $grid[$lineKey + 2][$charKey + 2] == "A"){
                    if(isset($grid[$lineKey + 3][$charKey + 3]) && $grid[$lineKey + 3][$charKey + 3] == "S"){
                        $xmasCount++;
                    }
                }
            }
            if(isset($grid[$lineKey - 1][$charKey - 1]) && $grid[$lineKey - 1][$charKey - 1] == "M"){
                if(isset($grid[$lineKey - 2][$charKey - 2]) && $grid[$lineKey - 2][$charKey - 2] == "A"){
                    if(isset($grid[$lineKey - 3][$charKey - 3]) && $grid[$lineKey - 3][$charKey - 3] == "S"){
                        $xmasCount++;
                    }
                }
            }
            if(isset($grid[$lineKey + 1][$charKey - 1]) && $grid[$lineKey + 1][$charKey - 1] == "M"){
                if(isset($grid[$lineKey + 2][$charKey - 2]) && $grid[$lineKey + 2][$charKey - 2] == "A"){
                    if(isset($grid[$lineKey + 3][$charKey - 3]) && $grid[$lineKey + 3][$charKey - 3] == "S"){
                        $xmasCount++;
                    }
                }
            }
            if(isset($grid[$lineKey - 1][$charKey + 1]) && $grid[$lineKey - 1][$charKey + 1] == "M"){
                if(isset($grid[$lineKey - 2][$charKey + 2]) && $grid[$lineKey - 2][$charKey + 2] == "A"){
                    if(isset($grid[$lineKey - 3][$charKey + 3]) && $grid[$lineKey - 3][$charKey + 3] == "S"){
                        $xmasCount++;
                    }
                }
            }
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump($xmasCount);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$grid = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = str_split($line);
    $grid[] = $line;
}
fclose($file);
$x_masCount = 0;
foreach ($grid as $lineKey => $line) {
    foreach ($line as $charKey => $char) {
        if($char == "A"){
            if(isset($grid[$lineKey - 1][$charKey + 1]) && ($grid[$lineKey - 1][$charKey + 1] == "M" || $grid[$lineKey - 1][$charKey + 1] == "S")){
                if(isset($grid[$lineKey + 1][$charKey - 1]) && ($grid[$lineKey + 1][$charKey - 1] == "M" || $grid[$lineKey + 1][$charKey - 1] == "S") && $grid[$lineKey + 1][$charKey - 1] != $grid[$lineKey - 1][$charKey + 1]){
                    if(isset($grid[$lineKey + 1][$charKey + 1]) && ($grid[$lineKey + 1][$charKey + 1] == "M" || $grid[$lineKey + 1][$charKey + 1] == "S")){
                        if(isset($grid[$lineKey - 1][$charKey - 1]) && ($grid[$lineKey - 1][$charKey - 1] == "M" || $grid[$lineKey - 1][$charKey - 1] == "S") && $grid[$lineKey - 1][$charKey - 1] != $grid[$lineKey + 1][$charKey + 1]){
                            $x_masCount++;
                        }
                    }
                }
            }
        }
    }
}

var_dump("---- Partie 2 ----");
var_dump($x_masCount);