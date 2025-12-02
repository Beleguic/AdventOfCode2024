<?php

set_time_limit(250);

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$area = [];
$positionGuardX = 0;
$positionGuardY = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = str_split($line);
    $area[] = $line;
    foreach ($line as $key => $value) {
        if ($value === '^') {
            $positionGuardX = $key;
            $positionGuardY = sizeof($area) - 1;
        }
    }
}

fclose($file);

$result = knowIfGuardGetOutOfTheGrid($area, $positionGuardX, $positionGuardY);
$area = $result['area'];

$numberX = 0;
foreach($area as $line) {
    foreach($line as $value) {
        if($value === 'X') {
            $numberX++;
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump("Number Of District : " . $numberX);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$area = [];
$positionGuardX = 0;
$positionGuardY = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = str_split($line);
    $area[] = $line;
    foreach ($line as $key => $value) {
        if ($value === '^') {
            $positionGuardX = $key;
            $positionGuardY = sizeof($area) - 1;
        }
    }
}

fclose($file);

$totalOfLoop = 0;

foreach($area as $key => $line) {
    foreach($line as $key2 => $value) {
        if($value !== '#') {
            $areaTemp = $area;
            $areaTemp[$key][$key2] = '#';
            $result = knowIfGuardGetOutOfTheGrid($areaTemp, $positionGuardX, $positionGuardY);
            if($result['outOfGrid'] === false) {
                $totalOfLoop++;
            }
        }
    }
}

var_dump("---- Partie 2 ----");
var_dump("Number Of Loop : " . $totalOfLoop);



function knowIfGuardGetOutOfTheGrid($area, $positionGuardX, $positionGuardY) {
    $direction = 'up';
    $i = 0;
    while(isset($area[$positionGuardY][$positionGuardX]) && $i < 100000) {

        $area[$positionGuardY][$positionGuardX] = 'X';

        $nextTale = '.';
        if($direction === 'up') {
            if(!isset($area[$positionGuardY - 1][$positionGuardX])) {
                return ['area' => $area, 'positionGuardX' => $positionGuardX, 'positionGuardY' => $positionGuardY, 'outOfGrid' => true];
            }
            $nextTale = $area[$positionGuardY - 1][$positionGuardX];
        }
        if($direction === 'down') {
            if(!isset($area[$positionGuardY + 1][$positionGuardX])) {
                return ['area' => $area, 'positionGuardX' => $positionGuardX, 'positionGuardY' => $positionGuardY, 'outOfGrid' => true];
            }
            $nextTale = $area[$positionGuardY + 1][$positionGuardX];
        }
        if($direction === 'left') {
            if(!isset($area[$positionGuardY][$positionGuardX - 1])) {
                return ['area' => $area, 'positionGuardX' => $positionGuardX, 'positionGuardY' => $positionGuardY, 'outOfGrid' => true];
            }
            $nextTale = $area[$positionGuardY][$positionGuardX - 1];
        }
        if($direction === 'right') {
            if(!isset($area[$positionGuardY][$positionGuardX + 1])) {
                return ['area' => $area, 'positionGuardX' => $positionGuardX, 'positionGuardY' => $positionGuardY, 'outOfGrid' => true];
            }
            $nextTale = $area[$positionGuardY][$positionGuardX + 1];
        }

        if($nextTale === '#') {
            if($direction === 'up') {
                $direction = 'right';
            } elseif($direction === 'right') {
                $direction = 'down';
            } elseif($direction === 'down') {
                $direction = 'left';
            } elseif($direction === 'left') {
                $direction = 'up';
            }
        }
        else{
            if($direction === 'up') {
                $positionGuardY--;
            }
            if($direction === 'down') {
                $positionGuardY++;
            }
            if($direction === 'left') {
                $positionGuardX--;
            }
            if($direction === 'right') {
                $positionGuardX++;
            }
        }

        $i++;
        
    }
    
    return ['area' => $area, 'positionGuardX' => $positionGuardX, 'positionGuardY' => $positionGuardY, 'outOfGrid' => false];
    
}