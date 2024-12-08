<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$heightLocation = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $heightLocation[] = str_split($line);
}

fclose($file);

$levelHeightTotal = 0;

foreach ($heightLocation as $line => $heightLine) {
	foreach ($heightLine as $column => $height) {
		$isLow = true;
		if(isset($heightLocation[$line - 1][$column])){
			if($height >= $heightLocation[$line - 1][$column]){
				$isLow = false;
			}
		}
		if(isset($heightLocation[$line + 1][$column])){
			if($height >= $heightLocation[$line + 1][$column]){
				$isLow = false;
			}
		}
		if(isset($heightLocation[$line][$column - 1])){
			if($height >= $heightLocation[$line][$column - 1]){
				$isLow = false;
			}
		}
		if(isset($heightLocation[$line][$column + 1])){
			if($height >= $heightLocation[$line][$column + 1]){
				$isLow = false;
			}
		}
		if($isLow){
			$levelHeightTotal += ($height + 1);
		}
	}
}

var_dump("---- Partie 1 ----");
var_dump("Level Low : " . $levelHeightTotal);
/*** Part 2 ***/

$file = fopen($filename, 'r');
$heightLocation = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $heightLocation[] = str_split($line);
}

fclose($file);

foreach ($heightLocation as $line => $heightLine) {
	foreach ($heightLine as $column => $height) {
		if($height == 9){
			echo("<span style='background-color:red;'>".$height."</span>");
		}
		else{
			echo("<span>".$height."</span>");
		}
	}
	echo("<br>");
}

var_dump("---- Partie 2 ----");