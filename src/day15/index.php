<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input.txt';

$file = fopen($filename, 'r');
$grid = [];
$movement = [];
$isGrid = true;
while ($line = fgets($file)) {   
    $line = str_replace("\r\n", "", $line);
    if($line == ''){
        $isGrid = false;
    }

    if($isGrid){
        $grid[] = str_split($line);
    }
    else{
        if($line != ""){
            $movement = array_merge($movement, str_split($line));
        }
    }
}

fclose($file);

foreach($movement as $direction){
    $grid = move($grid, $direction);
}

$GPSPoint = calculateGPSPoint($grid);
showGrid($grid);
var_dump("---- Partie 1 ----");
var_dump("SUM of GPS point : " . $GPSPoint);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$grid = [];
$movement = [];
$isGrid = true;
while ($line = fgets($file)) {   
    $line = str_replace("\n", "", $line);
    if($line == ''){
        $isGrid = false;
    }

    if($isGrid){
        $lineExploded = str_split($line);
        $tempGrid = [];
        foreach($lineExploded as $value){
            if($value == '@'){
                $tempGrid[] = '@';
                $tempGrid[] = '.';
            }
            elseif($value == 'O'){
                $tempGrid[] = '[';
                $tempGrid[] = ']';
            }
            else{
                $tempGrid[] = $value;
                $tempGrid[] = $value;
            }
        }
        $grid[] = $tempGrid;
    }
    else{
        if($line != ""){
            $movement = array_merge($movement, str_split($line));
        }
    }
}

fclose($file);

foreach($movement as $direction){
    $grid = movePart2($grid, $direction);
}

$GPSPoint = calculateGPSPointPart2($grid);
showGrid($grid);
var_dump("---- Partie 2 ----");
var_dump("SUM of GPS point : " . $GPSPoint); 

function move($grid, $direction){

    $positionOfRobot = getPositionOfRobot($grid);

    if($direction == '^'){
        if($grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] == '.'){
            $grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] = '@';
            $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
            return $grid;
        }
        elseif($grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] == 'O'){
            $qtePositionLeftToTry = $positionOfRobot['y'];
            $firstPositionOfBox = '';
            for($i = $qtePositionLeftToTry; $i >= 0; $i--){
                if($grid[$i][$positionOfRobot['x']] == 'O'){
                    if($firstPositionOfBox == ''){
                        $firstPositionOfBox = ['x' => $positionOfRobot['x'], 'y' => $i];
                    }
                }
                elseif($grid[$i][$positionOfRobot['x']] == '#'){
                    return $grid;
                }
                elseif($grid[$i][$positionOfRobot['x']] == '.'){
                    $grid[$i][$positionOfRobot['x']] = 'O';
                    $grid[$firstPositionOfBox['y']][$positionOfRobot['x']] = '@';
                    $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';

                    return $grid;
                }
            }
        }
        elseif($grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] == '#'){

            return $grid;
        }

    }
    elseif($direction == 'v'){

        if($grid[$positionOfRobot['y'] + 1][$positionOfRobot['x']] == '.'){
            $grid[$positionOfRobot['y'] + 1][$positionOfRobot['x']] = '@';
            $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
            return $grid;
        }
        elseif($grid[$positionOfRobot['y'] + 1][$positionOfRobot['x']] == 'O'){
            $qtePositionLeftToTry = sizeof($grid);
            $firstPositionOfBox = '';
            for($i = $positionOfRobot['y']; $i < $qtePositionLeftToTry; $i++){
                if($grid[$i][$positionOfRobot['x']] == 'O'){
                    if($firstPositionOfBox == ''){
                        $firstPositionOfBox = ['x' => $positionOfRobot['x'], 'y' => $i];
                    }
                }
                elseif($grid[$i][$positionOfRobot['x']] == '#'){
                    return $grid;
                }
                elseif($grid[$i][$positionOfRobot['x']] == '.'){
                    $grid[$i][$positionOfRobot['x']] = 'O';
                    $grid[$firstPositionOfBox['y']][$positionOfRobot['x']] = '@';
                    $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
                    return $grid;
                }
            }
        }
        elseif($grid[$positionOfRobot['y'] + 1][$positionOfRobot['x']] == '#'){
            return $grid;
        }

    }
    elseif($direction == '<'){

        if($grid[$positionOfRobot['y']][$positionOfRobot['x'] - 1] == '.'){
            $grid[$positionOfRobot['y']][$positionOfRobot['x'] - 1] = '@';
            $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
            return $grid;
        }
        elseif($grid[$positionOfRobot['y']][$positionOfRobot['x'] - 1] == 'O'){
            $qtePositionLeftToTry = $positionOfRobot['x'];
            $firstPositionOfBox = '';
            for($i = $qtePositionLeftToTry; $i >= 0; $i--){
                if($grid[$positionOfRobot['y']][$i] == 'O'){
                    if($firstPositionOfBox == ''){
                        $firstPositionOfBox = ['x' => $i, 'y' => $positionOfRobot['y']];
                    }
                }
                elseif($grid[$positionOfRobot['y']][$i] == '#'){
                    return $grid;
                }
                elseif($grid[$positionOfRobot['y']][$i] == '.'){
                    $grid[$positionOfRobot['y']][$i] = 'O';
                    $grid[$positionOfRobot['y']][$firstPositionOfBox['x']] = '@';
                    $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
                    return $grid;
                }
            }
        }
        elseif($grid[$positionOfRobot['y']][$positionOfRobot['x'] - 1] == '#'){
            return $grid;
        }

    }
    elseif($direction == '>'){

        if($grid[$positionOfRobot['y']][$positionOfRobot['x'] + 1] == '.'){
            $grid[$positionOfRobot['y']][$positionOfRobot['x'] + 1] = '@';
            $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
            return $grid;
        }
        elseif($grid[$positionOfRobot['y']][$positionOfRobot['x'] + 1] == 'O'){
            $qtePositionLeftToTry = sizeof($grid[$positionOfRobot['y']]);
            $firstPositionOfBox = '';
            for($i = $positionOfRobot['x']; $i < $qtePositionLeftToTry; $i++){
                if($grid[$positionOfRobot['y']][$i] == 'O'){
                    if($firstPositionOfBox == ''){
                        $firstPositionOfBox = ['x' => $i, 'y' => $positionOfRobot['y']];
                    }
                }
                elseif($grid[$positionOfRobot['y']][$i] == '#'){
                    return $grid;
                }
                elseif($grid[$positionOfRobot['y']][$i] == '.'){
                    $grid[$positionOfRobot['y']][$i] = 'O';
                    $grid[$positionOfRobot['y']][$firstPositionOfBox['x']] = '@';
                    $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
                    return $grid;
                }
            }
        }
        elseif($grid[$positionOfRobot['y']][$positionOfRobot['x'] + 1] == '#'){
            return $grid;
        }

    }

}

