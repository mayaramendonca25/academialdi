<?php

function validar_data($data) {// função para validar a data 
    $v = explode("/", $data); 
    if (count($v) == 3) {
        $result = checkdate($v[1], $v[0], $v[2]); 
        return $result;
    }
}

function formatardataBancoEnvio($data){ // função para formatar a data
    $v = explode("/", $data); 
    $dataBanco = $v[2] . '-' . $v[1] . '-' . $v[0]; 
    return $dataBanco;
}

function formatardataTela($data){ // função para a data aparecer na tela
    $v = explode('-', $data); 
    $dataTela = $v[2] . '/' . $v[1] . '/' . $v[0]; 
    return $dataTela;
}
