<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

/*$file = fopen($filename, 'r');
$leastButtonPush = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $lineExploded = explode(' ', $line);

    $light = $lineExploded[0];
    $joltage = $lineExploded[sizeof($lineExploded) - 1];
    unset($lineExploded[sizeof($lineExploded) - 1]);
    unset($lineExploded[0]);
    $buttons = array_values($lineExploded);

    $light = str_split(substr(substr($light, 1), 0, -1));

    $bitMaskLight = "";
    foreach ($light as $key => $value) {
        if($value == '.'){
            $bitMaskLight .= "0";
        }
        else{
            $bitMaskLight .= "1";
        }
    }

    $bitMaskButtons = [];

    foreach ($buttons as $key => $value) {
        $button = explode(',', substr(substr($value, 1), 0, -1));
        $bitMaskButton = array_fill(0, sizeof($light), 0);
        foreach ($button as $key => $value) {
            $bitMaskButton[$value] = 1;
        }
        $bitMaskButtons[] = implode('', $bitMaskButton);
    }

    $findFirstTime = false;
    foreach ($bitMaskButtons as $key => $value) {
        if($value == $bitMaskLight){
            $leastButtonPush++;
            $findFirstTime = true;
            break;
        }
    }

    if(!$findFirstTime){

        // BFS sur les états en chaîne binaire (ex: "0101")
        $start = str_repeat('0', strlen($bitMaskLight));

        // Cas trivial : tout est déjà bon
        if ($start === $bitMaskLight) {
            // 0 pressions à ajouter
        } else {
            $visited = [];
            $queue   = [];
            $head = 0;

            $visited[$start] = 0;
            $queue[] = $start;

            $foundDist = null;

            while ($head < count($queue)) {
                $state = $queue[$head];
                $dist  = $visited[$state];
                $head++;

                // Si on a atteint la configuration cible
                if ($state === $bitMaskLight) {
                    $foundDist = $dist;
                    break;
                }

                // On essaye d'appuyer sur chaque bouton
                foreach ($bitMaskButtons as $mask) {
                    $next = $state;
                    $len = strlen($next);

                    // Appliquer le XOR bit à bit (toggle) entre state et mask
                    for ($i = 0; $i < $len; $i++) {
                        if ($mask[$i] === '1') {
                            $next[$i] = ($next[$i] === '0') ? '1' : '0';
                        }
                    }

                    if (!array_key_exists($next, $visited)) {
                        $visited[$next] = $dist + 1;
                        $queue[] = $next;
                    }
                }
            }

            if ($foundDist !== null) {
                $leastButtonPush += $foundDist;
            }
        }


    }

}

fclose($file);

var_dump("---- Partie 1 ----");
var_dump($leastButtonPush);

/*** Part 2 ***/

/*** Part 2 ***/
/*** Part 2 ***/

$file = fopen($filename, 'r');
$leastButtonPush = 0;

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    if ($line === '') {
        continue;
    }

    $lineExploded = explode(' ', $line);

    $light   = $lineExploded[0];
    $joltage = $lineExploded[sizeof($lineExploded) - 1];
    unset($lineExploded[sizeof($lineExploded) - 1]); // enlève { ... }
    unset($lineExploded[0]);                         // enlève [lights]
    $buttons = array_values($lineExploded);

    // Joltage = vecteur d'entiers
    $joltage = explode(',', substr(substr($joltage, 1), 0, -1));
    $joltage = array_map('intval', $joltage);
    $n = count($joltage);

    // Construire les boutons comme vecteurs 0/1 de taille n
    $bitMaskButtons = [];
    foreach ($buttons as $value) {
        $button = explode(',', substr(substr($value, 1), 0, -1));
        $mask   = array_fill(0, $n, 0);
        foreach ($button as $v) {
            $v = trim($v);
            if ($v === '') continue;
            $idx = intval($v);
            if ($idx >= 0 && $idx < $n) {
                $mask[$idx] = 1;
            }
        }
        $bitMaskButtons[] = $mask;
    }

    $best = solveMachinePart2($joltage, $bitMaskButtons);

    if ($best === PHP_INT_MAX) {
        // en théorie ça ne devrait pas arriver pour l'input AoC
        // tu peux faire un var_dump ou ignorer
        // var_dump("Pas de solution pour cette ligne");
    } else {
        $leastButtonPush += $best;
    }
}

fclose($file);

var_dump("---- Partie 2 ----");
var_dump($leastButtonPush);



// Encode un état (vecteur d'entiers) -> un index unique [0 .. totalStates-1]
function encodeState(array $vec, array $mul): int {
    $idx = 0;
    $len = count($vec);
    for ($i = 0; $i < $len; $i++) {
        $idx += $vec[$i] * $mul[$i];
    }
    return $idx;
}

// Decode un index -> vecteur d'entiers
function decodeState(int $idx, array $sizes): array {
    $len = count($sizes);
    $vec = array_fill(0, $len, 0);
    for ($i = 0; $i < $len; $i++) {
        $s = $sizes[$i];
        $vec[$i] = $idx % $s;
        $idx = intdiv($idx, $s);
    }
    return $vec;
}

// Bitset : tester si visité
function isVisited(string $visited, int $idx): bool {
    $byte = intdiv($idx, 8);
    $bit  = $idx & 7;
    $ord  = ord($visited[$byte]);
    return (($ord >> $bit) & 1) === 1;
}

