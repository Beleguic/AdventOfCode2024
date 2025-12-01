<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input.txt';

$file = fopen($filename, 'r');
$grid = [];
while ($line = fgets($file)) {
    $line = str_replace("\r\n", "", $line);
    $grid[] = str_split($line);
}

fclose($file);

$startingDirection = 'right';
$possibleChange = ['right' => ['down', 'up'], 'left' => ['down', 'up'], 'up' => ['right', 'left'], 'down' => ['right', 'left']];
$startPosition = getStartPosition($grid);

$possiblePath = [];
$possiblePath[] = ['x' => $startPosition['x'], 'y' => $startPosition['y'], 'facing' => $startingDirection, 'numberOfPoint' => 0];

for($i = 0; $i < 1000; $i++){

    foreach($possiblePath as $pathNumber => $pathData){

        if(isset($grid[$pathData['y']][$pathData['x']])){
            $nextTilePossible = [];
            if($grid[$pathData['y'] + 1][$pathData['x']] == '.'){
                $nextTilePossible[] = ['x' => $pathData['x'], 'y' => $pathData['y'] + 1, 'direction' => 'up'];
            }
            if($grid[$pathData['y'] - 1][$pathData['x']] == '.'){
                $nextTilePossible[] = ['x' => $pathData['x'], 'y' => $pathData['y'] - 1, 'direction' => 'down'];
            }
            if($grid[$pathData['y']][$pathData['x'] - 1] == '.'){
                $nextTilePossible[] = ['x' => $pathData['x'] - 1, 'y' => $pathData['y'], 'direction' => 'left'];
            }
            if($grid[$pathData['y']][$pathData['x'] + 1] == '.'){
                $nextTilePossible[] = ['x' => $pathData['x'] + 1, 'y' => $pathData['y'], 'direction' => 'right'];
            }

            if(sizeof($nextTilePossible) == 1){
                if($pathData['facing'] == $nextTilePossible[0]['direction']){
                    $possiblePath[$pathNumber]['x'] = $nextTilePossible[0]['x'];
                    $possiblePath[$pathNumber]['y'] = $nextTilePossible[0]['y'];
                    $possiblePath[$pathNumber]['numberOfPoint'] += 100;
                }
                else{
                    if(in_array($nextTilePossible[0]['direction'], $possibleChange[$pathData['facing']])){
                        $possiblePath[$pathNumber]['x'] = $nextTilePossible[0]['x'];
                        $possiblePath[$pathNumber]['y'] = $nextTilePossible[0]['y'];
                        $possiblePath[$pathNumber]['facing'] = $nextTilePossible[0]['direction'];
                        $possiblePath[$pathNumber]['numberOfPoint'] += 1100;
                    }
                }
                var_dump($possiblePath);
            }
            elseif(sizeof($nextTilePossible) > 1){

                $j = 0;
                foreach($nextTilePossible){

                    if($j == 0){
                        // incremente le path possible actuel;
                    }
                    else{
                        // ajoute dans path possible
                    }

                    $j++;
                }

                var_dump($nextTilePossible);
                var_dump($possiblePath);
                exit;
            }


        }



    }


}

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

var_dump("---- Partie 2 ----");

function getStartPosition($grid){

    foreach($grid as $lineNumber => $line){
        foreach($line as $columnNumber => $column){
            if($column == 'S'){
                return ['x' => $columnNumber, 'y' => $lineNumber];
            }
        }
    }


}