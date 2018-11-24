<?php

$num = count($convites);
$vazio = false;
if ($num == 0) {
    $vazio = true;
    echo "null;null;null;null;0";
}
if (!$vazio) {
    for ($i = 0; $i < $num; ++$i) {
        echo $convites[$i]->data . ";" . $convites[$i]->hora . ";" . $convites[$i]->titulo . ";" . 
                $convites[$i]->dataLimite . ";" . $convites[$i]->comparecera;
        if ($i < $num - 1) {
            echo ";|;";
        }
    }
}