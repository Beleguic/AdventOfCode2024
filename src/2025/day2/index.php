<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
<<<<<<< HEAD
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

var_dump("---- Partie 1 ----");
=======
$invalidId = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $code = explode(',', $line);

    foreach ($code as $key => $value) {
        [$start, $end] = explode('-', $value);
        for ($i=$start; $i <= $end; $i++) { 
            if(strlen($i) % 2 == 0){

                $first = substr($i, 0, strlen($i)/2);
                $second = substr($i,strlen($i)/2);

                if($first == $second){

                    $invalidId += $i;
                }
            }
        }
    }
}
fclose($file);

var_dump("---- Partie 1 ----");
var_dump($invalidId);
var_dump('@@@@@');
>>>>>>> 0349dc4b4786af03c3715c1ecc30795f12b0a53e

/*** Part 2 ***/

$file = fopen($filename, 'r');
<<<<<<< HEAD
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



=======
$invalidId = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $code = explode(',', $line);

    foreach ($code as $key => $value) {
        [$start, $end] = explode('-', $value);
        for ($i=$start; $i <= $end; $i++) { 
            $alreadyFind = false;
            for ($j=2; $j <= strlen($i); $j++) {
                if(!$alreadyFind){
                    $longueur = strlen($i)/$j;
                    if(strlen($longueur) < 2){                    
                        $data = str_split($i, $longueur);
                        $equal = true;
                        foreach ($data as $keyData => $valueData) {
                            if(isset($data[$keyData + 1])){
                                if($valueData != $data[$keyData + 1]){
                                    $equal = false;
                                }
                            }
                        }
                        if($equal){
                            $invalidId += $i;
                            $alreadyFind = true;
                        }
                    }
                }
            }
        }
    }
>>>>>>> 0349dc4b4786af03c3715c1ecc30795f12b0a53e
}

fclose($file);

<<<<<<< HEAD
var_dump("---- Partie 2 ----");
=======
var_dump("---- Partie 2 ----");
var_dump($invalidId);
>>>>>>> 0349dc4b4786af03c3715c1ecc30795f12b0a53e
