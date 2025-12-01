<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$stone = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $stone = explode(' ',$line);
}

fclose($file);

$numberOfBlink = 25;

for($i = 0; $i < $numberOfBlink; $i++){
    $newStoneList = [];
    foreach($stone as $key => $oneStone){
        $newStone = determineWhichRule($oneStone);
        foreach($newStone as $oneNewStone){
            $newStoneList[] = $oneNewStone;
        }
    }
    $stone = $newStoneList;
}

var_dump("---- Partie 1 ----");
var_dump("Nomber of stone afeter ".$numberOfBlink." : " . sizeof($stone));

/*** Part 2 ***/

$file = fopen($filename, 'r');
$stone = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $stoneTemp = explode(' ',$line);
}

fclose($file);

$stone = [];
foreach ($stoneTemp as $key => $value) {
	$quantity = 1;
	if(!isset($stone[$value])){
		$stone[$value] = ['value' => $value, 'quantity' => 0];
	}
	$stone[$value]['quantity'] += $quantity;
}

$numberOfBlink = 75;

for($i = 0; $i < $numberOfBlink; $i++){
    $newStoneList = [];
    foreach($stone as $key => $oneStone){
    	$quantity = $oneStone['quantity'];
    	$value = $oneStone['value'];
        $newStone = determineWhichRule($value);
        foreach($newStone as $oneNewStone){
        	if(!isset($newStoneList[$oneNewStone])){
        		$newStoneList[$oneNewStone] = ['value' => $oneNewStone, 'quantity' => 0];
        	}
        	$newStoneList[$oneNewStone]['quantity'] += $quantity;
            
        }
    }
    $stone = $newStoneList;
}

$numberOfTotalStone = 0;
foreach ($stone as $key => $value) {
	$numberOfTotalStone += $value['quantity'];
}

var_dump("---- Partie 2 ----");
var_dump("Number of stone after ".$numberOfBlink." : " . $numberOfTotalStone);


function determineWhichRule($oneStone){

    $oneStone = (int) $oneStone;

    if($oneStone == '0'){
        return [1];
    }
    elseif(strlen($oneStone) % 2 === 0){
        $firstStone = substr($oneStone,0,strlen($oneStone) / 2);
        $secondStone = substr($oneStone,strlen($oneStone) / 2);

        $firstStone = (int) $firstStone;
        $secondStone = (int) $secondStone;

        return [$firstStone, $secondStone];
    }
    else{
        return [$oneStone * 2024];
    }

}
