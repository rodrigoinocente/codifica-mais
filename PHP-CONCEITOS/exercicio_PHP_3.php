<?php

function quest()
{
    $count = 0;

    echo "Digite o primeiro número: ";
    $numberA = (int) trim(fgets(STDIN));

    echo "Digite o segundo número: ";
    $numberB = (int) trim(fgets(STDIN));

    if ($numberA >= $numberB) {
        echo "O primeiro número deve ser menor que o segundo" . PHP_EOL;
        echo "Tente Novamente" . PHP_EOL;
        return quest();
    }

    for ($numberA; $numberA <= $numberB; $numberA++) {
        if ($numberA % 2 != 0) {
            $count += $numberA;
        }
    }

    echo "Resultado da contagem dos números ímpares: $count" . PHP_EOL;
}

quest();


// Solução com while
// $count = 0;

// while (true) {
//     echo "Digite o primeiro número: ";
//     $numberA = (int) trim(fgets(STDIN));

//     echo "Digite o segundo número: ";
//     $numberB = (int) trim(fgets(STDIN));

//     if ($numberA < $numberB) {
//         break;
//     }
//     echo "O primeiro número deve ser menor que o segundo" . PHP_EOL;
//     echo "Tente Novamente" . PHP_EOL;

// }

// for ($numberA; $numberA <= $numberB; $numberA++) {
//     if ($numberA % 2 != 0) {
//         $count += $numberA;
//     }
// }

// echo "Resultado da contagem dos números ímpares: $count" . PHP_EOL;