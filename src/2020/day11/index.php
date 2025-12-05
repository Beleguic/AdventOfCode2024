<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$seats = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $seats[] = str_split($line);
}

fclose($file);

$isSeatchange = true;
while($isSeatchange){

    $seatsTemp = $seats;

    $changeSeatCount = 0;

    foreach ($seatsTemp as $ligneKey => $column) {
        foreach ($column as $columnKey => $value) {
            if($value == 'L'){
                $occupiedSeat = 0;
                if(isset($seatsTemp[$ligneKey][$columnKey + 1]) && $seatsTemp[$ligneKey][$columnKey + 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey][$columnKey - 1]) && $seatsTemp[$ligneKey][$columnKey - 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey + 1][$columnKey]) && $seatsTemp[$ligneKey + 1][$columnKey] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey - 1][$columnKey]) && $seatsTemp[$ligneKey - 1][$columnKey] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey + 1][$columnKey - 1]) && $seatsTemp[$ligneKey + 1][$columnKey - 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey + 1][$columnKey + 1]) && $seatsTemp[$ligneKey + 1][$columnKey + 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey - 1][$columnKey - 1]) && $seatsTemp[$ligneKey - 1][$columnKey - 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey - 1][$columnKey + 1]) && $seatsTemp[$ligneKey - 1][$columnKey + 1] == '#'){
                    $occupiedSeat++;
                }

                if($occupiedSeat == 0){
                    $seats[$ligneKey][$columnKey] = "#";
                    $changeSeatCount++;
                }
            }
            elseif($value == '#'){
                $occupiedSeat = 0;
                if(isset($seatsTemp[$ligneKey][$columnKey + 1]) && $seatsTemp[$ligneKey][$columnKey + 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey][$columnKey - 1]) && $seatsTemp[$ligneKey][$columnKey - 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey + 1][$columnKey]) && $seatsTemp[$ligneKey + 1][$columnKey] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey - 1][$columnKey]) && $seatsTemp[$ligneKey - 1][$columnKey] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey + 1][$columnKey - 1]) && $seatsTemp[$ligneKey + 1][$columnKey - 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey + 1][$columnKey + 1]) && $seatsTemp[$ligneKey + 1][$columnKey + 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey - 1][$columnKey - 1]) && $seatsTemp[$ligneKey - 1][$columnKey - 1] == '#'){
                    $occupiedSeat++;
                }
                if(isset($seatsTemp[$ligneKey - 1][$columnKey + 1]) && $seatsTemp[$ligneKey - 1][$columnKey + 1] == '#'){
                    $occupiedSeat++;
                }

                if($occupiedSeat > 3){
                    $seats[$ligneKey][$columnKey] = "L";
                    $changeSeatCount++;
                }
            }

        }
    }


    if($changeSeatCount == 0){
        $isSeatchange = false;
    }

}

