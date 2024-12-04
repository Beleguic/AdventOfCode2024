<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$report = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $report[] = $line;
}

fclose($file);

$numberIncreasing = 0;

foreach ($report as $key => $value) {
	if(isset($report[$key - 1]) && $report[$key - 1]){
		if($value > $report[$key - 1]){
			$numberIncreasing++;
		}
	}
}

var_dump("---- Partie 1 ----");
var_dump("Number Increasing : " . $numberIncreasing);
/*** Part 2 ***/

$file = fopen($filename, 'r');
$report = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $report[] = $line;
}

fclose($file);

$numberIncreasing = 0;

foreach ($report as $key => $value) {

	if(isset($report[$key - 1]) && isset($report[$key - 2]) && isset($report[$key - 3])){
		$scanA = $report[$key - 1] + $report[$key - 2] + $report[$key - 3];
		$scanB = $value + $report[$key - 1] + $report[$key - 2];
		if($scanB > $scanA){
			$numberIncreasing++;
		}
	}
}

var_dump("---- Partie 2 ----");
var_dump("Number Increasing : " . $numberIncreasing);