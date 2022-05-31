<?php

include_once ('conectar.php');
include_once ('funcoesData.php');
include_once ('funcaoAluno.php');

/* ___________________________________________ Aluno ________________________________________________________*/

extract($_REQUEST, EXTR_SKIP);
#incluindo dados a tabela aluno
if (isset($acao)){ 
    if ($acao = "Cadastre"){ 
        if (isset($nome) && isset($cpf) && isset($endereco) && isset($telefone) && isset($data_nascimento)){
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $endereco = htmlspecialchars_decode(strip_tags($endereco));
            $telefone = htmlspecialchars_decode(strip_tags($telefone));
            $data_nascimento = htmlspecialchars_decode(strip_tags($data_nascimento));

            if (!validar_data($data_nascimento)){ 
                echo "Data invalida!" . "<br>";
            }
            else{
                if (incluirAluno($nome, $cpf, $endereco, $telefone, $data_nascimento)){ 
                    echo "Aluno cadastrado" . "<br>";
                }
            }
        }
        else{

            echo "Aluno não cadastrado" . "<br>";
        }
    }
}

#consultar todos os registros da tabela
if (isset($acaoconsultar)){ 
    if ($acaoconsultar == "Consultar Alunos"){ 
        $testaConsulta = consultarListaAluno(); 
        $qtdLinhas = mysqli_num_rows($testaConsulta); 
        if ($qtdLinhas == 0){
            echo "Aluno não encontrado" . "<br>";
        }
        else{
            for ($i = 0;$i < $qtdLinhas;$i++){
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
if (isset($consultarChave)){ 
    if ($consultarChave = "Consultar CPF Aluno"){ 
        if (isset($cpf)){
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $testaConsulta = consultarChaveAluno($cpf); 
            $qtdLinhas = mysqli_num_rows($testaConsulta); 
            if ($qtdLinhas == 0){ 
                echo "CPF invalido" . "<br>";
            }
            else{ 
                for ($i = 0;$i < $qtdLinhas;$i++){
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

#alterar um registro pela sua chave primaria
if (isset($acaoalterar)){ 
    if ($acaoalterar = "Alterar Aluno"){ 
        if (isset($nome) && isset($cpf) && isset($endereco) && isset($telefone) && isset($data_nascimento)){
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $endereco = htmlspecialchars_decode(strip_tags($endereco));
            $telefone = htmlspecialchars_decode(strip_tags($telefone));
            $data_nascimento = htmlspecialchars_decode(strip_tags($data_nascimento));

            if (!validar_data($data_nascimento)){ 
                echo "Data invalida" . "<br>";
            }
            else{
                if (alterarAluno($nome, $cpf, $endereco, $telefone, $data_nascimento)){ 
                    echo "Aluno alterado" . "<br>";
                }
                else{
                    echo "Aluno não foi alterado" . "<br>";

                }
            }
        }
    }
}

#consultar um registro pelo nome
if (isset($consultar)){ 
    if ($consultar = "Consultar pelo nome"){ 
        if (isset($nome)){
            $nome = htmlspecialchars_decode(strip_tags($nome));
            $testaConsulta = consultarNome($nome); 
            $qtdLinhas = mysqli_num_rows($testaConsulta); 
            if ($qtdLinhas == 0){
                echo "Nome invalido" . "<br>";
            }
            else{
                for ($i = 0;$i < $qtdLinhas;$i++){
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

#exluindo um registro pela sua chave primaria
if (isset($excluir)){ 
    if ($excluir = "Excluir aluno"){ 
        if (isset($cpf)){
            $cpf = htmlspecialchars_decode(strip_tags($cpf));
            $testaExcluir = excluirAluno($cpf); 
            if ($testaExcluir){
                echo "Aluno foi excluido" . "<br>";
            }
            else{
                echo "Aluno não foi excluido" . "<br>";
            }
        }
    }
}

?>
