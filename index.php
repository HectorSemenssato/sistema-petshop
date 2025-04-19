<?php
include "conexao.php";

$ag_andamento = mysqli_query($conn, "SELECT count(id_agendamento) from agendamento where status_agendamento = 1");
$ag_finalizados = mysqli_query($conn, "SELECT count(id_agendamento) from agendamento where status_agendamento = 2");
$ag_cancelados = mysqli_query($conn, "SELECT count(id_agendamento) from agendamento where status_agendamento = 3");
$ag_total = mysqli_query($conn, "SELECT count(id_agendamento) from agendamento");
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
    <a href="login.php" class="btn">Login (provisório)</a>
</div>
<div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron">
                    <p class="lead">Dashboard do sistema</p>
                    <hr class="my-3">
                    <a class="btn btn_cadastro" data-bs-toggle="dropdown">fazer cadastros</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="cadastrar_agendamento.php">Agendamento</a></li>
                        <li><a class="dropdown-item" href="cadastrar_animal.php">Animal</a></li>
                        <li><a class="dropdown-item" href="cadastrar_cliente.php">Cliente</a></li>
                    </ul>
                    <a class="btn" id="botao-consultar" href="consultar.php" role="button">visualizar agendamentos</a>
                </div>
                <hr class="my-4">
            </div>
            <h3>Panorama do sistema</h3>
            <div class="painel-container">
                <div id="agnd-andamento">
                    <h5>Agendamentos em andamento: <?php echo mysqli_fetch_row($ag_andamento)[0] ?></h5>
                </div>
                <div id="agnd-cancelados">
                    <h5>Agendamentos cancelados: <?php echo mysqli_fetch_row($ag_cancelados)[0] ?></h5>
                </div>
                <div id="agnd-finalizados">
                    <h5>Agendamentos finalizados: <?php echo mysqli_fetch_row($ag_finalizados)[0] ?></h5>
                </div>
                <div id="agnd-totais">
                    <h5>Total de agendamentos realizados: <?php echo mysqli_fetch_row($ag_total)[0] ?></h5>
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