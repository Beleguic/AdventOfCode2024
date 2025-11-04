<?php

/*** Part 1 ***/
/*echo("<pre>");

$filename = './input';

//$table = array_fill(0,7, array_fill(0,7, '.'));
$table = array_fill(0,71, array_fill(0,71, '.'));
$limit = 1024;
$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    if($safeReport < $limit){
        $line = str_replace("\n", "", $line);
        [$x, $y] = explode(',', $line);
        $table[$y][$x] = '#';
        $safeReport++;
    }
}

foreach ($table as $keyAbcisse => $valueAbcisse) {
    foreach ($valueAbcisse as $keyOrdonne => $valueOrdonne) {
        echo($valueOrdonne);
    }
    echo("<br>");
}*/

echo("<pre>");

/*** Chargement de la grille ***/
$filename = './input';

// Tableau 71x71 initialisé à '.'
$size = 71;
$table = array_fill(0, $size, array_fill(0, $size, '.'));

// Lecture des obstacles depuis le fichier
$limit = 2915;
$file = fopen($filename, 'r');
$safeReport = 0;
$lastLine = "";

while ($line = fgets($file)) {
    if ($safeReport < $limit) {
        $lastLine = $line;
        $line = str_replace("\n", "", $line);
        [$x, $y] = explode(',', $line);
        $x = (int)$x;
        $y = (int)$y;

        if ($x >= 0 && $x < $size && $y >= 0 && $y < $size) {
            $table[$y][$x] = '#';
        }
        $safeReport++;
    }
}

fclose($file);

/*** Paramètres A* ***/
$start = [0, 0];           // [x, y]
$goal  = [70, 70];         // [x, y]

/*** Fonctions utilitaires ***/

// Heuristique de Manhattan
function heuristic(int $x1, int $y1, int $x2, int $y2): int {
    return abs($x1 - $x2) + abs($y1 - $y2);
}

// Reconstruit le chemin à partir du tableau des nœuds
function reconstruct_path(array $nodes, string $currentKey): array {
    $path = [];
    while ($currentKey !== null && isset($nodes[$currentKey])) {
        $node = $nodes[$currentKey];
        $path[] = [$node['x'], $node['y']];
        $currentKey = $node['parent'];
    }
    return array_reverse($path);
}

// Algorithme A*
function aStar(array $grid, array $start, array $goal): ?array {
    $maxY = count($grid);
    $maxX = count($grid[0]);

    [$startX, $startY] = $start;
    [$goalX, $goalY]   = $goal;

    // Si départ ou arrivée bloqués
    if ($grid[$startY][$startX] === '#' || $grid[$goalY][$goalX] === '#') {
        return null;
    }

    $startKey = "$startX,$startY";

    // Ensemble ouvert (cases à explorer)
    $open = [];
    // Ensemble fermé (cases déjà traitées)
    $closed = [];
    // Tous les nœuds rencontrés pour reconstruire le chemin
    $nodes = [];

    $h = heuristic($startX, $startY, $goalX, $goalY);

    $startNode = [
        'x'      => $startX,
        'y'      => $startY,
        'g'      => 0,        // coût depuis le départ
        'h'      => $h,       // heuristique
        'f'      => $h,       // f = g + h
        'parent' => null,
    ];

    $open[$startKey]  = $startNode;
    $nodes[$startKey] = $startNode;

    // Directions (4-neighbors : haut, bas, gauche, droite)
    $directions = [
        [ 1,  0],
        [-1,  0],
        [ 0,  1],
        [ 0, -1],
    ];

    // Boucle principale
    while (!empty($open)) {
        // Récupérer le nœud avec le plus petit f dans open
        $currentKey = null;
        $currentNode = null;

        foreach ($open as $key => $node) {
            if ($currentNode === null || $node['f'] < $currentNode['f']) {
                $currentNode = $node;
                $currentKey  = $key;
            }
        }

        // Si on a atteint la cible -> reconstruire le chemin
        if ($currentNode['x'] === $goalX && $currentNode['y'] === $goalY) {
            return reconstruct_path($nodes, $currentKey);
        }

        // Déplacer le nœud courant de open vers closed
        unset($open[$currentKey]);
        $closed[$currentKey] = true;

        // Parcourir les voisins
        foreach ($directions as [$dx, $dy]) {
            $nx = $currentNode['x'] + $dx;
            $ny = $currentNode['y'] + $dy;

            // Hors de la grille
            if ($nx < 0 || $nx >= $maxX || $ny < 0 || $ny >= $maxY) {
                continue;
            }

            // Obstacle
            if ($grid[$ny][$nx] === '#') {
                continue;
            }

            $neighborKey = "$nx,$ny";

            // Déjà traité
            if (isset($closed[$neighborKey])) {
                continue;
            }

            // Coût depuis le départ jusqu'au voisin
            $tentativeG = $currentNode['g'] + 1; // poids uniforme de 1

            // Nouveau nœud ou meilleur chemin trouvé
            if (!isset($open[$neighborKey]) || $tentativeG < $open[$neighborKey]['g']) {
                $h = heuristic($nx, $ny, $goalX, $goalY);
                $f = $tentativeG + $h;

                $neighborNode = [
                    'x'      => $nx,
                    'y'      => $ny,
                    'g'      => $tentativeG,
                    'h'      => $h,
                    'f'      => $f,
                    'parent' => $currentKey,
                ];

                $open[$neighborKey]  = $neighborNode;
                $nodes[$neighborKey] = $neighborNode;
            }
        }
    }

    // Aucun chemin trouvé
    return null;
}

/*** Exécution de A* ***/
$path = aStar($table, $start, $goal);
$pathCount = 0;
if ($path === null) {
    echo "Aucun chemin trouvé entre (0,0) et (70,70)\n\n";
} else {
    // Marquer le chemin sur la grille
    foreach ($path as [$x, $y]) {
        // ne pas écraser départ/arrivée pour les marquer après
        $table[$y][$x] = 'O';
        $pathCount++;
    }

    // Marquer départ et arrivée
    [$sx, $sy] = $start;
    [$gx, $gy] = $goal;
    $table[$sy][$sx] = 'S';
    $table[$gy][$gx] = 'E';
}

/*** Affichage de la grille ***/
foreach ($table as $y => $row) {
    foreach ($row as $x => $cell) {
        echo $cell;
    }
    echo "<br>";
}

var_dump($pathCount - 1);
var_dump($lastLine);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$file = fopen($filename, 'r');
$safeReport = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);



}

fclose($file);

var_dump("---- Partie 2 ----");