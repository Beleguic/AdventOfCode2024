<?php

set_time_limit(60);

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$machines = [];
$keyActual = -1;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = explode(' ', $line);
    if($line[0] == 'Button' && $line[1] == 'A:'){
    	$keyActual++;
    	$machines[$keyActual]['A'] = ['X' => substr(explode('+', $line[2])[1],0,-1), 'Y' => explode('+', $line[3])[1]];
    }
    if($line[0] == 'Button' && $line[1] == 'B:'){
    	$machines[$keyActual]['B'] = ['X' => substr(explode('+', $line[2])[1],0,-1), 'Y' => explode('+', $line[3])[1]];
    }
    if($line[0] == 'Prize:'){
    	$machines[$keyActual]['Prize'] = ['X' => substr(explode('=', $line[1])[1],0,-1), 'Y' => explode('=', $line[2])[1]];
    }
}

fclose($file);

$totalFeverPrice = 0;

$priceforAToken = 3;
$priceforBToken = 1;

foreach ($machines as $numberOfMachine => $data) {
	$goodCombinaison = [];
	for ($A=0; $A <= 100; $A++) { 
		for ($B=0; $B <= 100; $B++) { 
			$AX = $A * $data['A']['X'];
			$BX = $B * $data['B']['X'];
			$AY = $A * $data['A']['Y'];
			$BY = $B * $data['B']['Y'];

			$XPos = $AX + $BX;
			$YPos = $AY + $BY;

			if($XPos == $data['Prize']['X'] && $YPos == $data['Prize']['Y']){
				$goodCombinaison[] = ['A' => $A, 'B' => $B];
			}
		}
	}

	if(sizeof($goodCombinaison) > 0){
		$lowestPrice = 9999999999999999999999;
		foreach ($goodCombinaison as $value) {
			$price = ($value['A'] * $priceforAToken) + ($value['B'] * $priceforBToken);
			if($price < $lowestPrice){
				$lowestPrice = $price;
			}
		}

		$totalFeverPrice += $lowestPrice;
	}
}

var_dump("---- Partie 1 ----");
var_dump("Lowest Price : " . $totalFeverPrice);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$machines = [];
$keyActual = -1;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $line = explode(' ', $line);
    if($line[0] == 'Button' && $line[1] == 'A:'){
    	$keyActual++;
    	$machines[$keyActual]['A'] = ['X' => substr(explode('+', $line[2])[1],0,-1), 'Y' => explode('+', $line[3])[1]];
    }
    if($line[0] == 'Button' && $line[1] == 'B:'){
    	$machines[$keyActual]['B'] = ['X' => substr(explode('+', $line[2])[1],0,-1), 'Y' => explode('+', $line[3])[1]];
    }
    if($line[0] == 'Prize:'){
    	$machines[$keyActual]['Prize'] = ['X' => substr(explode('=', $line[1])[1],0,-1), 'Y' => explode('=', $line[2])[1]];
    	$machines[$keyActual]['Prize']['X'] += 10000000000000;
    	$machines[$keyActual]['Prize']['Y'] += 10000000000000;
    }
}

fclose($file);

$totalFeverPrice = 0;

$priceforAToken = 3;
$priceforBToken = 1;

foreach ($machines as $numberOfMachine => $data) {

	$prizeX = $data['Prize']['X'];
	$prizeY = $data['Prize']['Y'];

	$AX = $data['A']['X'];
	$BX = $data['B']['X'];
	$AY = $data['A']['Y'];
	$BY = $data['B']['Y'];

	$numerateurX = ($prizeX * $BY) - ($prizeY * $BX);
	$denominateurX = ($AX * $BY) - ($AY * $BX);

	$numerateurY = ($prizeX * $AY) - ($prizeY * $AX);
	$denominateurY = ($AY * $BX) - ($AX * $BY);

	if($numerateurX % $denominateurX == 0 && $numerateurY % $denominateurY == 0){
		$tokenA = $numerateurX / $denominateurX;
		$tokenB = $numerateurY / $denominateurY;
		$totalFeverPrice += ($priceforAToken * abs($tokenA)) + ($priceforBToken * abs($tokenB));

	}

}

var_dump("---- Partie 2 ----");
var_dump("Lowest Price : " . $totalFeverPrice);