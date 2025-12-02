<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$map = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $tempLine = str_split($line);
    foreach ($tempLine as $key => $value) {
    	$tempLine[$key] = ['value' => $value, 'type' => '', 'numberOfBoundary' => 0];
    }
    $map[] = $tempLine;
}

fclose($file);

$rows = count($map);
$cols = count($map[0]);

$visited = array_fill(0, $rows, array_fill(0, $cols, false));


foreach ($map as $lineNumber => $line) {
	foreach ($line as $columnNumber => $column) {
		if(isset($map[$lineNumber][$columnNumber + 1])){
			
			if($map[$lineNumber][$columnNumber]['value'] != $map[$lineNumber][$columnNumber + 1]['value']){
				$map[$lineNumber][$columnNumber]['type'] = 'bound';
				$map[$lineNumber][$columnNumber]['numberOfBoundary']++;
			}	
		}
		else{

			$map[$lineNumber][$columnNumber]['type'] = 'bound';
			$map[$lineNumber][$columnNumber]['numberOfBoundary']++;
		}

		if(isset($map[$lineNumber][$columnNumber - 1])){
			if($map[$lineNumber][$columnNumber]['value'] != $map[$lineNumber][$columnNumber - 1]['value']){
				$map[$lineNumber][$columnNumber]['type'] = 'bound';
				$map[$lineNumber][$columnNumber]['numberOfBoundary']++;
			}	
		}
		else{
			$map[$lineNumber][$columnNumber]['type'] = 'bound';
			$map[$lineNumber][$columnNumber]['numberOfBoundary']++;
		}

		if(isset($map[$lineNumber + 1][$columnNumber])){
			if($map[$lineNumber][$columnNumber]['value'] != $map[$lineNumber + 1][$columnNumber]['value']){
				$map[$lineNumber][$columnNumber]['type'] = 'bound';
				$map[$lineNumber][$columnNumber]['numberOfBoundary']++;
			}	
		}
		else{
			$map[$lineNumber][$columnNumber]['type'] = 'bound';
			$map[$lineNumber][$columnNumber]['numberOfBoundary']++;
		}

		if(isset($map[$lineNumber - 1][$columnNumber])){
			if($map[$lineNumber][$columnNumber]['value'] != $map[$lineNumber - 1][$columnNumber]['value']){
				$map[$lineNumber][$columnNumber]['type'] = 'bound';
				$map[$lineNumber][$columnNumber]['numberOfBoundary']++;
			}	
		}
		else{
			$map[$lineNumber][$columnNumber]['type'] = 'bound';
			$map[$lineNumber][$columnNumber]['numberOfBoundary']++;
		}
	}
}

$totalPriceOfFence = 0;

foreach ($map as $lineNumber => $line) {
	foreach ($line as $columnNumber => $column) {

		if(!$visited[$lineNumber][$columnNumber]){
			$result = getAreaAndPerimeter($column['value'], $visited, $map, ['x' => $lineNumber, 'y' => $columnNumber], $rows, $cols);
			$visited = $result['mapVisited'];
			$area = $result['area'];
			$perimeter = $result['perimeter'];
			$price = $area * $perimeter;
			$totalPriceOfFence += $price;
		}
	}
}

var_dump("---- Partie 1 ----");
var_dump("Price of fencing of all regions : " . $totalPriceOfFence);


/*** Part 2 ***/

$file = fopen($filename, 'r');
$map = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $tempLine = str_split($line);
    foreach ($tempLine as $key => $value) {
    	$tempLine[$key] = ['value' => $value, 'type' => '', 'numberOfBoundary' => 0];
    }
    $map[] = $tempLine;
}

fclose($file);

$rows = count($map);
$cols = count($map[0]);

$visited = array_fill(0, $rows, array_fill(0, $cols, false));

$totalPriceOfFence = 0;

foreach ($map as $lineNumber => $line) {
	foreach ($line as $columnNumber => $column) {

		if(!$visited[$lineNumber][$columnNumber]){
			$result = getAreaAndPerimeter($column['value'], $visited, $map, ['x' => $lineNumber, 'y' => $columnNumber], $rows, $cols);
			$visited = $result['mapVisited'];
			$mapVisitedOnlyLetter = $result['mapVisitedOnlyLetter'];
			$sideOfArea = calculateSideOfArea($mapVisitedOnlyLetter);
			$area = $result['area'];
			//$perimeter = $result['perimeter'];
			$price = $area * $sideOfArea;
			$totalPriceOfFence += $price;
		}
	}
}

