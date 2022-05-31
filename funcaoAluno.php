<?php

function incluirAluno($nome, $cpf, $endereco, $telefone, $data_nascimento){ // função de incluir para incluir registros na tabela aluno
    $c = conectarBancoAcademia(); 
    if (is_string($nome) && is_numeric($cpf) && is_string($endereco) && is_numeric($telefone) && validar_data($data_nascimento)){
        $data_nascimento = formatardataBancoEnvio($data_nascimento); 

        $result = mysqli_query($c, "INSERT INTO aluno(nome, cpf, endereco, telefone, data_nascimento) 
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

function consultarListaAluno(){ // função para consultar todos os dados da tabela Aluno
    $c = conectarBancoAcademia();

    $consulta = mysqli_query($c, "SELECT * FROM aluno"); 
    return $consulta;
    
}

function consultarChaveAluno($cpf){ // função para consultar pela dados da tabela aluno mediante a sua chave primária
    $c = conectarBancoAcademia();

    if (is_numeric($cpf)){ 
        $sql = "SELECT * FROM aluno WHERE cpf = '$cpf';";
        $result = mysqli_query($c, $sql); 
        return $result;
    }
    else{
        return false;
    }
}

function alterarAluno($nome, $cpf, $endereco, $telefone, $data_nascimento){ // função para alterar dados de um registro pela sua chave primaria
    if (is_string($nome) && is_numeric($cpf) && is_string($endereco) && is_numeric($telefone) && is_string($data_nascimento)){ 

        $c = conectarBancoAcademia();
        $data_nascimento = formatardataBancoEnvio($data_nascimento); 
        $sql = "UPDATE aluno SET nome = '$nome', endereco='$endereco', telefone='$telefone', data_nascimento='$data_nascimento' WHERE cpf = '$cpf';";
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

function consultarNome($nome){ // função para consultar dados pelo nome 
    $c = conectarBancoAcademia();

    if (is_string($nome)){ 
        $sql = "SELECT * FROM aluno WHERE nome = '$nome';"; 
        $result = mysqli_query($c, $sql); 
        return $result;

    }
    else{
        return false;
    }
}

function excluirAluno($cpf){ // função para excluir os registros de um aluno pela sua chave primaria
    $c = conectarBancoAcademia();
    if (is_numeric($cpf)){ 
        $sql = "DELETE  FROM aluno WHERE cpf = '$cpf';"; 
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