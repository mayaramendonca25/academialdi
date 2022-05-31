<?php

function incluirPersonal($nome, $cpf, $endereco, $telefone, $data_nascimento){ // função para inlcuir dados a tabela personal
    $c = conectarBancoAcademia();

    if (is_string($nome) && is_numeric($cpf) && is_string($endereco) && is_numeric($telefone) && is_string($data_nascimento)){
        $data_nascimento = formatardataBancoEnvio($data_nascimento); 
        $result = mysqli_query($c, "INSERT INTO personal(nome, cpf, endereco, telefone, data_nascimento)
            VALUES ('$nome', '$cpf', '$endereco', '$telefone', '$data_nascimento');"); 

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

function consultarListaPersonal(){ // função para consultar todos os dados da tabela personal
    $c = conectarBancoAcademia();

    $consulta = mysqli_query($c, "SELECT * FROM personal"); 
    return $consulta;
}

function consultarChavePersonal($cpf){ 
    $c = conectarBancoAcademia();

    if (is_numeric($cpf)){ 
        $sql = "SELECT * FROM personal WHERE cpf = '$cpf';"; 
        $result = mysqli_query($c, $sql);
        return $result;
    }
    else{
        return false;
    }
}

function alterarPersonal($nome, $cpf, $endereco, $telefone, $data_nascimento){ // função apara alterar os dados de um registro na tabela personal
    if (is_string($nome) && is_numeric($cpf) && is_string($endereco) && is_numeric($telefone) && is_string($data_nascimento)){ 
        $c = conectarBancoAcademia();
        $data_nascimento = formatardataBancoEnvio($data_nascimento); 
        $sql = "UPDATE personal SET nome = '$nome', endereco='$endereco', telefone='$telefone', data_nascimento='$data_nascimento' WHERE cpf = '$cpf';";
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
        echo "Parametros invalidos";
        return false;
    }
}

function consultarTelefone($telefone){ // função para consultar os dados de um registro por seu telefone
    $c = conectarBancoAcademia();

    if (is_numeric($telefone)){ 
        $sql = "SELECT * FROM personal WHERE telefone = '$telefone';"; 
        $result = mysqli_query($c, $sql); 
        return $result;
    }
    else{
        return false;
    }
}

function excluirPersonal($cpf){ // função para excluir um registro por sua chave primaria
    $c = conectarBancoAcademia();
    if (is_numeric($cpf)){ 
        $sql = "DELETE  FROM personal WHERE cpf = '$cpf';"; 
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
