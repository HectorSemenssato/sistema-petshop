<?php
include "conexao.php";

// $ag_andamento = mysqli_query($conn, "select count(id_agendamento) from agendamento where situacao_ag = 1");
// $ag_encerrados = mysqli_query($conn, "select count(id_agendamento) from agendamento where situacao_ag = 0");
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Petshop - Início</title>
</head>
<div>
    <div id="usuario">
        <h5>Olá, %user%!</h5>
    </div>
</div>
<div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron">
                    <h1 class="display-4">Pet Shop</h1>
                    <p class="lead">Seja bem-vindo ao sistema de agendamentos de banho e tosa</p>
                    <hr class="my-1">
                    <a class="btn" id="botao-cadastrar" href="cadastrar.php" role="button">fazer agendamentos</a>
                    <a class="btn" id="botao-consultar" href="consultar.php" role="button">visualizar agendamentos</a>
                </div>
                <hr class="my-4">
            </div>
            <h3>Panorama geral do sistema</h3>
            <div id="panor-tot-agend">
                <h5>Agendamentos em andamento: <?php echo $ag_andamento?></h5>
            </div>
            <div id="panor-cancel-agend">
                <h5>Agendamentos cancelados: <?php echo $ag_encerrados?></h5>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
</body>

</html>