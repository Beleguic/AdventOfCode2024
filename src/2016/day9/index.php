<?php

ini_set('memory_limit', '-1');

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$length = 0;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    $lineSplit = str_split($line);

    $record = false;
    $marker = "";

    $caracToSkip = 0;

    foreach ($lineSplit as $key => $value) {
        if($value == '(' && $caracToSkip == 0){
            $record = true;
        }

        if($record && $caracToSkip == 0){
            $marker .= $value;
        }
        else{
            if($caracToSkip > 0){
                $caracToSkip--;
            }
            else{
                $length++;
            }
        }

        if($value == ')' && $caracToSkip == 0){
            $record = false;

            $marker = str_replace('(', '', $marker);
            $marker = str_replace(')', '', $marker);

            [$number, $occurance] = explode('x', $marker);

            $length += $number * $occurance;
            $caracToSkip = $number;

            $marker = "";

        }
    }

    var_dump($length);
}

fclose($file);

var_dump("---- Partie 1 ----");

/*** Part 2 ***/

$file   = fopen($filename, 'r');
$total  = 0;

while (($line = fgets($file)) !== false) {
    $line = trim($line);
    if ($line === '') {
        continue;
    }

    $total += decompressed_length($line);
}

fclose($file);

echo "Longueur décompressée : ", $total, PHP_EOL;

var_dump("---- Partie 2 ----");



function decompressed_length(string $s): int
{
    $len = 0;
    $i   = 0;
    $n   = strlen($s);

    while ($i < $n) {
        $ch = $s[$i];

        // Ignorer les fins de ligne
        if ($ch === "\n" || $ch === "\r") {
            $i++;
            continue;
        }

        // Si ce n'est pas un marqueur, c'est un simple caractère
        if ($ch !== '(') {
            $len++;
            $i++;
            continue;
        }

        // On est sur un marqueur "(AxB)"
        $i++; // sauter '('
        $marker = '';

        // Lire jusqu'à ')'
        while ($i < $n && $s[$i] !== ')') {
            $marker .= $s[$i];
            $i++;
        }

        // Sauter ')'
        if ($i < $n && $s[$i] === ')') {
            $i++;
        }

        // Parse "AxB"
        [$number, $repeat] = array_map('intval', explode('x', $marker));

        // Sous-chaîne concernée par le marqueur
        $segment = substr($s, $i, $number);

        // Partie importante :
        // - si tu veux la version "partie 1", mets simplement:
        //   $len += $number * $repeat;
        // - pour la "partie 2" (imbriqué), on recalcule récursivement :
        $len += decompressed_length($segment) * $repeat;

        // Avancer après la zone compressée
        $i += $number;
    }

    return $len;
}
