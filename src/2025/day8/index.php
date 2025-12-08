<?php

set_time_limit(3600);
ini_set('memory_limit', '512M');

/*** Part 1 ***/
echo "<pre>";

$filename = './input';

// --- Lecture et préparation des points ---
$points = [];

$file = fopen($filename, 'r');
if ($file === false) {
    die("Impossible d'ouvrir le fichier\n");
}

while (($line = fgets($file)) !== false) {
    $line = trim($line);          // enlève \n, \r, espaces…
    if ($line === '') {
        continue;                 // ignore les lignes vides
    }

    // On convertit directement en entiers
    $coords = array_map('intval', explode(',', $line));
    // $coords = [x, y, z]
    $points[] = $coords;
}

fclose($file);

// --- Préparation des circuits ---
$circuits = [];
$pointsHistory = [];
$previousDistance = 0;
$numberOfCircuit = 0;

// --- Calcul des K plus petites distances au carré entre paires de points ---

$nbPoints = count($points);
$maxEdges = 1000;          // comme ta boucle d’origine
$distances = [];           // contiendra AU MAXIMUM 1000 entrées
$currentMaxD2 = -1;
$currentMaxIndex = -1;

for ($i = 0; $i < $nbPoints; $i++) {
    [$ax, $ay, $az] = $points[$i];

    for ($j = $i + 1; $j < $nbPoints; $j++) {
        [$bx, $by, $bz] = $points[$j];

        $dx = $ax - $bx;
        $dy = $ay - $by;
        $dz = $az - $bz;
        $d2 = $dx * $dx + $dy * $dy + $dz * $dz;

        $edgeCount = count($distances);

        if ($edgeCount < $maxEdges) {
            // On remplit d'abord jusqu'à atteindre maxEdges
            $distances[] = [
                'A'  => $i,
                'B'  => $j,
                'd2' => $d2,
            ];

            // Mise à jour du max courant
            if ($d2 > $currentMaxD2) {
                $currentMaxD2   = $d2;
                $currentMaxIndex = $edgeCount; // index du dernier push
            }
        } else {
            // On a déjà maxEdges distances : on ne garde que les plus petites
            if ($d2 < $currentMaxD2) {
                // On remplace l'arête la plus grande par celle-ci
                $distances[$currentMaxIndex] = [
                    'A'  => $i,
                    'B'  => $j,
                    'd2' => $d2,
                ];

                // On recalcule le max parmi les 1000 (tableau assez petit)
                $currentMaxD2   = $distances[0]['d2'];
                $currentMaxIndex = 0;

                $edgeCount = $maxEdges; // fixe
                for ($k = 1; $k < $edgeCount; $k++) {
                    if ($distances[$k]['d2'] > $currentMaxD2) {
                        $currentMaxD2   = $distances[$k]['d2'];
                        $currentMaxIndex = $k;
                    }
                }
            }
        }
    }
}

// Maintenant on trie ces 1000 distances par ordre croissant
usort($distances, function ($a, $b) {
    return $a['d2'] <=> $b['d2'];
});

for ($i=0; $i < 1000; $i++){

    $pairOfValue['A'] = implode(',',$points[$distances[$i]['A']]);
    $pairOfValue['B'] = implode(',',$points[$distances[$i]['B']]);

    $isAAlreadyInCircuit = false;
    $isBAlreadyInCircuit = false;
    foreach ($circuits as $key => $value) {
        if($key == $pairOfValue['A']){
            $isAAlreadyInCircuit = true;
        }
        if($key == $pairOfValue['B']){
            $isBAlreadyInCircuit = true;
        }
    }

    if($isAAlreadyInCircuit && $isBAlreadyInCircuit){
        $valueOfB = 0;
        $valueOfA = 0;
        foreach ($circuits as $key => $value) {
            if($key == $pairOfValue['B']){
                $valueOfB = $value;
            }
            if($key == $pairOfValue['A']){
                $valueOfA = $value;
            }
        }

        foreach ($circuits as $key => $value) {
            if($value == $valueOfB){
                $circuits[$key] = $valueOfA;
            }
        }
    }
    elseif($isAAlreadyInCircuit && !$isBAlreadyInCircuit){
        foreach ($circuits as $key => $value) {
            if($key == $pairOfValue['A']){
                $circuits[$pairOfValue['A']] = $value;
                $circuits[$pairOfValue['B']] = $value;
            }
        }
    }
    elseif(!$isAAlreadyInCircuit && $isBAlreadyInCircuit){
        foreach ($circuits as $key => $value) {
            if($key == $pairOfValue['B']){
                $circuits[$pairOfValue['A']] = $value;
                $circuits[$pairOfValue['B']] = $value;
            }
        }
    }
    else{
        $numberOfCircuit++;
        $circuits[$pairOfValue['A']] = $numberOfCircuit;
        $circuits[$pairOfValue['B']] = $numberOfCircuit;
    }
}

