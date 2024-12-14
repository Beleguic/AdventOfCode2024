<?php

set_time_limit(0);

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');

//$rows = 103;
//$cols = 101;

$rows = 103;
$cols = 101;

$map = array_fill(0, $rows, array_fill(0, $cols, []));

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $caracteristique = explode(' ', $line);
    $position = $caracteristique[0];
    $velocity = $caracteristique[1];

    $positionExploded = explode(',', substr($position, 2));

    $xPos = $positionExploded[0];
    $yPos = $positionExploded[1];

    $velocityExploded = explode(',', substr($velocity, 2));

    $xVel = $velocityExploded[0];
    $yVel = $velocityExploded[1];

    $map[$yPos][$xPos][] = ['xVel' => $xVel, 'yVel' => $yVel];

}

fclose($file);

$safetyFactor100Second = 0;
for ($seconde=0; $seconde < 100; $seconde++) { 
	$map = move($map);
}

$numberOfRobots = calculateNumberOfRobotPerQuadrant($map);
$safetyFactor100Second = calculateSafetyFactor($numberOfRobots);

for ($seconde=100; $seconde < 10000; $seconde++) { 
	$map = move($map);
	$find = findChristmasTree($map, $seconde + 1);
	if($find){
		break;
	}
}

$christmasTreeFindAtXSecond = $seconde + 1;

var_dump("---- Partie 1 ----");
var_dump("Safety Factor after 100 seconds : " . $safetyFactor100Second);
/*** Part 2 ***/

var_dump("---- Partie 2 ----");
var_dump("Christmas tree find after " . $christmasTreeFindAtXSecond . " secondes");
showMap($map);



function move($map){

	$minCol = 0;
	$maxCol = sizeof($map[0]);

	$minLine = 0;
	$maxLine = sizeof($map);

	$newMap = array_fill(0, $maxLine, array_fill(0, $maxCol, []));

	foreach ($map as $lineNumber => $line) {
		foreach ($line as $columnNumber => $column) {
			//J'ai au moins un robot
			if(sizeof($column) > 0){
				foreach ($column as $numberRobots => $rebotsVelocity) {
					$xVel = $rebotsVelocity['xVel'];
					$yVel = $rebotsVelocity['yVel'];

					$newX = $columnNumber + $xVel; 
					$newY = $lineNumber + $yVel;

					if(!($newX >= $minCol && $newX < $maxCol)){
						if($newX < $minCol){
							$newX = $maxCol - abs($newX);
						}
						elseif($newX >= $maxCol){
							$newX = $minCol + abs($maxCol - $newX);
						}
					}

					if(!($newY >= $minLine && $newY < $maxLine)){
						if($newY < $minLine){
							$newY = $maxLine - abs($newY);
						}
						elseif($newY >= $maxLine){
							$newY = $minLine + abs($maxLine - $newY);
						}
					}

					if(isset($newMap[$newY][$newX])){
						$newMap[$newY][$newX][] = ['xVel' => $xVel, 'yVel' => $yVel];
					}
				}
			}
		}	
	}

	return $newMap;

}

function calculateNumberOfRobotPerQuadrant($map){

	$minCol = 0;
	$maxCol = sizeof($map[0]);

	$minLine = 0;
	$maxLine = sizeof($map);

	$lineMiddle = (($maxLine - 1) / 2);
	$colMiddle = (($maxCol - 1) / 2);

	$numberOfRobots = ['TopLeft' => 0, 'TopRight' => 0, 'DownLeft' => 0, 'DownRight' => 0];

	foreach ($map as $lineNumber => $line) {
		foreach ($line as $columnNumber => $column) {

			if($lineNumber < $lineMiddle && $columnNumber < $colMiddle){
				$numberOfRobots['TopLeft'] += sizeof($column);
			}
			elseif($lineNumber < $lineMiddle && $columnNumber > $colMiddle){
				$numberOfRobots['TopRight'] += sizeof($column);
			}
			elseif($lineNumber > $lineMiddle && $columnNumber < $colMiddle){
				$numberOfRobots['DownLeft'] += sizeof($column);
			}
			elseif($lineNumber > $lineMiddle && $columnNumber > $colMiddle){
				$numberOfRobots['DownRight'] += sizeof($column);
			}
		}
	}

	return $numberOfRobots;

}

function showMap($map){

	foreach ($map as $lineNumber => $line) {
		foreach ($line as $columnNumber => $column) {
			if(sizeof($column) > 0){
				echo("<span style='background-color: red;'>".sizeof($column)."</span>");
			}
			else{
				echo("<span>.</span>");
			}
			
		}
		echo("<br>");
	}
	
	echo("<br>");
	echo("<br>");

}

function calculateSafetyFactor($numberOfRobots){

	$safetyFactor = 0;
	foreach ($numberOfRobots as $key => $value) {
		if($safetyFactor == 0){
			$safetyFactor = $value;
		}
		else{
			$safetyFactor *= $value;
		}
	}

	return $safetyFactor;

}

function findChristmasTree($map, $seconde){

	$consecutiveRobot = 0;
	foreach ($map as $lineNumber => $line) {
		foreach ($line as $columnNumber => $column) {
			if(sizeof($column) > 0){
				$consecutiveRobot++;
			}
			else{
				$consecutiveRobot = 0;
			}

			if($consecutiveRobot > 10){
				//echo($seconde . "<br>");
				//showMap($map);
				return true;
			}
		}
	}
	return false;

}