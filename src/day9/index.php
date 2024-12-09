<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$diskPart = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $diskPart = str_split($line);
}

fclose($file);

$diskPartRearrange = [];

$files = true;
$cpt = 0;
$numberOfFile = 0;
foreach($diskPart as $key => $value){
    if($files){
    	$numberOfFile += $value;
        for($i = 0; $i < $value; $i++){
            $diskPartRearrange[] = $cpt;
        }
        $cpt++;
        $files = false;
    }
    else{
        for($i = 0; $i < $value; $i++){
            $diskPartRearrange[] = '.';
        }
        $files = true;
    }
}
$arrayDroite = $diskPartRearrange;
$arrayEnver = array_reverse($diskPartRearrange);
$finalArray = [];
$keyReverse = 0;
$totalKey = sizeof($arrayDroite) - 1;
foreach ($arrayDroite as $key => $value) {
	if($value == '.'){
		while($arrayEnver[$keyReverse] == '.'){
			$keyReverse++;
		}
		$finalArray[] = $arrayEnver[$keyReverse];
		$keyReverse++;
	}
	else{
		$finalArray[] = $value;
	}
}

$finalArray = array_slice($finalArray, 0, $numberOfFile, true);

var_dump("--- Partie 1 ---");
var_dump("CheckSum : " . calculateChecksum($finalArray));

function calculateChecksum($array){

    $checksum = 0;
    foreach($array as $key => $value){
        if($value != '.'){
            $checksum += ((int)$key * (int) $value);
        }
    }

    return $checksum;

}

