<?php
/* Função para conectar o PHP ao banco de dados */
function conectarBancoAcademia(){
    $c = mysqli_connect("localhost", "root", "", "academia");
    if (mysqli_connect_error() == 0) {
        echo "<br>"."Conexão OK"."<br>";
    }
    else{
        $msg = mysqli_connect_error();
        echo "Erro na conexão SQL!"."<br>";
        echo "O Mysql retornou a seguinte mensagem: "."$msg"."<br>";
    }
return $c;  
}

?>