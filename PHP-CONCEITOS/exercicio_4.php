<?php

define("CURRENT_YEAR", date("Y"));

echo "Digite o ano do seu nascimento: ";
while (true) {
    $input = (int) trim(fgets(STDIN));

    if (strlen($input) === 4 && CURRENT_YEAR > $input) {
        echo "Neste ano você atinge a idade de: " . (CURRENT_YEAR - $input) . PHP_EOL;
        break;
    } else {
        echo "Valor inválido. Tente novamente: ";
    }
}