$numberOfElementInEachCircuit = [];

foreach ($circuits as $key => $value) {
    if(!isset($numberOfElementInEachCircuit[$value])){
        $numberOfElementInEachCircuit[$value] = 0;
    }
    $numberOfElementInEachCircuit[$value]++;
}

rsort($numberOfElementInEachCircuit);

var_dump("---- Partie 1 ----");
var_dump($numberOfElementInEachCircuit[0] * $numberOfElementInEachCircuit[1] * $numberOfElementInEachCircuit[2]);


/*** Part 2 ***/

$points = [];

$file = fopen($filename, 'r');
if ($file === false) {
    die("Impossible d'ouvrir le fichier\n");
}

while (($line = fgets($file)) !== false) {
    $line = trim($line);          // enlève \n, \r, espaces…
    if ($line === '') {
        continue;                 // ignore les lignes vides
    }

    // On convertit directement en entiers
    $coords = array_map('intval', explode(',', $line));
    // $coords = [x, y, z]
    $points[] = $coords;
}

fclose($file);

// --- Préparation des circuits ---
$circuits = [];
$pointsHistory = [];
$previousDistance = 0;
$numberOfCircuit = 0;

// --- Calcul des K plus petites distances au carré entre paires de points ---

$nbPoints = count($points);
$distances = [];
$cpt = 0;
for ($i = 0; $i < $nbPoints; $i++) {
    [$ax, $ay, $az] = $points[$i];

    for ($j = $i + 1; $j < $nbPoints; $j++) {

        if($i < $j){

            [$bx, $by, $bz] = $points[$j];

            $dx = $ax - $bx;
            $dy = $ay - $by;
            $dz = $az - $bz;

            // On remplit d'abord jusqu'à atteindre maxEdges
            $distances[] = [
                'A'  => $i,
                'B'  => $j,
                'd2' => $dx * $dx + $dy * $dy + $dz * $dz,
            ];
        }
    }
}

// Maintenant on trie ces 1000 distances par ordre croissant
usort($distances, function ($a, $b) {
    return $a['d2'] <=> $b['d2'];
});

$numberOfJunction = 0;

$i = 0;
while(isset($distances[$i])){

    $pairOfValue['A'] = implode(',',$points[$distances[$i]['A']]);
    $pairOfValue['B'] = implode(',',$points[$distances[$i]['B']]);

    $isAAlreadyInCircuit = false;
    $isBAlreadyInCircuit = false;
    foreach ($circuits as $key => $value) {
        if($key == $pairOfValue['A']){
            $isAAlreadyInCircuit = true;
        }
        if($key == $pairOfValue['B']){
            $isBAlreadyInCircuit = true;
        }
    }

    if($isAAlreadyInCircuit && $isBAlreadyInCircuit){
        $valueOfB = 0;
        $valueOfA = 0;
        foreach ($circuits as $key => $value) {
            if($key == $pairOfValue['B']){
                $valueOfB = $value;
            }
            if($key == $pairOfValue['A']){
                $valueOfA = $value;
            }
        }

        foreach ($circuits as $key => $value) {
            if($value == $valueOfB){
                $circuits[$key] = $valueOfA;
            }
        }
    }
    elseif($isAAlreadyInCircuit && !$isBAlreadyInCircuit){
        $numberOfJunction++;
        foreach ($circuits as $key => $value) {
            if($key == $pairOfValue['A']){
                $circuits[$pairOfValue['A']] = $value;
                $circuits[$pairOfValue['B']] = $value;
            }
        }
    }
    elseif(!$isAAlreadyInCircuit && $isBAlreadyInCircuit){
        $numberOfJunction++;
        foreach ($circuits as $key => $value) {
            if($key == $pairOfValue['B']){
                $circuits[$pairOfValue['A']] = $value;
                $circuits[$pairOfValue['B']] = $value;
            }
        }
    }
    else{
        $numberOfJunction++;
        $numberOfJunction++;
        $numberOfCircuit++;
        $circuits[$pairOfValue['A']] = $numberOfCircuit;
        $circuits[$pairOfValue['B']] = $numberOfCircuit;
    }

    $diffrentCircuit = [];
    foreach ($circuits as $key => $value) {
        $diffrentCircuit[$value] = $value;
    }

    if(sizeof($diffrentCircuit) == 1 && $numberOfJunction == sizeof($points)){
        break;
    }

    $i++;
}

$x1 = explode(',', $pairOfValue['A'])[0];
$x2 = explode(',', $pairOfValue['B'])[0];

var_dump("---- Partie 2 ----");
var_dump($x1 * $x2);

