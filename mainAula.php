<?php

include_once ('conectar.php');
include_once ('funcaoAula.php');
include_once ('funcaoHora.php');
extract($_REQUEST, EXTR_SKIP);
#incluindo dados a tabela aula
if (isset($acao)){ 
    if ($acao = "Registrar"){ 
        if (isset($cod_aula) && isset($aula) && isset($dia_aula) && isset($horario) && isset($preco)){ 
            $cod_aula = htmlspecialchars_decode(strip_tags($cod_aula)); 
            $aula = htmlspecialchars_decode(strip_tags($aula));
            $dia_aula = htmlspecialchars_decode(strip_tags($dia_aula));
            $horario = htmlspecialchars_decode(strip_tags($horario));
            $preco = htmlspecialchars_decode(strip_tags($preco));

            if (!validarHorario($horario)){ 
                echo "Horario invalido!" . "<br>";
            }

            if (incluirAula($cod_aula, $aula, $dia_aula, $horario, $preco)){ 
                echo "Aula registrada" . "<br>";
            }
        }
    }
    else{

        echo "Aula não registrada" . "<br>";
    }
}

#consultar todos os registros da tabela aula 
if (isset($acaoconsultar)){ 
    if ($acaoconsultar == "Consultar Aulas"){ 
        $testaConsulta = consultarListaAula(); 
        $qtdLinhas = mysqli_num_rows($testaConsulta); 
        if ($qtdLinhas == 0){ 
            echo "Não existe registros na tabela" . "<br>";
        }
        else{ 
            for ($i = 0;$i < $qtdLinhas;$i++){
                $linha = mysqli_fetch_assoc($testaConsulta);
                echo "<br>" . "Código da aula: " . $linha['cod_aula'] . 
                "<br>" . "Aula: " . $linha['aula'] . 
                "<br>" . "Dia da aula: " . $linha['dia_aula'] . 
                "<br>" . "Horario: " . $linha['horario'] . 
                "<br>" . "Preço: " . $linha['preco'] . "<br>";
            }
        }
    }
}

#consultar um registro pela sua chave primaria
if (isset($consultarChave)){ 
    if ($consultarChave = "Consultar codigo"){ 
        if (isset($cod_aula)){ 
            $cod_aula = htmlspecialchars_decode(strip_tags($cod_aula)); 
            $testaConsulta = consultarChaveAula($cod_aula); 
            $qtdLinhas = mysqli_num_rows($testaConsulta); 
            if ($qtdLinhas == 0){ 
                echo "Código inválido" . "<br>";
            }
            else{ 
                for ($i = 0;$i < $qtdLinhas;$i++){
                    $linha = mysqli_fetch_assoc($testaConsulta);

                    echo "<br>" . "Código Aula: " . $linha['cod_aula'] . 
                    "<br>" . "Aula: " . $linha['aula'] . 
                    "<br>" . "Dia da aula: " . $linha['dia_aula'] . 
                    "<br>" . "Horário: " . $linha['horario'] . 
                    "<br>" . "Preço: " . $linha['preco'] . "<br>";
                }
            }
        }
    }
}

#alterar dados de um registro pela chave primaria
if (isset($acaoalterar1)){ 
    if ($acaoalterar1 = "Alterar Aula"){ 
        if (isset($cod_aula) && isset($aula) && isset($dia_aula) && isset($horario) && isset($preco)){ 
            $cod_aula = htmlspecialchars_decode(strip_tags($cod_aula)); 
            $aula = htmlspecialchars_decode(strip_tags($aula));
            $dia_aula = htmlspecialchars_decode(strip_tags($dia_aula));
            $horario = htmlspecialchars_decode(strip_tags($horario));
            $preco = htmlspecialchars_decode(strip_tags($preco));

            if (!validarHorario($horario)){ 
                echo "Horario invalido!" . "<br>";
            }

            if (alterarAula($cod_aula, $aula, $dia_aula, $horario, $preco)){ 
                echo "Aula alterada" . "<br>";
            }
            else{
                echo "Aula não foi alterada" . "<br>";

            }
        }
    }
}

#consultar uma aula pelo seu dia
if (isset($consultar)){ 
    if ($consultar = "Consultar dia"){ 
        if (isset($dia_aula)){ 
            $dia_aula = htmlspecialchars_decode(strip_tags($dia_aula)); 
            $testaConsulta = consultarDiaAula($dia_aula); 
            $qtdLinhas = mysqli_num_rows($testaConsulta); 
            if ($qtdLinhas == 0){ 
                echo "Nenhuma aula foi encontrada" . "<br>";
            }
            else{ 
                for ($i = 0;$i < $qtdLinhas;$i++){
                    $linha = mysqli_fetch_assoc($testaConsulta);

                    echo "<br>" . "Código Aula: " . $linha['cod_aula'] . 
                    "<br>" . "Aula: " . $linha['aula'] . 
                    "<br>" . "Dia da aula: " . $linha['dia_aula'] . 
                    "<br>" . "Horário: " . $linha['horario'] . 
                    "<br>" . "Preço: " . $linha['preco'] . "<br>";

                }
            }
        }
    }
}

#exluindo uma aula pela sua chave primaria
if (isset($excluir)){ 
    if ($excluir = "Excluir aula"){ 
        if (isset($cod_aula)){ 
            $cpf = htmlspecialchars_decode(strip_tags($cod_aula)); 
            $testaExcluir = excluirAula($cod_aula); 
            if ($testaExcluir){
                echo "Aula excluida" . "<br>";
            }
            else{
                echo "Aula não foi excluida" . "<br>";
            }
        }
    }
}

?>