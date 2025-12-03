<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$bags = [];
$shinyBagContain = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    [$sourceBag, $otherData] = explode(' bags contain ', $line);
    $otherBags = explode(',', $otherData);
    foreach ($otherBags as $key => $value) {
        $value = trim($value);
        $valueExploded = explode(' ', $value);
        array_shift($valueExploded);
        array_pop($valueExploded);
        $otherBags[$key] = implode(' ', $valueExploded);
    }
    if($otherBags[0] == 'other'){
        $otherBags = [];
    }
    $bags[$sourceBag] = ['source' => $sourceBag, "children" => $otherBags];
    if(in_array("shiny gold", $otherBags)){
        $shinyBagContain[] = $sourceBag;
    }
}

fclose($file);

for ($i=0; $i < 100; $i++) { 

    foreach ($shinyBagContain as $shinyBagContainKey => $shinyBagContainValue) {
        foreach ($bags as $key => $value) {
            if(in_array($shinyBagContainValue, $value['children'])){
                $shinyBagContain[] = $value['source'];
            }
        }
    }

    $shinyBagContain = array_flip(array_flip($shinyBagContain));

}

var_dump("---- Partie 1 ----");
var_dump(sizeof($shinyBagContain));
/*** Part 2 ***/

$file = fopen($filename, 'r');
$bags = [];
$shinyBagContain = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    [$sourceBag, $otherData] = explode(' bags contain ', $line);
    $otherBags = explode(',', $otherData);
    $rawOtherBags = explode(',', $otherData);
    $otherBags = [];

    foreach ($rawOtherBags as $value) {
        $value = trim($value);

        // handle the "other" / "no other bags" case early
        if ($value === 'other' || $value === 'no other bags') {
            $otherBags = [];
            break;
        }

        $valueExploded = explode(' ', $value);
        array_pop($valueExploded);        // remove "bag"/"bags"
        
        $number = array_shift($valueExploded);  // first word is the number
        $name   = implode(' ', $valueExploded); // rest is the bag name

        // now push an associative array instead of modifying a string
        $otherBags[] = [
            'number' => (int) $number,
            'name'   => $name,
        ];
    }

    $bags[$sourceBag] = [
        'source'   => $sourceBag,
        'children' => $otherBags,
    ];
}

function countBag($name, $bags){

    
    if(!isset($bags[$name])){
        return 0;
    }
    $bagsChoose = $bags[$name];
    //var_dump($bagsChoose);

    $counter = 0;

    foreach ($bagsChoose['children'] as $key => $value) {
        $counter += $value['number'];
    }
    foreach ($bagsChoose['children'] as $key => $value) {
        $counter += ($value['number'] * countBag($value['name'], $bags));
    }
    return $counter;

}

$totalShinyGoldBag = countBag('shiny gold', $bags);


fclose($file);

var_dump("---- Partie 2 ----");
var_dump($totalShinyGoldBag);