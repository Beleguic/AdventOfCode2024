<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$gamma = '';
$epsilon = '';
$binaryTable = [];
$binaryNumber = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $binaryTable[] = str_split($line);
}

fclose($file);

foreach ($binaryTable as $value) {
	foreach ($value as $key => $values) {
		if(!isset($binaryNumber[$key])){
			$binaryNumber[$key] = ['1' => 0, '0' => 0];
		}
		$binaryNumber[$key][$values]++;
	}
}

foreach ($binaryNumber as $key => $value) {
	if($value[1] > $value[0]){
		$gamma .= '1';
		$epsilon .= '0';
	}
	else{
		$gamma .= '0';
		$epsilon .= '1';
	}
}

$gammaDecimal = bindec($gamma);
$epsilonDecimal = bindec($epsilon);

$result = $gammaDecimal * $epsilonDecimal;

var_dump("---- Partie 1 ----");
var_dump('Gamme * Epsilon : ' . $result);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$binaryTable = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $binaryTable[] = str_split($line);
}

fclose($file);

$gamaList = $binaryTable;
$epsilonList = $binaryTable;

$gamaBinaryNumber = '';
$epsilonBinaryNumber = '';

$lentghBinary = sizeof($gamaList[0]);

for ($i=0; $i < $lentghBinary; $i++) { 
	if($gamaBinaryNumber == ''){
		$numberOfbit = defineNumberBinary($gamaList);
		if($numberOfbit[$i][1] > $numberOfbit[$i][0]){
			foreach ($gamaList as $key => $value) {
				if($value[$i] != '1'){
					unset($gamaList[$key]);
				}
			}
		}
		else{
			if($numberOfbit[$i][1] == $numberOfbit[$i][0]){
				foreach ($gamaList as $key => $value) {
					if($value[$i] != '1'){
						unset($gamaList[$key]);
					}
				}
			}
			else{
				foreach ($gamaList as $key => $value) {
					if($value[$i] != '0'){
						unset($gamaList[$key]);
					}
				}
			}
			
		}

		if(sizeof($gamaList) == 1){
			$gamaList = array_values($gamaList);
			$gamaBinaryNumber = implode('', $gamaList[0]);
		}
	}

	if($epsilonBinaryNumber == ''){
		$numberOfbitEpsilon = defineNumberBinary($epsilonList);
		if($numberOfbitEpsilon[$i][1] > $numberOfbitEpsilon[$i][0]){
			foreach ($epsilonList as $key => $value) {
				if($value[$i] != '0'){
					unset($epsilonList[$key]);
				}
			}
		}
		else{
			if($numberOfbitEpsilon[$i][1] == $numberOfbitEpsilon[$i][0]){
				foreach ($epsilonList as $key => $value) {
					if($value[$i] != '0'){
						unset($epsilonList[$key]);
					}
				}
			}
			else{
				foreach ($epsilonList as $key => $value) {
					if($value[$i] != '1'){
						unset($epsilonList[$key]);
					}
				}
			}
			
		}

		if(sizeof($epsilonList) == 1){
			$epsilonList = array_values($epsilonList);
			$epsilonBinaryNumber = implode('', $epsilonList[0]);
		}
	}
}

$gammaDecimal = bindec($gamaBinaryNumber);
$epsilonDecimal = bindec($epsilonBinaryNumber);

$result = $gammaDecimal * $epsilonDecimal;

var_dump("---- Partie 2 ----");
var_dump('Gamme * Epsilon : ' . $result);

function defineNumberBinary($binaryTable){

	foreach ($binaryTable as $value) {
		foreach ($value as $key => $values) {
			if(!isset($binaryNumber[$key])){
				$binaryNumber[$key] = ['1' => 0, '0' => 0];
			}
			$binaryNumber[$key][$values]++;
		}
	}

	return $binaryNumber;

}