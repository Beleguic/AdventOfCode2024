<?php

ini_set('memory_limit', '8095M');
set_time_limit(-1);

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

/*$file = fopen($filename, 'r');
$stone = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $stone = explode(' ',$line);
}

fclose($file);
*/

$numberOfBlink = 75;

for($i = 0; $i < $numberOfBlink; $i++){
    $fichierTampon = "./fileTemp".$i.".txt";
    $fichier = fopen($fichierTampon, "r");
    $fichierResult = "./fileTemp".($i + 1).".txt";
    $fichierRes = fopen($fichierResult, "a");
    var_dump($i);
    while ($line = fgets($fichier)) {
        $oneStone = str_replace("\n", "", $line);
        $newStone = determineWhichRule($oneStone);
        foreach($newStone as $oneNewStone){
            fwrite($fichierRes, $oneNewStone . "\n");
        }
    }
    fclose($fichier);
    fclose($fichierRes);
}

$numberOfTotalStone = 0;
$result = fopen("./fileTemp75.txt", 'r');
while($line = fgets($result)){
    $numberOfTotalStone++;
}

var_dump("---- Partie 2 ----");
var_dump("Nomber of stone afeter ".$numberOfBlink." : " . $numberOfTotalStone);

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