<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$memory = [];
$currentMask = "";
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    [$type, $data] = explode(' = ', $line);
    if($type == 'mask'){
        $currentMask = str_split(substr($line, 7));
    }
    else{
        $index = substr($type, 4, strlen($type) - 5);
        $dataBin = str_split(decbin($data));
        $bitMissing = sizeof($currentMask) - sizeof($dataBin);
        $dataBin = array_pad($dataBin, -sizeof($currentMask), '0');
        $newBinNumber = "";
        foreach ($currentMask as $key => $value) {
            if($value != 'X'){
                $newBinNumber .= $value;
            }
            else{
                $newBinNumber .= $dataBin[$key];
            }
        }
        $memory[$index] = bindec($newBinNumber);
    }
}

fclose($file);

var_dump("---- Partie 1 ----");

$sumOfAllNumber = 0;
foreach ($memory as $key => $value) {
    $sumOfAllNumber += $value;
}
var_dump($sumOfAllNumber);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$memory = [];
$currentMask = "";
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    [$type, $data] = explode(' = ', $line);
    if($type == 'mask'){
        $currentMask = str_split(substr($line, 7));
    }
    else{
        $index = str_split(decbin(substr($type, 4, strlen($type) - 5)));
        $bitMissing = sizeof($currentMask) - sizeof($index);
        $index = array_pad($index, -sizeof($currentMask), '0');
        $newIndex = "";
        foreach ($currentMask as $key => $value) {
            if($value == 1){
                $newIndex .= $value;
            }
            elseif($value == 0){
                $newIndex .= $index[$key];
            }
            else{
                $newIndex .= 'X';
            }
        }

        $combinaison = expandPattern($newIndex);

        foreach ($combinaison as $key => $value) {
            $memory[bindec($value)] = $data;
        }
    }
}

fclose($file);

var_dump("---- Partie 2 ----");

$sumOfAllNumber = 0;
foreach ($memory as $key => $value) {
    $sumOfAllNumber += $value;
}
var_dump($sumOfAllNumber);

function expandPattern(string $pattern): array {
    $pos = strpos($pattern, 'X');

    // S'il n'y a plus de X, on a une combinaison complète
    if ($pos === false) {
        return [$pattern];
    }

    $results = [];

    foreach (['0', '1'] as $bit) {
        // Remplace le X trouvé par 0 puis par 1
        $newPattern = substr($pattern, 0, $pos) . $bit . substr($pattern, $pos + 1);
        // Et on continue récursivement
        $results = array_merge($results, expandPattern($newPattern));
    }

    return $results;
}