<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$map = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $lineMap = str_split($line);
    $lineMapTransform = [];
    foreach ($lineMap as $key => $value) {
    	$lineMapTransform[] = ['antenna' => $value, 'antinode' => ''];
    }
    $map[] = $lineMapTransform;
}

fclose($file);

$antenna = [];

foreach ($map as $lines => $line) {
	foreach ($line as $columns => $column) {
		if($column['antenna'] != '.'){
			if(!isset($antenna[$column['antenna']])){
				$antenna[$column['antenna']] = [];
			}
			$antenna[$column['antenna']][] = ['lettre' => $column['antenna'], 'positionX' => $lines, 'positionY' => $columns];
		}
	}
}

foreach ($antenna as $antennaLetter => $antennas) {
	foreach ($antennas as $key => $antennaData) {

		$positionX = $antennaData['positionX'];
		$positionY = $antennaData['positionY'];

		foreach ($antennas as $antennaKey => $antennaDatas) {
			if($antennaKey != $key){
				$positionXAntenna = $antennaDatas['positionX'];
				$positionYAntenna = $antennaDatas['positionY'];

				$distanceX = $positionX - $positionXAntenna;
				$distanceY = $positionY - $positionYAntenna;

				$antinode1X = $positionX + $distanceX;
				$antinode1Y = $positionY + $distanceY;

				$antinode2X = $positionXAntenna - $distanceX;
				$antinode2Y = $positionYAntenna - $distanceY;

				if(isset($map[$antinode1X][$antinode1Y]['antinode']) && $map[$antinode1X][$antinode1Y]['antinode'] == ''){
					$map[$antinode1X][$antinode1Y]['antinode'] = '#';
				}
			}
		}
	}
}

$numberOfUniqueAntinode = 0;
foreach ($map as $lines => $line) {
	foreach ($line as $columns => $column) {

		if($column['antinode'] == '#'){
			$numberOfUniqueAntinode++;
			echo("<span>".$column['antinode']."</span>");
		}
		else{
			echo("<span>".$column['antenna']."</span>");
		}
	}
	echo("<br>");
}

var_dump("---- Partie 1 ----");
var_dump("Number Of Unique Antinode : " . $numberOfUniqueAntinode);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$map = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $lineMap = str_split($line);
    $lineMapTransform = [];
    foreach ($lineMap as $key => $value) {
    	$lineMapTransform[] = ['antenna' => $value, 'antinode' => ''];
    }
    $map[] = $lineMapTransform;
}

fclose($file);

$antenna = [];

foreach ($map as $lines => $line) {
	foreach ($line as $columns => $column) {
		if($column['antenna'] != '.'){
			if(!isset($antenna[$column['antenna']])){
				$antenna[$column['antenna']] = [];
			}
			$antenna[$column['antenna']][] = ['lettre' => $column['antenna'], 'positionX' => $lines, 'positionY' => $columns];
		}
	}
}

foreach ($antenna as $antennaLetter => $antennas) {
	foreach ($antennas as $key => $antennaData) {

		$positionX = $antennaData['positionX'];
		$positionY = $antennaData['positionY'];

		foreach ($antennas as $antennaKey => $antennaDatas) {
			if($antennaKey != $key){
				$positionXAntenna = $antennaDatas['positionX'];
				$positionYAntenna = $antennaDatas['positionY'];

				$distanceXOrignale = $positionX - $positionXAntenna;
				$distanceYOrignale = $positionY - $positionYAntenna;

				$distanceX = $distanceXOrignale;
				$distanceY = $distanceYOrignale;


				while($distanceX < 1000 && $distanceY < 1000 && $distanceY >= -1000 && $distanceX >= -1000){

					$antinode1X = $positionX + $distanceX;
					$antinode1Y = $positionY + $distanceY;

					$antinode2X = $positionXAntenna - $distanceX;
					$antinode2Y = $positionYAntenna - $distanceY;

					if(isset($map[$antinode1X][$antinode1Y]['antinode']) && $map[$antinode1X][$antinode1Y]['antinode'] == ''){
						$map[$antinode1X][$antinode1Y]['antinode'] = '#';
					}

					if(isset($map[$antinode2X][$antinode2Y]['antinode']) && $map[$antinode2X][$antinode2Y]['antinode'] == ''){
						$map[$antinode2X][$antinode2Y]['antinode'] = '#';
					}

					$distanceX += $distanceXOrignale;
					$distanceY += $distanceYOrignale;
				}
			}
		}
	}
}

$numberOfUniqueAntinode = 0;
foreach ($map as $lines => $line) {
	foreach ($line as $columns => $column) {

		if($column['antinode'] == '#'){
			$numberOfUniqueAntinode++;
			echo("<span>".$column['antinode']."</span>");
		}
		else{
			if($column['antenna'] != '.'){
				$numberOfUniqueAntinode++;
			}
			echo("<span>".$column['antenna']."</span>");
		}
	}
	echo("<br>");
}

var_dump("---- Partie 2 ----");
var_dump("Number Of Unique Antinode : " . $numberOfUniqueAntinode);