// Bitset : marquer comme visité
function setVisited(string &$visited, int $idx): void {
    $byte = intdiv($idx, 8);
    $bit  = $idx & 7;
    $ord  = ord($visited[$byte]);
    $ord |= (1 << $bit);
    $visited[$byte] = chr($ord);
}

function solveMachinePart2(array $joltage, array $buttonMasks): int
{
    $nLights  = count($joltage);
    $nButtons = count($buttonMasks);

    // Boutons vides ? (normalement non, mais par sécurité)
    if ($nButtons === 0) {
        foreach ($joltage as $v) {
            if ($v !== 0) {
                return PHP_INT_MAX; // impossible
            }
        }
        return 0;
    }

    // Convertir les masks en int (0/1) et calculer le nb de lumières touchées
    $touchCounts = [];
    foreach ($buttonMasks as $i => $mask) {
        $count = 0;
        for ($j = 0; $j < $nLights; $j++) {
            $buttonMasks[$i][$j] = (int)$mask[$j];
            if ($buttonMasks[$i][$j] === 1) {
                $count++;
            }
        }
        $touchCounts[$i] = $count;
    }

    // Si un bouton ne touche aucune lumière, il ne sert à rien -> on l’ignore
    $filteredButtons = [];
    foreach ($buttonMasks as $i => $mask) {
        if ($touchCounts[$i] > 0) {
            $filteredButtons[] = $mask;
        }
    }
    $buttonMasks = $filteredButtons;
    $nButtons    = count($buttonMasks);

    if ($nButtons === 0) {
        foreach ($joltage as $v) {
            if ($v !== 0) {
                return PHP_INT_MAX;
            }
        }
        return 0;
    }

    // Recalcule touchCounts et maxLightsPerButton après filtrage
    $touchCounts = [];
    $maxLightsPerButton = 0;
    foreach ($buttonMasks as $i => $mask) {
        $count = array_sum($mask);
        $touchCounts[$i] = $count;
        if ($count > $maxLightsPerButton) {
            $maxLightsPerButton = $count;
        }
    }

    // Heuristique : trier les boutons par nb de lumières touchées (desc) pour mieux réduire vite
    $indices = range(0, $nButtons - 1);
    usort($indices, function ($a, $b) use ($touchCounts) {
        return $touchCounts[$b] <=> $touchCounts[$a];
    });
    $sortedButtons = [];
    foreach ($indices as $idx) {
        $sortedButtons[] = $buttonMasks[$idx];
    }
    $buttonMasks = $sortedButtons;

    $best = PHP_INT_MAX;

    // DFS / backtracking avec branch & bound
    $dfs = function (int $buttonIndex, array $remainingJ, int $currentPresses)
        use (&$dfs, $buttonMasks, $nButtons, $nLights, $maxLightsPerButton, &$best)
    {
        // Somme de ce qu'il reste à "remplir"
        $totalRemaining = 0;
        for ($j = 0; $j < $nLights; $j++) {
            $totalRemaining += $remainingJ[$j];
        }

        // Si plus rien à faire -> solution complète
        if ($totalRemaining === 0) {
            if ($currentPresses < $best) {
                $best = $currentPresses;
            }
            return;
        }

        // Plus de boutons disponibles -> impossible
        if ($buttonIndex >= $nButtons) {
            return;
        }

        // Lower bound grossier : même si chaque prochain appui
        // réduit au max de maxLightsPerButton, il en faut au moins :
        $lb = intdiv($totalRemaining + $maxLightsPerButton - 1, $maxLightsPerButton);
        if ($currentPresses + $lb >= $best) {
            return; // même en étant ultra optimiste, on ne bat pas best
        }

        $mask = $buttonMasks[$buttonIndex];

        // maxPress pour ce bouton = min des remainingJ[j] sur les lumières touchées
        $maxPress = PHP_INT_MAX;
        $touchesSomething = false;
        for ($j = 0; $j < $nLights; $j++) {
            if ($mask[$j] === 1) {
                $touchesSomething = true;
                if ($remainingJ[$j] < $maxPress) {
                    $maxPress = $remainingJ[$j];
                }
            }
        }

        if (!$touchesSomething || $maxPress === 0) {
            // Ce bouton ne change rien (plus rien à faire sur ses lumières)
            // -> on passe au suivant
            $dfs($buttonIndex + 1, $remainingJ, $currentPresses);
            return;
        }

        // On essaie k pressions de ce bouton, de 0 à maxPress
        // On commence par k=0 (souvent moins de pressions = meilleur)
        for ($k = 0; $k <= $maxPress; $k++) {
            // Si déjà on dépasse le best actuel, pas la peine d'aller plus loin
            if ($currentPresses + $k >= $best) {
                break;
            }

            $newRemaining = $remainingJ;

            if ($k > 0) {
                // Appliquer k pressions : chaque lumière touchée est décrémentée de k
                for ($j = 0; $j < $nLights; $j++) {
                    if ($mask[$j] === 1) {
                        $newRemaining[$j] -= $k;
                        if ($newRemaining[$j] < 0) {
                            // On a appuyé trop de fois -> état invalide
                            // on arrête cette valeur de k
                            continue 2; // continue la boucle sur k
                        }
                    }
                }
            }

            $dfs($buttonIndex + 1, $newRemaining, $currentPresses + $k);
        }
    };

    $dfs(0, $joltage, 0);

    return $best;
}
