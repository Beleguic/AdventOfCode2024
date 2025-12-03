<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
// f = 0, b = 1 // r = 1, l = 0

$poidsColumn = [64,32,16,8,4,2,1];
$poidsSeat = [4,2,1];
$highestSeatID = 0;

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $column = str_split(substr($line, 0,7));
    $seat = str_split(substr($line, -3));

    $poidColumn = 0;
    foreach ($column as $key => $value) {
        if($value == 'B'){
            $poidColumn += $poidsColumn[$key];
        }
    }

    $poidSeat = 0;
    foreach ($seat as $key => $value) {
        if($value == 'R'){
            $poidSeat += $poidsSeat[$key];
        }
    }

    $seatID = ($poidColumn * 8) + $poidSeat;

    if($highestSeatID < $seatID){
        $highestSeatID = $seatID;
    }

}

fclose($file);

var_dump("---- Partie 1 ----");
var_dump($highestSeatID);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$poidsColumn = [64,32,16,8,4,2,1];
$poidsSeat = [4,2,1];
$seats = [];

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $column = str_split(substr($line, 0,7));
    $seat = str_split(substr($line, -3));

    $poidColumn = 0;
    foreach ($column as $key => $value) {
        if($value == 'B'){
            $poidColumn += $poidsColumn[$key];
        }
    }

    $poidSeat = 0;
    foreach ($seat as $key => $value) {
        if($value == 'R'){
            $poidSeat += $poidsSeat[$key];
        }
    }

    $seatID = ($poidColumn * 8) + $poidSeat;
    $seats[] = $seatID;

}

sort($seats);

foreach ($seats as $key => $value) {
    if(isset($seats[$key + 1])){
        if($seats[$key + 1] != $value + 1){
            var_dump("Seat -1 : " . $value . ", Seat +1 : " . $seats[$key + 1]);
        }
    }
}

fclose($file);

var_dump("---- Partie 2 ----");