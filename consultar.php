<?php
session_start();
include 'protege_pagina.php';
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta de agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <?php
    $pesquisa = $_POST['busca'] ?? '';

    include "conexao.php";

    $sql = "SELECT 
                agendamento.id_agendamento,
                agendamento.data_agendamento,
                agendamento.hora_agendamento,
                funcionario.nome_funcionario,
                clientes.nome_cliente,
                ficha_animal.nome from agendamento 
                JOIN funcionario ON agendamento.id_funcionario = funcionario.id_funcionario 
                JOIN ficha_animal ON agendamento.id_animal = ficha_animal.id_animal
                JOIN clientes ON agendamento.id_cliente = clientes.id_cliente
                    WHERE agendamento.id_agendamento LIKE ?
                        OR clientes.nome_cliente LIKE ?
                        OR ficha_animal.nome LIKE ?
                        OR agendamento.data_agendamento LIKE ?
                        OR agendamento.hora_agendamento LIKE ?";
    $para_pesquisa = "%" . $pesquisa . "%";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sssss", $para_pesquisa, $para_pesquisa, $para_pesquisa, $para_pesquisa, $para_pesquisa);

        $stmt->execute();
        $dados = $stmt->get_result();
        $stmt->close();
    } else {
        $dados = null;
    }
    ?>

    <div class="container mb-4">
        <div class="row">
            <div class="col">
                <div id="title">
                    <h4>Consulta de agendamentos</h4>
                </div>
                <nav class="navbar bg-body-tertiary">
                    <div class="container-fluid">
                        <form class="d-flex" action="consultar.php" method="POST">
                            <input class="form-control me-2" type="search" placeholder="Digite aqui o que deseja encontrar" aria-label="Search" name="busca" autofocus>
                            <button class="btn btn-busca" type="submit">buscar</button>
                            <a href="index.php" class="btn btn-inicio">início</a>
                        </form>
                    </div>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex justify-content-end mb-3">
            <a href="cadastrar_agendamento.php" class="btn btn-cadagendamento">criar novo agendamento</a>
        </div>
        <div class="card shadow-lg">
            <div class="card-body p-0">
                <table class="table mb-0 table table-bordered">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Data</th>
                        <th scope="col">Horário</th>
                        <th scope="col">Animal</th>
                        <th scope="col">Tutor do animal</th>
                        <th scope="col">Doutor</th>
                        <th scope="col">Funções</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($dados->num_rows > 0) {
                            while ($linha = mysqli_fetch_assoc($dados)) {
                                $idagendamento = $linha['id_agendamento'];
                                $funcionario = $linha['nome_funcionario'];
                                $animal = $linha['nome'];
                                $nome_cliente = $linha['nome_cliente'];
                                $dataagendamento = dataPadraoBR($linha['data_agendamento']);
                                $horaagendamento = $linha['hora_agendamento'];
                                $cliente_para_alerta = htmlspecialchars($linha['nome_cliente'], ENT_QUOTES);

                                echo "<tr>
                                <th scope='row'>$idagendamento</th>
                                <td>$dataagendamento</td>
                                <td>$horaagendamento</td>
                                <td>$animal</td>
                                <td>$nome_cliente</td>
                                <td>$funcionario</td>
                                <td>
                                    <a href='editar.php?id_agendamento=$idagendamento' class='btn btn-sm btn-editar'>Editar</a>
                                    <a href='javascript:void(0);' class='btn btn-sm btn-exclusao' onclick='confirmarExclusao($idagendamento, \"$cliente_para_alerta\")'>Excluir</a>
                                    <button type='button' class='btn btn-sm btn-finalizaagendamento'>Finalizar</button>
                                </td>
                             </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='text-center'>Nenhum agendamento encontrado.</td></tr>";
                        }

                        ?>
                    </tbody>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script type="text/javascript">
                function confirmarExclusao(id, nomeCliente) {
                    Swal.fire({
                        title: 'Você tem certeza?',
                        text: "Deseja realmente excluir o agendamento de " + nomeCliente + "? Esta ação não poderá ser desfeita!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Sim, excluir!",
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'excluir_toDB.php?id=' + id;
                        }
                    });
                }
                <?php
                if (isset($_SESSION['notificacao'])) {
                    $tipo = htmlspecialchars($_SESSION['notificacao']['tipo']);
                    $texto = htmlspecialchars($_SESSION['notificacao']['texto']);
                    $title = htmlspecialchars($_SESSION['notificacao']['title']);

                    echo "Swal.fire({
                        icon: '$tipo',
                        title: '$title',
                        text: '$texto'   
                    });";
                    unset($_SESSION['notificacao']);
                }
                ?>
            </script>

</body>

</html>