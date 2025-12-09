<?php

/*** Part 1 ***/
echo("<pre>");

$input = explode(',',"0,3,6");

$lastNumberSpockIndex = [];

$lastIndexSpoken = 0;
for ($i=0; $i < 2020; $i++) {
    if(isset($input[$i])){
        $lastIndexSpoken = $i;
        $lastNumberSpockIndex[$input[$i]][0] = $i;
    }
    else{
        if(isset($lastNumberSpockIndex[$input[$i - 1]]) && sizeof($lastNumberSpockIndex[$input[$i - 1]]) == 2){
            $input[$i] = $lastNumberSpockIndex[$input[$i - 1]][1] - $lastNumberSpockIndex[$input[$i - 1]][0];
            $lastNumberSpockIndex[$input[$i - 1]][0] = $lastNumberSpockIndex[$input[$i - 1]][1];
            $lastNumberSpockIndex[$input[$i - 1]][1] = $i;

            if($input[$i] != $input[$i - 1]){
                if(isset($lastNumberSpockIndex[$input[$i]][1])){
                    $lastNumberSpockIndex[$input[$i]][0] = $lastNumberSpockIndex[$input[$i]][1];
                    $lastNumberSpockIndex[$input[$i]][1] = $i;
                }
                else{
                    $lastNumberSpockIndex[$input[$i]][1] = $i;
                }
            }
            
        }
        elseif(isset($lastNumberSpockIndex[$input[$i - 1]]) && sizeof($lastNumberSpockIndex[$input[$i - 1]]) == 1){
            $input[$i] = 0;
            $lastNumberSpockIndex[$input[$i]][1] = $i;
        }
        else{
            $input[$i] = 0;
            $lastNumberSpockIndex[$input[$i]][0] = $i;
        }
    }
}

var_dump($input);
