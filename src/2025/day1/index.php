<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jour 1 - AdventOfCode</title>
    <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: #0f172a;
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
      color: #e5e7eb;
    }

    .dial-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .dial {
      position: relative;
      width: 800px;
      height: 800px;
      border-radius: 50%;
      background: radial-gradient(circle at 30% 30%, #1f2937, #020617);
      box-shadow:
        0 0 40px rgba(15, 23, 42, 0.9),
        inset 0 0 40px rgba(15, 23, 42, 0.9);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Centre du cadran */
    .dial-center {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: radial-gradient(circle at 30% 30%, #111827, #020617);
      box-shadow:
        0 0 20px rgba(15, 23, 42, 0.8),
        inset 0 0 20px rgba(15, 23, 42, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: 600;
    }

    /* Conteneur de chaque nombre */
    .tick {
      position: absolute;
      top: 50%;
      left: 50%;
      transform-origin: center center;
      /* On ajustera la transform en JS */
    }

    /* Le texte du nombre lui-même */
    .tick-label {
      position: absolute;
      transform: translate(-50%, -50%);
      font-size: 0.7rem;
      letter-spacing: 0.03em;
      color: #9ca3af;
      transition: transform 0.2s ease, color 0.2s ease;
    }

    /* Style pour les "repères" multiples de 10 (0,10,20...) */
    .tick.major .tick-label {
      font-size: 0.9rem;
      color: #e5e7eb;
      font-weight: 600;
    }

    /* Style quand on survole un nombre */
    .tick-label:hover {
      transform: translate(-50%, -50%) scale(1.4);
      color: #38bdf8;
    }

    .dial-title {
      font-size: 1.1rem;
      color: #9ca3af;
    }

    .needle {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 4px;
      height: 320px;
      background: #f97316;
      border-radius: 999px;
      transform-origin: 50% 0%;
      transform: translate(-50%, 0) rotate(0deg);
      transition: transform 0.25s ease-out;
    }

    @media (max-width: 480px) {
      .dial {
        width: 280px;
        height: 280px;
      }

      .dial-center {
        width: 90px;
        height: 90px;
        font-size: 1.4rem;
      }
    }

    .dial-wrapper2 {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .dial2 {
      position: relative;
      width: 800px;
      height: 800px;
      border-radius: 50%;
      background: radial-gradient(circle at 30% 30%, #1f2937, #020617);
      box-shadow:
        0 0 40px rgba(15, 23, 42, 0.9),
        inset 0 0 40px rgba(15, 23, 42, 0.9);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Centre du cadran */
    .dial-center2 {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: radial-gradient(circle at 30% 30%, #111827, #020617);
      box-shadow:
        0 0 20px rgba(15, 23, 42, 0.8),
        inset 0 0 20px rgba(15, 23, 42, 0.8);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: 600;
    }

    /* Conteneur de chaque nombre */
    .tick2 {
      position: absolute;
      top: 50%;
      left: 50%;
      transform-origin: center center;
      /* On ajustera la transform en JS */
    }

    /* Le texte du nombre lui-même */
    .tick-label2 {
      position: absolute;
      transform: translate(-50%, -50%);
      font-size: 0.7rem;
      letter-spacing: 0.03em;
      color: #9ca3af;
      transition: transform 0.2s ease, color 0.2s ease;
    }

    /* Style pour les "repères" multiples de 10 (0,10,20...) */
    .tick.major2 .tick-label2 {
      font-size: 0.9rem;
      color: #e5e7eb;
      font-weight: 600;
    }

    /* Style quand on survole un nombre */
    .tick-label2:hover {
      transform: translate(-50%, -50%) scale(1.4);
      color: #38bdf8;
    }

    .dial-title2 {
      font-size: 1.1rem;
      color: #9ca3af;
    }

    .needle2 {
      position: absolute;
      top: 50%;
      left: 50%;
      width: 4px;
      height: 320px;
      background: #f97316;
      border-radius: 999px;
      transform-origin: 50% 0%;
      transform: translate(-50%, 0) rotate(0deg);
    }

    @media (max-width: 480px) {
      .dial2 {
        width: 280px;
        height: 280px;
      }

      .dial-center2 {
        width: 90px;
        height: 90px;
        font-size: 1.4rem;
      }
    }
  </style>
</head>
<body>

<?php

/*** Part 1 ***/

$filename = './input';

$positionAfterTour = [];

$file = fopen($filename, 'r');
$numberOfZero = 0;
$pointeur = 50;
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $sens = substr($line, 0,1);
    $incrementation = substr($line, 1);

    if($sens == 'L'){
        // -
        for ($i=0; $i < $incrementation; $i++) { 
            $pointeur--;
            if($pointeur == -1){
                $pointeur = 99;
            }
        }
    }
    else{
        // +
        for ($i=0; $i < $incrementation; $i++) { 
            $pointeur++;
            if($pointeur == 100){
                $pointeur = 0;
            }
        }
    }

    if($pointeur == 0){
        $numberOfZero++;
    }

    $positionAfterTour[] = $pointeur;

}

fclose($file);

$json = json_encode($positionAfterTour);

//var_dump("---- Partie 1 ----");
//var_dump($numberOfZero);

?>
<div style="width: 50%;">
    <div class="dial-wrapper">
        <div class="dial-title">Partie 1 | Nombre d'arret sur 0 : <span id="zero">0</span></div>

        <div class="dial" id="dial">
            <div class="needle" id="needle"></div>
            <!-- Les nombres seront ajoutés en JavaScript -->
            <div class="dial-center" id="dial-value">0</div>
        </div>
    </div>

    <script>
        const dial = document.getElementById("dial");
        const centerValue = document.getElementById("dial-value");

        const totalNumbers = 100; // 0 à 99 -> 100 valeurs
        const radius = 380; // rayon en px (distance du centre aux nombres)

        for (let i = 0; i < totalNumbers; i++) {
          const angle = (360 / totalNumbers) * i - 90; // 3.6° par nombre

          const tick = document.createElement("div");
          tick.classList.add("tick");

          // Classe spéciale pour les multiples de 10
          if (i % 10 === 0) {
            tick.classList.add("major");
          }

          const label = document.createElement("div");
          label.classList.add("tick-label");
          label.textContent = i;

          // Calcul de la position en utilisant transform
          // 1) on place le centre du tick au centre du cadran
          // 2) on fait rotate(angle) puis translate(radius)
          // 3) on "déretrécit" le texte pour le remettre droit avec rotate(-angle)
          tick.style.transform =
            `translate(-50%, -50%) rotate(${angle}deg) translate(${radius}px)`;

          label.style.transform =
            `translate(-50%, -50%) rotate(${-angle}deg)`;

          // Quand on clique sur un nombre, on l'affiche au centre
          label.addEventListener("click", () => {
            centerValue.textContent = i;
          });

          tick.appendChild(label);
          dial.appendChild(tick);
        }

        function setValue(n) {
          let value = Number(n);
          if (Number.isNaN(value)) return;
          if (value < 0) value = 0;
          if (value > 99) value = 99;

          centerValue.textContent = value;

          const angle = (360 / totalNumbers) * value - 180;
          needle.style.transform = `translate(-50%, 0) rotate(${angle}deg)`;
        }

        setValue(50);

        let jsonData = <?php echo $json ?>

        jsonData.forEach((user, index) => {
            setTimeout(() => {
               setValue(user);
               if(user == 0){
                    document.getElementById('zero').textContent++;
               }
            }, 250 * index);
        });
    </script>
</div>


<?php
/*** Part 2 ***/

$file = fopen($filename, 'r');
$numberOfZero = 0;
$pointeur = 50;
$positionEachClick = [];
while ($line = fgets($file)) {
    $line = str_replace("\n", "", $line);
    $sens = substr($line, 0,1);
    $incrementation = substr($line, 1);

    if($sens == 'L'){
        // -
        for ($i=0; $i < $incrementation; $i++) { 
            $pointeur--;
            if($pointeur == -1){
                $pointeur = 99;
            }

            $positionEachClick[] = $pointeur;

            if($pointeur == 0){
                $numberOfZero++;
            }
        }
    }
    else{
        // +
        for ($i=0; $i < $incrementation; $i++) { 
            $pointeur++;
            if($pointeur == 100){
                $pointeur = 0;
            }

            $positionEachClick[] = $pointeur;

            if($pointeur == 0){
                $numberOfZero++;
            }
        }
    }

}

fclose($file);

$json2 = json_encode($positionEachClick);

//var_dump("---- Partie 2 ----");
//var_dump($numberOfZero);


?>

<div style="width: 50%;">
    <div class="dial-wrapper2">
        <div class="dial-title2">Partie 2 | Nombre de passage sur 0 : <span id="zero2">0</span></div>

        <div class="dial2" id="dial2">
            <div class="needle2" id="needle2"></div>
            <!-- Les nombres seront ajoutés en JavaScript -->
            <div class="dial-center2" id="dial-value2">0</div>
        </div>
    </div>

    <script>
        const dial2 = document.getElementById("dial2");
        const centerValue2 = document.getElementById("dial-value2");

        const totalNumbers2 = 100; // 0 à 99 -> 100 valeurs
        const radius2 = 380; // rayon en px (distance du centre aux nombres)

        for (let i = 0; i < totalNumbers2; i++) {
          const angle2 = (360 / totalNumbers2) * i - 90; // 3.6° par nombre

          const tick2 = document.createElement("div");
          tick2.classList.add("tick");

          // Classe spéciale pour les multiples de 10
          if (i % 10 === 0) {
            tick2.classList.add("major2");
          }

          const label2 = document.createElement("div");
          label2.classList.add("tick-label2");
          label2.textContent = i;

          // Calcul de la position en utilisant transform
          // 1) on place le centre du tick au centre du cadran
          // 2) on fait rotate(angle) puis translate(radius)
          // 3) on "déretrécit" le texte pour le remettre droit avec rotate(-angle)
          tick2.style.transform =
            `translate(-50%, -50%) rotate(${angle2}deg) translate(${radius2}px)`;

          label2.style.transform =
            `translate(-50%, -50%) rotate(${-angle2}deg)`;

          // Quand on clique sur un nombre, on l'affiche au centre
          label2.addEventListener("click", () => {
            centerValue2.textContent = i;
          });

          tick2.appendChild(label2);
          dial2.appendChild(tick2);
        }

        function setValue2(n) {
          let value2 = Number(n);
          if (Number.isNaN(value2)) return;
          if (value2 < 0) value2 = 0;
          if (value2 > 99) value2 = 99;

          centerValue2.textContent = value2;

          const angle2 = (360 / totalNumbers2) * value2 - 180;
          needle2.style.transform = `translate(-50%, 0) rotate(${angle2}deg)`;
        }

        setValue2(50);

        let jsonData2 = <?php echo $json2 ?>

        jsonData2.forEach((user, index) => {
            setTimeout(() => {
               setValue2(user);
               if(user == 0){
                    document.getElementById('zero2').textContent++;
               }
            }, 10 * index);
        });
    </script>
</div>

</body>
</html>