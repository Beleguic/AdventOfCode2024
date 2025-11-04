<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

/*$file = fopen($filename, 'r');
$unlimitedTowel = [];
$towelToDo = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if(empty($unlimitedTowel)){
        $unlimitedTowel = explode(', ', $line);
    }
    else{
        if($line != ''){
            $towelToDo[] = $line;
        }
    }

}

//var_dump($unlimitedTowel);
//var_dump($towelToDo);

$cpt = 0;

foreach ($towelToDo as $key => $value) {
    $longueurTowel = strlen($value);
    $towelTemp = "";
    $d = a($value, $unlimitedTowel, $towelTemp);
    if($d == true){
        $cpt++;
    }
}

var_dump($cpt);

function a($towel1, $unlimitedTowel, $towelTemp){
    foreach ($unlimitedTowel as $value) {

        $longueur = strlen($value);
        $dataTowel = substr($towel1, strlen($towelTemp), $longueur);

        if ($value === $dataTowel) {

            $newTowelTemp = $towelTemp . $value;

            // Si on a reconstitué toute la chaîne, c'est gagné
            if (strlen($newTowelTemp) === strlen($towel1)) {
                return true;
            }

            // On continue en profondeur
            if (a($towel1, $unlimitedTowel, $newTowelTemp)) {
                // Si en dessous on a trouvé une solution, on propage le true vers le haut
                return true;
            }
        }
    }

    // Si aucune combinaison ne marche, on retourne false
    return false;
}


//rgrruuurwuggbwgrggbrwruugrrrguwuubuwwrruwbbuubrwuwubgbwgur
//rgrruuurwuggbwgrggbrwruugrrrguwuubuwwrruwbbuubrwuwubgbwgu


/*
Boucle sur unlimited towel
Compare la longieur de la towel avec la towel todo et on acvance ...
*/

/*fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$file = fopen($filename, 'r');
$unlimitedTowel = [];
$towelToDo = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if(empty($unlimitedTowel)){
        $unlimitedTowel = explode(', ', $line);
    }
    else{
        if($line != ''){
            $towelToDo[] = $line;
        }
    }

}

//var_dump($unlimitedTowel);
//var_dump($towelToDo);

$cpt = 0;

foreach ($towelToDo as $key => $value) {
    $longueurTowel = strlen($value);
    $towelTemp = "";
    $memo = [];
    $d = countPossibilities($value, $unlimitedTowel, 0, $memo);
    $cpt += $d;
    
}

var_dump($cpt);

function countPossibilities(string $towel, array $unlimitedTowel, int $index = 0, array &$memo = []): int
{
    $len = strlen($towel);

    // Si on a atteint la fin de la chaîne : une possibilité trouvée
    if ($index === $len) {
        return 1;
    }

    // Si on dépasse (sécurité) : 0 possibilité
    if ($index > $len) {
        return 0;
    }

    // Si on a déjà calculé à partir de cet index, on réutilise
    if (isset($memo[$index])) {
        return $memo[$index];
    }

    $total = 0;

    foreach ($unlimitedTowel as $piece) {
        $pieceLen = strlen($piece);

        // Si la pièce matche à partir de $index
        if (substr($towel, $index, $pieceLen) === $piece) {
            $total += countPossibilities($towel, $unlimitedTowel, $index + $pieceLen, $memo);
        }
    }

    // On mémorise le résultat pour cet index
    $memo[$index] = $total;

    return $total;
}



fclose($file);

var_dump("---- Partie 2 ----");