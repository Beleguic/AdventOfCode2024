<?php

/*** Part 1 ***/
echo("<pre>");

$filename = './input';

$file = fopen($filename, 'r');
$groups = [];
$groupNumber = 0;
$group[$groupNumber] = [];

$allQuestionYes = 0;

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    if(strlen($line) == 0){

        $groupNumber++;
        $groups[$groupNumber] = [];

    }
    else{

        $peopleAnswer = str_split($line);
        $groups[$groupNumber][] = $peopleAnswer;

    }
}

fclose($file);

foreach ($groups as $key => $peopleQuestion) {
    $questionAnswer = [];
    foreach ($peopleQuestion as $question) {
        foreach ($question as $value) {
            if(!isset($questionAnswer[$value])){
                $questionAnswer[$value] = 1;
            }
        }
    }
    $allQuestionYes += sizeof($questionAnswer);
}


var_dump("---- Partie 1 ----");
var_dump($allQuestionYes);

/*** Part 2 ***/

$file = fopen($filename, 'r');
$groups = [];
$groupNumber = 0;
$group[$groupNumber] = [];

$allQuestionYes = 0;

while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);

    if(strlen($line) == 0){

        $groupNumber++;
        $groups[$groupNumber] = [];

    }
    else{

        $peopleAnswer = str_split($line);
        $groups[$groupNumber][] = $peopleAnswer;

    }
}

fclose($file);

foreach ($groups as $key => $peopleQuestion) {
    $questionAnswer = [];
    $numberPeopleInGroup = sizeof($peopleQuestion);
    foreach ($peopleQuestion as $question) {
        foreach ($question as $value) {
            if(!isset($questionAnswer[$value])){
                $questionAnswer[$value] = 0;
            }
            $questionAnswer[$value]++;
        }
    }
    $numberQuestionEveryoneYes = 0;
    foreach ($questionAnswer as $key => $value) {
        if($value == $numberPeopleInGroup){
            $numberQuestionEveryoneYes++;
        }
    }
    $allQuestionYes += $numberQuestionEveryoneYes;
}

var_dump("---- Partie 2 ----");
var_dump($allQuestionYes);
exit;