function getPositionOfRobot($grid){

    foreach($grid as $lineNumber => $line){
        foreach($line as $columnNumber => $column){
            if($column == '@'){
                return ['x' => $columnNumber, 'y' => $lineNumber];
            }
        }
    }

    return false;

}

function showGrid($grid){

    foreach($grid as $lineNumber => $line){
        foreach($line as $columnNumber => $column){
            echo("<span>".$column."</span>");
        }
        echo("<br>");
    }
    echo("<br>");

}

function calculateGPSPoint($grid){

    $GPSPoint = 0;
    foreach($grid as $lineNumber => $line){
        foreach($line as $columnNumber => $column){
            if($column == 'O'){
                $GPSPoint += ((100 * $lineNumber) + $columnNumber);
            }
        }
    }

    return $GPSPoint;

}

function calculateGPSPoint2($grid){

    $GPSPoint = 0;
    foreach($grid as $lineNumber => $line){
        foreach($line as $columnNumber => $column){
            if($column == '['){
                $GPSPoint += ((100 * $lineNumber) + $columnNumber);
            }
        }
    }

    return $GPSPoint;

}

function movePart2($grid, $direction){

    $positionOfRobot = getPositionOfRobot($grid);

    if($direction == '^'){
        if($grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] == '.'){
            $grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] = '@';
            $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
            return $grid;
        }
        elseif($grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] == '['){
            $qtePositionLeftToTry = $positionOfRobot['y'];
            $firstPositionOfBox = '';
            for($i = $qtePositionLeftToTry; $i >= 0; $i--){
                if($grid[$i][$positionOfRobot['x']] == 'O'){
                    if($firstPositionOfBox == ''){
                        $firstPositionOfBox = ['x' => $positionOfRobot['x'], 'y' => $i];
                    }
                }
                elseif($grid[$i][$positionOfRobot['x']] == '#'){
                    return $grid;
                }
                elseif($grid[$i][$positionOfRobot['x']] == '.'){
                    $grid[$i][$positionOfRobot['x']] = 'O';
                    $grid[$firstPositionOfBox['y']][$positionOfRobot['x']] = '@';
                    $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';

                    return $grid;
                }
            }
        }
        elseif($grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] == ']'){

            


        }
        elseif($grid[$positionOfRobot['y'] - 1][$positionOfRobot['x']] == '#'){

            return $grid;
        }

    }
    elseif($direction == 'v'){

        if($grid[$positionOfRobot['y'] + 1][$positionOfRobot['x']] == '.'){
            $grid[$positionOfRobot['y'] + 1][$positionOfRobot['x']] = '@';
            $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
            return $grid;
        }
        elseif($grid[$positionOfRobot['y'] + 1][$positionOfRobot['x']] == 'O'){
            $qtePositionLeftToTry = sizeof($grid);
            $firstPositionOfBox = '';
            for($i = $positionOfRobot['y']; $i < $qtePositionLeftToTry; $i++){
                if($grid[$i][$positionOfRobot['x']] == 'O'){
                    if($firstPositionOfBox == ''){
                        $firstPositionOfBox = ['x' => $positionOfRobot['x'], 'y' => $i];
                    }
                }
                elseif($grid[$i][$positionOfRobot['x']] == '#'){
                    return $grid;
                }
                elseif($grid[$i][$positionOfRobot['x']] == '.'){
                    $grid[$i][$positionOfRobot['x']] = 'O';
                    $grid[$firstPositionOfBox['y']][$positionOfRobot['x']] = '@';
                    $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
                    return $grid;
                }
            }
        }
        elseif($grid[$positionOfRobot['y'] + 1][$positionOfRobot['x']] == '#'){
            return $grid;
        }

    }
    elseif($direction == '<'){

        if($grid[$positionOfRobot['y']][$positionOfRobot['x'] - 1] == '.'){
            $grid[$positionOfRobot['y']][$positionOfRobot['x'] - 1] = '@';
            $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
            return $grid;
        }
        elseif($grid[$positionOfRobot['y']][$positionOfRobot['x'] - 1] == 'O'){
            $qtePositionLeftToTry = $positionOfRobot['x'];
            $firstPositionOfBox = '';
            for($i = $qtePositionLeftToTry; $i >= 0; $i--){
                if($grid[$positionOfRobot['y']][$i] == 'O'){
                    if($firstPositionOfBox == ''){
                        $firstPositionOfBox = ['x' => $i, 'y' => $positionOfRobot['y']];
                    }
                }
                elseif($grid[$positionOfRobot['y']][$i] == '#'){
                    return $grid;
                }
                elseif($grid[$positionOfRobot['y']][$i] == '.'){
                    $grid[$positionOfRobot['y']][$i] = 'O';
                    $grid[$positionOfRobot['y']][$firstPositionOfBox['x']] = '@';
                    $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
                    return $grid;
                }
            }
        }
        elseif($grid[$positionOfRobot['y']][$positionOfRobot['x'] - 1] == '#'){
            return $grid;
        }

    }
    elseif($direction == '>'){

        if($grid[$positionOfRobot['y']][$positionOfRobot['x'] + 1] == '.'){
            $grid[$positionOfRobot['y']][$positionOfRobot['x'] + 1] = '@';
            $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
            return $grid;
        }
        elseif($grid[$positionOfRobot['y']][$positionOfRobot['x'] + 1] == 'O'){
            $qtePositionLeftToTry = sizeof($grid[$positionOfRobot['y']]);
            $firstPositionOfBox = '';
            for($i = $positionOfRobot['x']; $i < $qtePositionLeftToTry; $i++){
                if($grid[$positionOfRobot['y']][$i] == 'O'){
                    if($firstPositionOfBox == ''){
                        $firstPositionOfBox = ['x' => $i, 'y' => $positionOfRobot['y']];
                    }
                }
                elseif($grid[$positionOfRobot['y']][$i] == '#'){
                    return $grid;
                }
                elseif($grid[$positionOfRobot['y']][$i] == '.'){
                    $grid[$positionOfRobot['y']][$i] = 'O';
                    $grid[$positionOfRobot['y']][$firstPositionOfBox['x']] = '@';
                    $grid[$positionOfRobot['y']][$positionOfRobot['x']] = '.';
                    return $grid;
                }
            }
        }
        elseif($grid[$positionOfRobot['y']][$positionOfRobot['x'] + 1] == '#'){
            return $grid;
        }

    }

}
/*
function findIfTheRobotCanMouv($grid, $positionOfRobot, $direction){

    $partOfGridToTest = getSampleOfGridDependOFTheDirection($grid, $direction, $positionOfRobot['x'], $positionOfRobot['y']);

    if($direction == '^'){
        
        $partOfGridToTest = array_reverse($partOfGridToTest);

        foreach($partOfGridToTest as $key => $value){

        }

    }
    elseif($direction == 'v'){

    }
    elseif($direction == '<'){

        $partOfGridToTest = array_reverse($partOfGridToTest);

    }
    elseif($direction == '>'){



    }


}

function getSampleOfGridDependOFTheDirection($grid,$direction, $xWanted, $yWanted){

    $sample = [];
    if($direction == '^'){
        $rec = true;
        foreach($grid as $lineNumber => $line){
            $sample[] = $line[$xWanted];   
            if($line[$xWanted] == '@'){
                return $sample;
            }
        }
    }
    elseif($direction == 'v'){
        $rec = false;
        foreach($grid as $lineNumber => $line){
            if($line[$xWanted] == '@'){
                $rec = true;
            }
            if($rec){
                $sample[] = $line[$xWanted];   
            }
        }
        return $sample;
    }
    elseif($direction == '<'){
        $rec = true;
        foreach($grid[$yWanted] as $columnNumber => $column){
            $sample[] = $column;   
            if($column == '@'){
                return $sample;
            }
        }
    }
    elseif($direction == '>'){
        $rec = false;
        foreach($grid[$yWanted] as $columnNumber => $column){
            if($column == '@'){
                $rec = true;
            }
            if($rec){
                $sample[] = $column;   
            }
        }
        return $sample;
    }

    return false;

}*/