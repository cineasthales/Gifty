<?php

$num = count($eventos);
$vazio = false;
if ($num == 1 && $eventos[0]->data == "") {
    $vazio = true;
    echo "null;null;null;0";
}
if (!$vazio) {
    for ($i = 0; $i < $num; ++$i) {
        echo $eventos[$i]->data . ";" . $eventos[$i]->hora . ";" . $eventos[$i]->titulo . ";" . 
                $eventos[$i]->numConvites;
        if ($i < $num - 1) {
            echo ";|;";
        }
    }
}