<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>2025 - Day 4 Visualisation</title>
</head>
<body>

<?php

/*** Part 1 ***/

$filename = './input';

$file = fopen($filename, 'r');
$map = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $map[] = str_split($line);
}
fclose($file);

// X = Ligne
// Y = colonne

$rollsPaperAccesibleWithForkLiftPT1 = 0;

foreach ($map as $ligneKey => $ligne) {
    foreach ($ligne as $columnKey => $column) {
        $rollPaper = 0;
        if($column == "@"){
            if(isset($ligne[$columnKey + 1]) && $ligne[$columnKey + 1] == "@"){
                $rollPaper++;
            }
            if(isset($ligne[$columnKey - 1]) && $ligne[$columnKey - 1] == "@"){
                $rollPaper++;
            }
            if(isset($map[$ligneKey - 1][$columnKey]) && $map[$ligneKey - 1][$columnKey] == "@"){
                $rollPaper++;
            }
            if(isset($map[$ligneKey + 1][$columnKey]) && $map[$ligneKey + 1][$columnKey] == "@"){
                $rollPaper++;
            }
            if(isset($map[$ligneKey - 1][$columnKey - 1]) && $map[$ligneKey - 1][$columnKey - 1] == "@"){
                $rollPaper++;
            }
            if(isset($map[$ligneKey - 1][$columnKey + 1]) && $map[$ligneKey - 1][$columnKey + 1] == "@"){
                $rollPaper++;
            }
            if(isset($map[$ligneKey + 1][$columnKey - 1]) && $map[$ligneKey + 1][$columnKey - 1] == "@"){
                $rollPaper++;
            }
            if(isset($map[$ligneKey + 1][$columnKey + 1]) && $map[$ligneKey + 1][$columnKey + 1] == "@"){
                $rollPaper++;
            }

            if($rollPaper < 4){
                $rollsPaperAccesibleWithForkLiftPT1++;
            }
        }
    }
}

//var_dump("---- Partie 1 ----");
//var_dump($rollsPaperAccesibleWithForkLift);
/*** Part 2 ***/

$file = fopen($filename, 'r');
$map = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $map[] = str_split($line);
}
fclose($file);

// X = Ligne
// Y = colonne

$rollsPaperAccesibleWithForkLift = 0;
$isRollPaperRemoved = true;

$indexRemoveOrder = 0;
$rollRemoveOrder = [];

while($isRollPaperRemoved){
    $rollsPaperRemoveOnOneTime = 0;
    foreach ($map as $ligneKey => $ligne) {
        foreach ($ligne as $columnKey => $column) {
            $rollPaper = 0;
            if($column == "@"){
                if(isset($ligne[$columnKey + 1]) && $ligne[$columnKey + 1] == "@"){
                    $rollPaper++;
                }
                if(isset($ligne[$columnKey - 1]) && $ligne[$columnKey - 1] == "@"){
                    $rollPaper++;
                }
                if(isset($map[$ligneKey - 1][$columnKey]) && $map[$ligneKey - 1][$columnKey] == "@"){
                    $rollPaper++;
                }
                if(isset($map[$ligneKey + 1][$columnKey]) && $map[$ligneKey + 1][$columnKey] == "@"){
                    $rollPaper++;
                }
                if(isset($map[$ligneKey - 1][$columnKey - 1]) && $map[$ligneKey - 1][$columnKey - 1] == "@"){
                    $rollPaper++;
                }
                if(isset($map[$ligneKey - 1][$columnKey + 1]) && $map[$ligneKey - 1][$columnKey + 1] == "@"){
                    $rollPaper++;
                }
                if(isset($map[$ligneKey + 1][$columnKey - 1]) && $map[$ligneKey + 1][$columnKey - 1] == "@"){
                    $rollPaper++;
                }
                if(isset($map[$ligneKey + 1][$columnKey + 1]) && $map[$ligneKey + 1][$columnKey + 1] == "@"){
                    $rollPaper++;
                }

                if($rollPaper < 4){
                    $rollsPaperAccesibleWithForkLift++;
                    $rollsPaperRemoveOnOneTime++;
                    $map[$ligneKey][$columnKey] = "#";
                    $rollRemoveOrder[$indexRemoveOrder][] = ['X' => $ligneKey, 'Y' => $columnKey];
                }
            }
        }
    }

    if($rollsPaperRemoveOnOneTime == 0){
        $isRollPaperRemoved = false;
    }

    $indexRemoveOrder++;
}

//var_dump("---- Partie 2 ----");
//var_dump($rollsPaperAccesibleWithForkLift);

$rollRemoveOrderJsonEncoded = json_encode($rollRemoveOrder);

?>

<main><pre><?php
            $file = fopen($filename, 'r');
            $ligneKey = 0;
            while ($line = fgets($file)) {
                $line = str_replace("\n", "", $line);
                $line = str_split($line);
                foreach ($line as $key => $value) {
                    echo("<span id='".$ligneKey."-".$key."'>".$value."</span>");
                }
                echo("<br>");
                $ligneKey++;
            }
            fclose($file);
        ?></pre></main>
        <div>
            <h1>Partie 1 : <?= $rollsPaperAccesibleWithForkLiftPT1 ?></h1>
            <h1>Partie 2 : <?= $rollsPaperAccesibleWithForkLift ?>, Nombre d'itération : <?= sizeof($rollRemoveOrder) ?></h1>
        </div>

    <script>
        let datas = <?= $rollRemoveOrderJsonEncoded ?>

        datas.forEach((data, index) => {
            console.log(data);
            setTimeout(() => {
                data.forEach((data2, index2) => {
                    let span = document.getElementById(data2.X + '-' + data2.Y);
                    span.textContent = '.';
                });
            }, 300 * index);
        });
    </script>
    <style>
            
        span{
            font-size: 14px;
            line-height: 0px;
        }    

        body{

            display: flex;
            flex-direction: row;

        }



    </style>
</body>
</html>