$occupiedSeat = 0;
foreach ($seatsTemp as $ligneKey => $column) {
    foreach ($column as $columnKey => $value) {
        if($value == '#'){
            $occupiedSeat++;
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump($occupiedSeat);
/*** Part 2 ***/

$file = fopen($filename, 'r');
$seats = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $seats[] = str_split($line);
}

fclose($file);

$isSeatchange = true;
while($isSeatchange){

    $seatsTemp = $seats;

    $changeSeatCount = 0;

    foreach ($seatsTemp as $ligneKey => $column) {
        foreach ($column as $columnKey => $value) {
            if($value == 'L'){
                $occupiedSeat = 0;

                $y=1;
                while(isset($seatsTemp[$ligneKey][$columnKey + $y]) && $seatsTemp[$ligneKey][$columnKey + $y] == '.'){
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey][$columnKey + $y]) && $seatsTemp[$ligneKey][$columnKey + $y] == '#'){
                    $occupiedSeat++;
                }

                $y=1;
                while(isset($seatsTemp[$ligneKey][$columnKey - $y]) && $seatsTemp[$ligneKey][$columnKey - $y] == '.'){
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey][$columnKey - $y]) && $seatsTemp[$ligneKey][$columnKey - $y] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                while(isset($seatsTemp[$ligneKey + $x][$columnKey]) && $seatsTemp[$ligneKey + $x][$columnKey] == '.'){
                    $x++;
                }
                if(isset($seatsTemp[$ligneKey + $x][$columnKey]) && $seatsTemp[$ligneKey + $x][$columnKey] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                while(isset($seatsTemp[$ligneKey - $x][$columnKey]) && $seatsTemp[$ligneKey - $x][$columnKey] == '.'){
                    $x++;
                }
                if(isset($seatsTemp[$ligneKey - $x][$columnKey]) && $seatsTemp[$ligneKey - $x][$columnKey] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                $y=1;
                while(isset($seatsTemp[$ligneKey + $x][$columnKey - $y]) && $seatsTemp[$ligneKey + $x][$columnKey - $y] == '.'){
                    $x++;
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey + $x][$columnKey - $y]) && $seatsTemp[$ligneKey + $x][$columnKey - $y] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                $y=1;
                while(isset($seatsTemp[$ligneKey + $x][$columnKey + $y]) && $seatsTemp[$ligneKey + $x][$columnKey + $y] == '.'){
                    $x++;
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey + $x][$columnKey + $y]) && $seatsTemp[$ligneKey + $x][$columnKey + $y] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                $y=1;
                while(isset($seatsTemp[$ligneKey - $x][$columnKey - $y]) && $seatsTemp[$ligneKey - $x][$columnKey - $y] == '.'){
                    $x++;
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey - $x][$columnKey - $y]) && $seatsTemp[$ligneKey - $x][$columnKey - $y] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                $y=1;
                while(isset($seatsTemp[$ligneKey - $x][$columnKey + $y]) && $seatsTemp[$ligneKey - $x][$columnKey + $y] == '.'){
                    $x++;
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey - $x][$columnKey + $y]) && $seatsTemp[$ligneKey - $x][$columnKey + $y] == '#'){
                    $occupiedSeat++;
                }

                if($occupiedSeat == 0){
                    $seats[$ligneKey][$columnKey] = "#";
                    $changeSeatCount++;
                }
            }
            elseif($value == '#'){
                $occupiedSeat = 0;

                $y=1;
                while(isset($seatsTemp[$ligneKey][$columnKey + $y]) && $seatsTemp[$ligneKey][$columnKey + $y] == '.'){
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey][$columnKey + $y]) && $seatsTemp[$ligneKey][$columnKey + $y] == '#'){
                    $occupiedSeat++;
                }

                $y=1;
                while(isset($seatsTemp[$ligneKey][$columnKey - $y])  && $seatsTemp[$ligneKey][$columnKey - $y] == '.'){
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey][$columnKey - $y])  && $seatsTemp[$ligneKey][$columnKey - $y] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                while(isset($seatsTemp[$ligneKey + $x][$columnKey])  && $seatsTemp[$ligneKey + $x][$columnKey] == '.'){
                    $x++;
                }
                if(isset($seatsTemp[$ligneKey + $x][$columnKey])  && $seatsTemp[$ligneKey + $x][$columnKey] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                while(isset($seatsTemp[$ligneKey - $x][$columnKey])  && $seatsTemp[$ligneKey - $x][$columnKey] == '.'){
                    $x++;
                }
                if(isset($seatsTemp[$ligneKey - $x][$columnKey])  && $seatsTemp[$ligneKey - $x][$columnKey] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                $y=1;
                while(isset($seatsTemp[$ligneKey + $x][$columnKey - $y]) && $seatsTemp[$ligneKey + $x][$columnKey - $y] == '.'){
                    $x++;
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey + $x][$columnKey - $y]) && $seatsTemp[$ligneKey + $x][$columnKey - $y] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                $y=1;
                while(isset($seatsTemp[$ligneKey + $x][$columnKey + $y]) && $seatsTemp[$ligneKey + $x][$columnKey + $y] == '.'){
                    $x++;
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey + $x][$columnKey + $y]) && $seatsTemp[$ligneKey + $x][$columnKey + $y] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                $y=1;
                while(isset($seatsTemp[$ligneKey - $x][$columnKey - $y]) && $seatsTemp[$ligneKey - $x][$columnKey - $y] == '.'){
                    $x++;
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey - $x][$columnKey - $y]) && $seatsTemp[$ligneKey - $x][$columnKey - $y] == '#'){
                    $occupiedSeat++;
                }

                $x=1;
                $y=1;
                while(isset($seatsTemp[$ligneKey - $x][$columnKey + $y]) && $seatsTemp[$ligneKey - $x][$columnKey + $y] == '.'){
                    $x++;
                    $y++;
                }
                if(isset($seatsTemp[$ligneKey - $x][$columnKey + $y]) && $seatsTemp[$ligneKey - $x][$columnKey + $y] == '#'){
                    $occupiedSeat++;
                }

                if($occupiedSeat > 4){
                    $seats[$ligneKey][$columnKey] = "L";
                    $changeSeatCount++;
                }
            }

        }
    }


    if($changeSeatCount == 0){
        $isSeatchange = false;
    }

}

$occupiedSeat = 0;
foreach ($seatsTemp as $ligneKey => $column) {
    foreach ($column as $columnKey => $value) {
        if($value == '#'){
            $occupiedSeat++;
        }
    }
}

var_dump("---- Partie 2 ----");
var_dump($occupiedSeat);