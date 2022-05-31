<?php

function validarHorario($hora, $formato = 'H:i'){ // função para validar a hora
    $d = Datetime:: createFromFormat($formato, $hora);
    return $d && $d-> format($formato) == $hora;
}

?>