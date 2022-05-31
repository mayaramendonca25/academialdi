<?php
function incluirAula($cod_aula, $aula, $dia_aula, $horario, $preco){ // função para incluir dados na tabela de aula
    $c = conectarBancoAcademia(); 
    if (is_numeric($cod_aula) && is_string($aula) && is_string($dia_aula) && validarHorario($horario) && is_numeric($preco)){ 

        $result = mysqli_query($c, "INSERT INTO aula (cod_aula, aula, dia_aula, horario, preco) 
        VALUES ('$cod_aula', '$aula', '$dia_aula', '$horario', '$preco');"); 
        

        if ($result){ 
            echo "<br>" . "Registro inserido com sucesso" . "<br>";
            return true;
        }
        else{
            $msg = mysqli_error($c); 
            echo "<br>" . "Registro não foi inserido" . $msg . "<br>";
            return true;
        }
    }
}

function consultarListaAula(){ // função para consultar todos os registros da tebela aula
    $c = conectarBancoAcademia();

    $consulta = mysqli_query($c, "SELECT * FROM aula"); 
    return $consulta; 
    
}

function consultarChaveAula($cod_aula){ // função para consultar dados de um registro pela pela sua chave primaria da tabela aula
    $c = conectarBancoAcademia();

    if (is_numeric($cod_aula)){ 
        $sql = "SELECT * FROM aula WHERE cod_aula = '$cod_aula';"; 
        $result = mysqli_query($c, $sql); 
        return $result;
    }
    else{
        return false;
    }
}

function alterarAula($cod_aula, $aula, $dia_aula, $horario, $preco){ // função para alterar dados de um registro na tabela de aula pela sua chave primaria
    $c = conectarBancoAcademia();

    if (is_numeric($cod_aula) && is_string($aula) && is_string($dia_aula) && validarHorario($horario) && is_numeric($preco)){
        

        $sql = "UPDATE aula SET aula = '$aula', dia_aula='$dia_aula', horario='$horario', preco='$preco' WHERE cod_aula = '$cod_aula';"; 

        $result = mysqli_query($c, $sql); 
        if (mysqli_affected_rows($c) == 0){ 
            echo "Alteração não foi realizada" . "<br>";
            return false;
        }
        else{ 
            echo "Alteração foi realizada" . "<br>";

            return true;
        }
    }
    else{ 
        echo "Parametros invalidos" . "<br>";
        return false;
    }
}

function consultarDiaAula($dia_aula){ // função para conlsutar uma aula pelo seu dia
    $c = conectarBancoAcademia();

    if (is_string($dia_aula))
    { 
        $sql = "SELECT * FROM aula WHERE dia_aula = '$dia_aula';"; 
        $result = mysqli_query($c, $sql);
        return $result;
    }
    else
    {
        return false;
    }
}

function excluirAula($cod_aula){ // função excluir o registro de uma aula pela sua chave primaria
    $c = conectarBancoAcademia();
    if (is_numeric($cod_aula)){ 
        $sql = "DELETE  FROM aula WHERE cod_aula = '$cod_aula';"; 
        $result = mysqli_query($c, $sql); 
        

        if (mysqli_affected_rows($c) == 0){ 
            echo "Exclusão não foi realizada" . "<br>";
            return false;
        }
        else{ 
            echo "Exclusão foi realizada" . "<br>";

            return true;
        }
    }
    else{ 
        return false;
        echo "Parametros invalidos" . "<br>";
    }
}

?>