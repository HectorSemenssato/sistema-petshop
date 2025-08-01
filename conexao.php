<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $bd = "bd_petshop";

    $conn = mysqli_connect($server, $user, $pass, $bd);

    if (!$conn) {
        die("ERRO: Não foi possível conectar ao MySQL. " . mysqli_connect_error());
    }

    function mensagem($texto, $tipo){
        
        echo "<div class='alert alert-$tipo' role='alert'>
                <center>$texto<center>
                </div>";
    }

    function dataPadraoBR($data){
        $d = explode('-', $data);
        $escreve = $d[2] . "/" . $d[1] . "/" . $d[0];
        return $escreve;
    }
