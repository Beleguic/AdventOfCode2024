<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$numberPick = [];
$board = [];
$numberOfBoard = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if(sizeof($numberPick) == 0){
    	$numberPick = explode(',', $line);
    }
    else{
    	if($line != ''){
    		$lineBoard = explode(' ', $line);
    		foreach ($lineBoard as $key => $value) {
    			if($value == ''){
    				unset($lineBoard[$key]);
    			}
    			else{
    				$lineBoard[$key] = ['value' => $value, 'pick' => false];
    			}
    		}
    		$lineBoard = array_values($lineBoard);
    		$board[$numberOfBoard][] = $lineBoard;
    	}
    	else{
    		$numberOfBoard++;
    	}
    }
}

fclose($file);

$result = '';

foreach ($numberPick as $key => $numberJustPick) {
	if($result == ''){
		$board = updateAllBoard($board, $numberJustPick);
		$isAWinner = verifyWin($board);
		if(sizeof($isAWinner) > 0){
			$firstWinner = $isAWinner[0];
			$boardWinner = $board[$firstWinner];
			$totalCaseNotCheck = calculateEmptyNumber($board[$firstWinner]);
			$result = $totalCaseNotCheck * $numberJustPick;
		}
	}
}

var_dump("---- Partie 1 ----");
var_dump("result : " . $result);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$numberPick = [];
$board = [];
$numberOfBoard = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if(sizeof($numberPick) == 0){
    	$numberPick = explode(',', $line);
    }
    else{
    	if($line != ''){
    		$lineBoard = explode(' ', $line);
    		foreach ($lineBoard as $key => $value) {
    			if($value == ''){
    				unset($lineBoard[$key]);
    			}
    			else{
    				$lineBoard[$key] = ['value' => $value, 'pick' => false];
    			}
    		}
    		$lineBoard = array_values($lineBoard);
    		$board[$numberOfBoard][] = $lineBoard;
    	}
    	else{
    		$numberOfBoard++;
    	}
    }
}

fclose($file);

$result = '';

foreach ($numberPick as $key => $numberJustPick) {

	$board = updateAllBoard($board, $numberJustPick);
	$isAWinner = verifyWin($board);
	if(sizeof($isAWinner) > 0){
		foreach ($isAWinner as $boardToWin) {
			$totalCaseNotCheck = calculateEmptyNumber($board[$boardToWin]);
			$result = $totalCaseNotCheck * $numberJustPick;
			unset($board[$boardToWin]);
		}
	}
}

var_dump("---- Partie 2 ----");
var_dump("result : " . $result);

function updateAllBoard($board, $numberJustPick){

	foreach ($board as $numberOfTheBoard => $boardLine) {
		foreach ($boardLine as $line => $lineNumber) {
			foreach ($lineNumber as $numberPosition => $data) {
				if($data['value'] == $numberJustPick){
					$board[$numberOfTheBoard][$line][$numberPosition]['pick'] = true;
				}
			}
		}
	}

	return $board;

}

function verifyWin($board){

	$boardThatWin = [];

	foreach ($board as $numberOfTheBoard => $boardLine) {
		
		// Checking Column
		for ($column=0; $column < 5; $column++) {
			$colonnesWin = true;
			for ($line=0; $line < 5; $line++) { 
				if(!$board[$numberOfTheBoard][$line][$column]['pick']){
					$colonnesWin = false;
				}
			}
			if($colonnesWin){
				if(!in_array($numberOfTheBoard, $board)){
					$boardThatWin[] = $numberOfTheBoard;
				}
			}
		}

		// Checking Lines
		for ($column=0; $column < 5; $column++) {
			$lineWin = true;
			for ($line=0; $line < 5; $line++) { 
				if(!$board[$numberOfTheBoard][$column][$line]['pick']){
					$lineWin = false;
				}
			}
			if($lineWin){
				if(!in_array($numberOfTheBoard, $board)){
					$boardThatWin[] = $numberOfTheBoard;
				}
			}
		}

	}

	return array_unique($boardThatWin);

}

function calculateEmptyNumber($board){

	$total = 0;

	foreach ($board as $line => $lineNumber) {
		foreach ($lineNumber as $numberPosition => $data) {
			if(!$data['pick']){
				$total += $data['value'];
			}
		}
	}

	return $total;

}