var_dump("---- Partie 2 ----");
var_dump("Price of fencing of all regions : " . $totalPriceOfFence);




function getAreaAndPerimeter($letter, $visited, $grid, $fistPosition, $rows, $cols){

	$visitedOnlyLetter = array_fill(0, $rows, array_fill(0, $cols, false));

	$visited[$fistPosition['x']][$fistPosition['y']] = true;
	$visitedOnlyLetter[$fistPosition['x']][$fistPosition['y']] = true;

	$directions = [
	    [-1, 0],
	    [1, 0],
	    [0, -1],
	    [0, 1]
	];

	$queue = [[$fistPosition['x'],$fistPosition['y']]];
	$count = 1;
	$countBondary = $grid[$fistPosition['x']][$fistPosition['y']]['numberOfBoundary'];

	while (!empty($queue)) {
	    list($currentRow, $currentCol) = array_shift($queue);

	    foreach ($directions as [$deltaRow, $deltaCol]) {
	        $newRow = $currentRow + $deltaRow;
	        $newCol = $currentCol + $deltaCol;

	        if (!isInBounds($newRow, $newCol, $rows, $cols) || $visited[$newRow][$newCol]) {
	            continue;
	        }

	        if ($grid[$newRow][$newCol]['value'] !== $letter) {
	            continue;
	        }

	        $visited[$newRow][$newCol] = true;
	        $visitedOnlyLetter[$newRow][$newCol] = true;
	        $count++;
	        $countBondary += $grid[$newRow][$newCol]['numberOfBoundary'];
	        $queue[] = [$newRow, $newCol];
	    }
	}

	return ['area' => $count, 'perimeter' => $countBondary, 'mapVisited' => $visited, 'mapVisitedOnlyLetter' => $visitedOnlyLetter];

}

function calculateSideOfArea($grid){

	// Copmparé d'abord les horizintal

	$faceVertical = [];
	foreach ($grid as $lineNumber => $line) {
		foreach ($line as $columnNumber => $column) {
			if($column){
				//Dessus
				if(isset($grid[$lineNumber - 1][$columnNumber])){
					if(isset($grid[$lineNumber][$columnNumber - 1])){
						if($column != $grid[$lineNumber - 1][$columnNumber]){
							if(!isset($faceVertical['dessus'])){
								$faceVertical['dessus'] = 0;
							}
							$faceVertical['dessus'] += 1;
						}
					}
				}
				else{
					if(isset($grid[$lineNumber][$columnNumber - 1])){
						if($column != $grid[$lineNumber][$columnNumber - 1]){
							echo('here1');
							if(!isset($faceVertical['dessus'])){
								$faceVertical['dessus'] = 0;
							}
							$faceVertical['dessus'] += 1;
						}
					}
					else{
						// Cas du coin en haut a gauche
						if(!isset($faceVertical['dessus'])){
							$faceVertical['dessus'] = 0;
						}
						$faceVertical['dessus'] += 1;
					}
				}

				//dessous
				if(isset($grid[$lineNumber + 1][$columnNumber])){
					if(isset($grid[$lineNumber][$columnNumber - 1])){
						if($column != $grid[$lineNumber + 1][$columnNumber]){
							if(!isset($faceVertical[$lineNumber + 1])){
								$faceVertical[$lineNumber + 1] = 0;
							}
							$faceVertical[$lineNumber + 1] += 1;
						}
					}
				}
				else{
					if(isset($grid[$lineNumber][$columnNumber - 1])){
						if($column != $grid[$lineNumber][$columnNumber - 1]){
							if(!isset($faceVertical[$lineNumber + 1])){
								$faceVertical[$lineNumber + 1] = 0;
							}
							$faceVertical[$lineNumber + 1] += 1;
						}
					}
					else{
						// Cas du coin en bas a gauche
						if(!isset($faceVertical[$lineNumber + 1])){
							$faceVertical[$lineNumber + 1] = 0;
						}
						$faceVertical[$lineNumber + 1] += 1;
					}
				}
			}
		}
	}

	// puis les vertical

	var_dump($faceVertical);
	exit;

}


function isInBounds($row, $col, $totalRows, $totalCols) {
    return $row >= 0 
        && $row < $totalRows 
        && $col >= 0 
        && $col < $totalCols;
}