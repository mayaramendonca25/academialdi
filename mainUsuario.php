<?php

include_once ('conectar.php');
include_once ('funcoesUsuario.php');

extract($_REQUEST, EXTR_SKIP);
#incluindo registros a tabela usuario
if (isset($acao)){ 
    if ($acao = "Logar"){ 
        if (isset($login) && isset($senha) && isset($nome) && isset($perfil)){
            $login = htmlspecialchars_decode(strip_tags($login)); 
            $senha = htmlspecialchars_decode(strip_tags($senha));
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $perfil = htmlspecialchars_decode(strip_tags($perfil));

            if (incluirUsuario($login, $senha, $nome, $perfil)){ 
                echo "Login concluido" . "<br>";
            }
        }
    }
    else{

        echo "Login não efetuado" . "<br>";
    }
}

#consultar tosos os registros da tabela
if (isset($acaoconsultar)){ 
    if ($acaoconsultar == "Consultar Login"){ 
        $testaConsulta = consultarListUsuario(); 
        $qtdLinhas = mysqli_num_rows($testaConsulta); 
        if ($qtdLinhas == 0){
            echo "Login não efetuado" . "<br>";
        }
        else{
            for ($i = 0;$i < $qtdLinhas;$i++){
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "Login: " . $linha['login'] . 
                "<br>" . "Senha: " . $linha['senha'] . 
                "<br>" . "Nome: " . $linha['nome'] . 
                "<br>" . "Perfil: " . $linha['perfil'] . "<br>";
            }
        }
    }
}

#consultar um registro pela chave primaria
if (isset($consultarChave)){ 
    if ($consultarChave = "Consultar pelo login"){ 
        if (isset($login)){ 
            $login = htmlspecialchars_decode(strip_tags($login));
            $testaConsulta = consultarChaveUsuario($login); 
            $qtdLinhas = mysqli_num_rows($testaConsulta); 
            if ($qtdLinhas == 0){
                echo "Login invalido" . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdLinhas;$i++){
                    $linha = mysqli_fetch_assoc($testaConsulta);

                    echo "<br>" . "Login: " . $linha['login'] . 
                    "<br>" . "Senha: " . $linha['senha'] . 
                    "<br>" . "Nome: " . $linha['nome'] . 
                    "<br>" . "Perfil: " . $linha['perfil'] . "<br>";
                }
            }
        }
    }
}

#alterar um registro pela chave primaria
if (isset($acaoalterar)){ 
    if ($acaoalterar = "Alterar Usuario"){ 
        if (isset($login) && isset($senha) && isset($nome) && isset($perfil)){
            $login = htmlspecialchars_decode(strip_tags($login));
            $senha = htmlspecialchars_decode(strip_tags($senha));
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $perfil = htmlspecialchars_decode(strip_tags($perfil));

            if (alterarUsuario($login, $senha, $nome, $perfil)){ 
                echo "Usuario alterado" . "<br>";
            }
            else{
                echo "Usuario não foi alterado" . "<br>";

            }
        }
    }
}

#consultar um registro pela sua senha
if (isset($consultar)){ 
    if ($consultar = "Consultar pela senha"){ 
        if (isset($senha)){ 
            $senha = htmlspecialchars_decode(strip_tags($senha));
            $testaConsulta = consultarSenha($senha); 
            $qtdLinhas = mysqli_num_rows($testaConsulta);
            if ($qtdLinhas == 0){
                echo "Senha invalida" . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdLinhas;$i++){
                    $linha = mysqli_fetch_assoc($testaConsulta);

                    echo "<br>" . "Login: " . $linha['login'] . 
                    "<br>" . "Senha: " . $linha['senha'] . 
                    "<br>" . "Nome: " . $linha['nome'] . 
                    "<br>" . "Perfil: " . $linha['perfil'] . "<br>";
                }
            }
        }
    }
}

#logando usuario
if (isset($acaoLogar)){ 
    if ($acaoLogar = "Logando"){ 
        if (isset($login) && isset($senha)){ 
            $login = htmlspecialchars_decode(strip_tags($login));
            $senha = htmlspecialchars_decode(strip_tags($senha));
        }
        if (logarUsuario($login, $senha)){ 
            echo "Login efetuado !!" . "<br>";
        }
        else{
            echo "Login não efetuado !!" . "<br>";
        }

    }
}

?>


