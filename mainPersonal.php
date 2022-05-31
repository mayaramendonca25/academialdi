<?php

include_once ('conectar.php');
include_once ('funcoesData.php');
include_once ('funcaoPersonal.php');
/*______________________________________________ Personal ________________________________________________ */

extract($_REQUEST, EXTR_SKIP);
#incluindo dados a tabela personal
if (isset($acao2)) { 
    if ($acao2 = "Registre") { 
        if (isset($nome) && isset($cpf) && isset($endereco) && isset($telefone) && isset($data_nascimento)) {
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $endereco = htmlspecialchars_decode(strip_tags($endereco));
            $telefone = htmlspecialchars_decode(strip_tags($telefone));
            $data_nascimento = htmlspecialchars_decode(strip_tags($data_nascimento));
                
            if (!validar_data($data_nascimento)) { 
                echo "Data informada é invalida!". "<br>";
            }
            else{ 
                if (incluirPersonal($nome, $cpf, $endereco, $telefone, $data_nascimento)) {
                
                    echo "Registrado" ."<br>";
                }
            }
        }
        else{

            echo "Não Registrado". "<br>";
        }
    }
}

#consultar todos os registros da tabela
if (isset($acaoconsultar)) { 
    if ($acaoconsultar == "Consultar Personal") { 

        $testaConsulta = consultarListaPersonal(); 
        $qtdLinhas = mysqli_num_rows($testaConsulta); 
        if ($qtdLinhas == 0) {
            echo "Não existe registros na tabela" . "<br>";
        } 
        else {
            for ($i = 0; $i < $qtdLinhas; $i++) {
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "Nome: " . $linha['nome'] .
                "<br>" . "CPF: " . $linha['cpf'] .
                "<br>" . "Endereco: " . $linha['endereco'] .
                "<br>" . "Telefone: " . $linha['telefone'] .
                "<br>" . "Data nascimento: " . formatardataTela($linha['data_nascimento']) . "<br>";
            }
        }
    }
}

#consultar um registro pela chave primaria
if (isset($consultarChave1)) { 
    if ($consultarChave1 = "Consultar pelo CPF") { 
        if (isset($cpf)) {
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $testaConsulta = consultarChavePersonal($cpf); 
            $qtdLinhas = mysqli_num_rows($testaConsulta); 

            if ($qtdLinhas == 0) {
                echo "\n" . "CPF invalido" . "<br>";
            } 
            else {
                for ($i = 0; $i < $qtdLinhas; $i++) {
                    $linha = mysqli_fetch_assoc($testaConsulta);

                echo "<br>" . "Nome: " . $linha['nome'] .
                "<br>" . "CPF: " . $linha['cpf'] .
                "<br>" . "Endereco: " . $linha['endereco'] .
                "<br>". "Telefone = " . $linha['telefone'] .
                "<br>". "Data nascimento: " . formatardataTela($linha['data_nascimento']) ."<br>";
                }
            }
        }
    }
}

#alterar um registro pela sua chave primaria
if (isset($acaoalterar)) { 
    if ($acaoalterar = "Alterar Personal") { 
        if (isset($nome) && isset($cpf) && isset($endereco) && isset($telefone) && isset($data_nascimento)) {
             $nome = htmlspecialchars_decode(strip_tags($nome));
             $cpf = htmlspecialchars_decode(strip_tags($cpf));
             $endereco = htmlspecialchars_decode(strip_tags($endereco));
             $telefone = htmlspecialchars_decode(strip_tags($telefone));
             $data_nascimento = htmlspecialchars_decode(strip_tags($data_nascimento));

                if (!validar_data($data_nascimento)) { 
                    echo "Data informada é invalida" . "<br>";
                }
                else{
                    if (alterarPersonal($nome, $cpf, $endereco, $telefone, $data_nascimento)) { 
                        echo "Personal alterado"."<br>";
                    }
                    else{ 
                        echo "Personal não foi alterado". "<br>";

                }
            }
        }
    }
}

#consultar um registro pelo seu telefone
if (isset($consultar)) { 
    if ($consultar = "Consultar pelo telefone") { 
        if (isset($telefone)) {
            $telefone = htmlspecialchars_decode(strip_tags($telefone));
            $testaConsulta = consultarTelefone($telefone); 
            $qtdLinhas = mysqli_num_rows($testaConsulta); 

            if ($qtdLinhas == 0) {
                echo  "Telefone invalido" . "<br>";
            } 
            else {
                for ($i = 0; $i < $qtdLinhas; $i++) {
                    $linha = mysqli_fetch_assoc($testaConsulta);

                    echo "<br>" . "Nome: " . $linha['nome'] .
                    "<br>" . "CPF: " . $linha['cpf'] .
                    "<br>" . "Endereco: " . $linha['endereco'] .
                    "<br>" . "Telefone: " . $linha['telefone'] .
                    "<br>" . "Data nascimento: " . formatardataTela($linha['data_nascimento']) . "<br>";
                    
                }
            }
        }
    }
}

#exluindo um registro pela chave primaria
if (isset($excluir)) { 
    if ($excluir =  "Excluir personal") { 
        if (isset($cpf)) {
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $testaExcluir = excluirPersonal($cpf); 

            if($testaExcluir){
                echo "Personal excluido" . "<br>";
            }
            else{
                echo "Personal não foi excluido". "<br>";
            }
        }
    }
}


?>