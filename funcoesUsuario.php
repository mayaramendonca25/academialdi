<?php
function incluirUsuario($login, $senha, $nome, $perfil){ // função para incluir registros a tabela usuario
    $c = conectarBancoAcademia();

    if (is_numeric($login) && is_numeric($senha) && is_string($nome) && is_numeric($perfil)){ 
        $result = mysqli_query($c, "INSERT INTO usuario(login, senha, nome, perfil)
        VALUES ('$login', '$senha', '$nome', '$perfil');"); 
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

function consultarListUsuario(){ // função para consultar todos os registros da tabela usuario
    $c = conectarBancoAcademia();

    $consulta = mysqli_query($c, "SELECT * FROM usuario"); 
    return $consulta;
}

function consultarChaveUsuario($login){ // função para consultar os dados de de um registros pela sua chave primaria
    $c = conectarBancoAcademia();

    if (is_numeric($login)){ 
        $sql = "SELECT * FROM usuario WHERE login = '$login';"; 
        $result = mysqli_query($c, $sql); 
        return $result;
    }
    else{
        return false;
    }
}

function alterarUsuario($login, $senha, $nome, $perfil){ // função para alterar dados de um registro pela sua chave primaria
    if (is_numeric($login) && is_numeric($senha) && is_string($nome) && is_numeric($perfil)){ 
        $c = conectarBancoAcademia();

        $sql = "UPDATE usuario SET senha= '$senha', nome='$nome', perfil='$perfil' WHERE login = '$login';"; 
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

function consultarSenha($senha){ // função para consultar os dados de um registro pela sua senha
    $c = conectarBancoAcademia();

    if (is_numeric($senha)){ 
        $sql = "SELECT * FROM usuario WHERE senha = '$senha';"; 
        $result = mysqli_query($c, $sql);
        return $result;
    }
    else{
        return false;
    }
}

function logarUsuario($login, $senha){ // função para logar um usuario
    if (is_numeric($login) && is_numeric($senha)){ 
        $c = conectarBancoAcademia();

        $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha';"; 
        
        $result = mysqli_query($c, $sql); 
        if (mysqli_num_rows($result) == 0){ 
            return false;
        }
        else{ 
            return true;
        }

    }
    else{ 
        echo "\n" . "Parametros informados invalidos";
        return false;
    }
}

?>
