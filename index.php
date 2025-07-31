<?php
include "conexao.php";
include 'protege_pagina.php'; 

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
    <link rel="stylesheet" href="./css/styles.css">
    <title>Petshop - Início</title>
</head>
<div>
    <nav class="navbar navbar-expand-lg navbar-petshop">
        <div class="container-fluid">

            <button class="navbar-toggler" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggle-icon"></span>
            </button>
            <div class="collpase navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle me-1" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            <?php echo htmlspecialchars($_SESSION['username']); ?>
                        </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Meu Perfil</a></li>
                                <li><hr class="dropdrown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-danger" href="logout.php">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right me-2" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z" />
                                            <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z" />
                                        </svg>
                                        Sair
                                    </a>
                                </li>
                            </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</div>
<div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="jumbotron">
                    <p class="lead">Dashboard do sistema</p>
                    <hr class="my-3">
                    <div class="d-flex align-items-center justify-content-center dashboard-actions">
                        <div class="dropdown me-2">
                            <a class="btn btn_cadastro dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                fazer cadastro
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="cadastrar_agendamento.php">Agendamento</a></li>
                                <li><a class="dropdown-item" href="cadastrar_animal.php">Animal</a></li>
                                <li><a class="dropdown-item" href="cadastrar_cliente.php">Cliente</a></li>
                            </ul>
                            <a class="btn" id="botao-consultar" href="consultar.php" role="button">visualizar agendamentos</a>
                        </div>
                        <hr class="my-4">
                    </div>
                    <div>

                    </div>
                    <h3 class="justify-content-center">Panorama do sistema</h3>
                    <div class="container-fluid mt-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="painel-dashboard" id="agnd-andamento">
                                    <h5>Agendamentos em andamento: <?php echo mysqli_fetch_row($ag_andamento)[0] ?></h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="painel-dashboard" id="agnd-cancelados">
                                    <h5>Agendamentos cancelados: <?php echo mysqli_fetch_row($ag_cancelados)[0] ?></h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="painel-dashboard" id="agnd-finalizados">
                                    <h5>Agendamentos finalizados: <?php echo mysqli_fetch_row($ag_finalizados)[0] ?></h5>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="painel-dashboard" id="agnd-totais">
                                    <h5>Total de agendamentos realizados: <?php echo mysqli_fetch_row($ag_total)[0] ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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