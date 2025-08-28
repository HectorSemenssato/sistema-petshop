<?php
session_start();
include 'protege_pagina.php';

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

$sql_agendamento = "SELECT a.id_agendamento, c.id_cliente, fa.id_animal, f.id_funcionario, a.data_agendamento, a.hora_agendamento
                    FROM agendamento a JOIN funcionario f ON a.id_funcionario = f.id_funcionario
                                       JOIN clientes c ON a.id_cliente = c.id_cliente
                                       JOIN ficha_animal fa ON a.id_animal = fa.id_animal
                    WHERE a.id_agendamento = ?";

if ($stmt = $conn->prepare($sql_agendamento)) {
    $stmt->bind_param("i", $id_agendamento);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows === 1) {
        $agendamento = $resultado->fetch_assoc();
    } else {
        header('Location: consultar.php');
        exit();
    }
    $stmt->close();
}

$sql_funcionarios = "SELECT id_funcionario, nome_funcionario FROM funcionario ORDER BY nome_funcionario ASC";
$dados_funcionario = $conn->query($sql_funcionarios);

$sql_clientes = "SELECT id_cliente, nome_cliente FROM clientes ORDER BY nome_cliente ASC";
$dados_cliente = $conn->query($sql_clientes);
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
                                    <a href='#' id='btn-novo-animal' class='btn btn-sm btn-editar' data-bs-toggle='modal' data-bs-target='#modalEdicao'>Editar</a>
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
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEdicao" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Agendamento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="editar_toDB.php" method="POST">
                        <div class="row justify-content-center">
                            <div class="col-md-7 col-lg-8">
                                <div class="inputs-section">
                                    <div class="input__container" data-label="Funcionário responsável">
                                        <select class="input__search" name="id_funcionario" required>
                                            <option value="">Selecione um funcionário...</option>
                                            <?php while ($funcionario = $dados_funcionario->fetch_assoc()): ?>
                                                <option value="<?php echo $funcionario['id_funcionario']; ?>"
                                                    <?php echo ($funcionario['id_funcionario'] == $agendamento['id_funcionario']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($funcionario['nome_funcionario']); ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <div class="input__container" data-label="Nome do cliente:">
                                            <select class="input_search" name="id_cliente" required>
                                                <option value="">Selecione um cliente...</option>
                                                <?php while ($cliente = $dados_cliente->fetch_assoc()): ?>
                                                    <option value="<?php echo $cliente['id_cliente']; ?>"
                                                        <?php echo ($cliente['id_cliente'] == $agendamento['id_cliente']) ? 'selected' : ''; ?>>
                                                        <?php echo htmlspecialchars($cliente['nome_cliente']); ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="data_agendamento">Data do agendamento:</label>
                                            <input type="date" class="form-control" name="data_agendamento" required value="<?php echo $linha['data_agendamento'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="hora_agendamento">Hora do agendamento:</label>
                                            <input type="time" class="form-control" name="hora_agendamento" required value="<?php echo $linha['hora_agendamento'] ?>">
                                        </div>

                                        <button type="submit" class="btn btn-primary" style="text-align: center;" value="Salvar alterações">Salvar edição</button>
                                        <a href="consultar.php" class="btn btn-secondary">Voltar</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary" id="btn-salvar-edicao">Salvar Alterações</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
                confirmButtonColor: '#8567e6',
                cancelButtonColor: 'rgba(119, 119, 119, 1)',
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'excluir_toDB.php?id=' + id;
                }
            });
        }

        const btnEditarAgendamento = document.getElementById('btn-novo-animal');
        const modalEditarAgendamentoEl = document.getElementById('modalEditar');
        const modalEditarAgendamento = new bootstrap.Modal(modalNovoAnimalEl);
        const btnSalvarEdicao = document.getElementById('btn-salvar-edicao');


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