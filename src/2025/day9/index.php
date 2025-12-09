<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$coord = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $coord[] = explode(',', $line);
}

fclose($file);

$biggestArea = 0;
foreach ($coord as $key1 => $value1) {
    foreach ($coord as $key2 => $value2) {
        if($key2 > $key1){
            $width = abs($value2[0] - $value1[0]) + 1;
            $height = abs($value2[1] - $value1[1]) + 1;
            $area = $width * $height;
            if($biggestArea < $area){
                $biggestArea = $area;
            }
        }
    }
}

var_dump("---- Partie 1 ----");
var_dump($biggestArea);

/*** Part 2 ***/

function isInsideRect(array $r1, array $r2, array $p): bool
{
    return (
        $p[0] > $r1[0] &&
        $p[0] < $r2[0] &&
        $p[1] > $r1[1] &&
        $p[1] < $r2[1]
    );
}

function checkIntersect(array $r1, array $r2, array $l1, array $l2): bool
{
    // r1, r2 : 2 coins opposés du rectangle
    // l1, l2 : 2 extrémités du segment

    // Rectangle : coin min et coin max
    $minr = [min($r1[0], $r2[0]), min($r1[1], $r2[1])];
    $maxr = [max($r1[0], $r2[0]), max($r1[1], $r2[1])];

    // Segment : min / max
    $minl = [min($l1[0], $l2[0]), min($l1[1], $l2[1])];
    $maxl = [max($l1[0], $l2[0]), max($l1[1], $l2[1])];

    // 1) Une extrémité du segment est à l'intérieur du rectangle
    $l1i = isInsideRect($minr, $maxr, $l1);
    $l2i = isInsideRect($minr, $maxr, $l2);
    if ($l1i || $l2i) {
        return true;
    }

    // 2) Segment horizontal
    if ($minl[0] === $maxl[0]) {
        // horizontal line
        $y = $minl[0];
        $c = (
            ($y > $minr[0] && $y < $maxr[0]) &&
            ($minl[1] <= $minr[1] && $maxl[1] >= $maxr[1])
        );
        return $c;
    }

    // 3) Segment vertical
    if ($minl[1] === $maxl[1]) {
        // vertical line
        $x = $minl[1];
        if (
            ($x > $minr[1] && $x < $maxr[1]) &&
            ($minl[0] <= $minr[0] && $maxl[0] >= $maxr[0])
        ) {
            return true;
        }
    }

    // 4) Pas d'intersection
    return false;
}

$file = fopen($filename, 'r');
$coord = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $coord[] = explode(',', $line);
}

fclose($file);

$biggestArea = 0;
foreach ($coord as $key1 => $value1) {
    foreach ($coord as $key2 => $value2) {
        if($key2 > $key1){
            $width = abs($value2[0] - $value1[0]) + 1;
            $height = abs($value2[1] - $value1[1]) + 1;
            $area = $width * $height; 
            if($biggestArea < $area){
                $interset = false;
                for ($k=0; $k < sizeof($coord) && !$interset; $k++) { 
                    if(isset($coord[$k + 1])){
                        $pl1 = $coord[$k];
                        $pl2 = $coord[$k + 1];
                        $interset = checkIntersect($value1, $value2, $pl1, $pl2);
                    }
                }
                if(!$interset){
                    $biggestArea = $area;
                }
            }
        }
    }
}

var_dump("---- Partie 2 ----");
var_dump($biggestArea);