<?php
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
                agendamento.nome_cliente,
                agendamento.data_agendamento,
                agendamento.hora_agendamento,
                funcionario.nome_funcionario,
                ficha_animal.nome from agendamento 
                JOIN funcionario ON agendamento.id_funcionario = funcionario.id_funcionario 
                JOIN ficha_animal ON agendamento.id_animal = ficha_animal.id_animal
                    WHERE agendamento.id_agendamento LIKE ?
                        OR funcionario.nome_funcionario LIKE ?
                        OR ficha_animal.nome LIKE ?
                        OR agendamento.nome_cliente LIKE ?
                        OR agendamento.data_agendamento LIKE ?
                        OR agendamento.hora_agendamento LIKE ?";
    $para_pesquisa = "%" . $pesquisa . "%";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $para_pesquisa, $para_pesquisa, $para_pesquisa, $para_pesquisa, $para_pesquisa, $para_pesquisa);

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
                        <th scope="col">ID do agendamento</th>
                        <th scope="col">Funcionário</th>
                        <th scope="col">Animal</th>
                        <th scope="col">Nome do cliente</th>
                        <th scope="col">Data do agendamento</th>
                        <th scope="col">Hora do agendamento</th>
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
                                $nomecliente = $linha['nome_cliente'];
                                $dataagendamento = dataPadraoBR($linha['data_agendamento']);
                                $horaagendamento = $linha['hora_agendamento'];

                                echo "<tr>
                                <th scope='row'>$idagendamento</th>
                                <td>$funcionario</td>
                                <td>$animal</td>
                                <td>$nomecliente</td>
                                <td>$dataagendamento</td>
                                <td>$horaagendamento</td>
                                <td width=360px><a href='editar.php?id_agendamento=$idagendamento' class='btn btn-sm btn-editar'>Editar</a>
                                    <a href='#' class='btn btn-sm btn-exclusao' data-bs-toggle='modal' data-bs-target='#modalconfirmacao'
                                    onclick=" . '"' . "pegar_dados($idagendamento)" . '"' . ">Excluir</a>
                                     <button type='button' class='btn btn-sm btn-finalizaagendamento' data-bs-dismiss='modal'>Finalizar</button>
                                </td>
                             </tr>";
                            }
                        }else{
                             echo "<tr><td colspan='7' class='text-center'>Nenhum agendamento encontrado.</td></tr>";
                        }

                        ?>
                    </tbody>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modalconfirmacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Confirmação de exclusão</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="excluir_toDB.php" method="POST">
                                <p>Você tem certeza de que deseja excluir esse registro?</p>
                                <strong>Essa ação não poderá ser desfeita.</strong>
                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-success" value="Sim">
                            <input type="hidden" name="id" id="id_exclusao" value="">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cancelar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <script type="text/javascript">
                function pegar_dados(id_exclusao) {
                    document.getElementById('id_exclusao').value = id_exclusao;
                }
            </script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>