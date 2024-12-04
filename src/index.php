<!DOCTYPE html>
<html>
<head>
    <title>Advent of Code 2024</title>
</head>
<body>
<div style='width: 100%'>
    <h1 style='text-align: center;'> Advent of Code 2024 </h1>
    <div id='linkContainer'>
    <?php

        $files = scandir('./');

        $fileList = [];

        foreach($files as $key => $value) {
            if($value != '.' && $value != '..' && is_dir('./'.$value)) {
                if(is_file('./'.$value.'/input')) {
                    $fileList[substr($value,3)] = ['dir' => $value, 'Completed' => true];
                }
                else {
                    $fileList[substr($value,3)] = ['dir' => $value, 'Completed' => false];
                } 
            }
        }

        ksort($fileList);

        foreach($fileList as $key => $value) {
            if($value['Completed']){
                echo("<a href='./".$value['dir']."' class='completed'>".$value['dir']."</a><br>");
            }
            else{
                echo("<a href='./".$value['dir']."'>".$value['dir']."</a><br>");
            }
        }

    ?>
    </div>
</div>

<style>
    body {
        background-color: white;
        min-height: 100vh;
        margin: auto;
        align-items: center;
        display: flex;

    }

    h1{
        color: black; 
        text-align: center;
    }

    div#linkContainer{

        width: 80%;
        margin: auto; 
        display: flex; 
        flex-wrap: wrap; 
        justify-content: center;

    }

    a{
        padding: 15px; 
        border: 1px solid black; 
        border-radius: 15px; 
        margin: 15px; 
        color: black; 
        text-decoration: none;
        transition: all 0.25s;

    }

    a:hover{
        background-color: black;
        color: white;
    }

    a.completed{
        background-color: #2bbe00;
        color: white;
        font-weight: bold;
    }

    a.completed:hover{
        background-color: #32df00;
    }

</style>
</body>
</html>
