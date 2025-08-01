<?php
include 'protege_pagina.php';
include 'conexao.php';

$pesquisa = $_POST['busca'] ?? '';

$sql = "SELECT id_cliente, nome_cliente FROM clientes ORDER BY nome_cliente ASC";

if ($stmt = $conn->prepare($sql)) {
    $stmt->execute();
    $dados = $stmt->get_result();
    $stmt->close();
} else {
    $dados = null;
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de agendamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles_cadastros.css">
</head>

<body>
    <div class="col">
        <div class="container mt-4">
            <h2 id="title">Agendamento</h2>
            <form action="cadastrar_toDB.php">
                <input type="hidden" name="funcionario_agendamento" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                <div class="row justify-content-center">
                    <div class="col-md-7 col-lg-8">
                        <div class="inputs-section">
                            <div class="input__container" data-label="Funcionário responsável">
                                <p class="form-control-plaintext">
                                    <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                                </p>
                            </div>
                            <div class="input__container  input_ag_nomecliente" data-label="Nome do cliente:">
                                <select class="input__search" name="nomecliente_agendamento" id="cliente_select">
                                    <?php
                                    if ($dados->num_rows > 0) {
                                        echo "<option value=''>Selecione um cliente...</option>";
                                        while ($linha = mysqli_fetch_assoc($dados)) {
                                            echo "<option value='{$linha['id_cliente']}'>{$linha['nome_cliente']}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="input__container input_ag_idanimal" data-label="Nome do animal">
                                <select class="input__search" name="idanimal_agendamento" id="animal_select" disabled>
                                    <option value=''>Aguardando seleção de cliente...</option>
                                </select>
                            </div>
                            <div class="input__container input_ag_dataagenda" data-label="Data do agendamento:">
                                <input type="date" class="input__search" name="data_agendamento" required>
                            </div>
                            <div class="input__container input_ag_horaagenda" data-label="Hora do agendamento:">
                                <input type="time" class="input__search " name="hora_agendamento" required>
                            </div>
                            <div class="d-flex justify-content-end mb-4">
                                <button type="submit" class="btn btn_agendar me-3">Agendar</button>
                                <a href="index.php" class="btn btn_inicio">Voltar para o início</a>
                            </div>
                        </div>
                        <div>
                            <div class="col-md-5 col-lg-4 d-flex justify-content-center align-items-center">
                                <div class="photo-placeholder card p-3 shadow-sm">
                                    <h5>Foto do animal</h5>
                                    <p class="text-center text-muted">Arraste e solte ou clique para enviar imagem</p>
                                    <input type="file" id="animalFotoUpload" class="d-none">
                                    <label for="animalFotoUpload" class="btn btn-outline-secondary mt-3">Carregar foto</label>
                                    <img src="https://placehold.co/600x400" class="img-fluid mt-3 rounded" alt="Foto do Animal">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const clienteSelect = document.getElementById('cliente_select');
                const animalSelect = document.getElementById('animal_select');

                clienteSelect.addEventListener('change', function() {
                    const clienteId = this.value;

                    animalSelect.innerHTML = '<option value="">Carregando...</option>';
                    animalSelect.disabled = true;
                    if (!clienteId) {
                        animalSelect.innerHTML = '<option value="">Aguardando seleção de cliente...</option>';
                        return;
                    }

                    fetch('get_animais.php?cliente_id=' + clienteId)
                        .then(response => response.json())
                        .then(data => {
                            animalSelect.innerHTML = '<option value="">Selecione um animal...</option>';

                            if (data.length > 0) {
                                data.forEach(function(animal) {
                                    const option = document.createElement('option');
                                    option.value = animal.id_animal;
                                    option.textContent = animal.nome;
                                    animalSelect.appendChild(option);
                                });
                                animalSelect.disabled = false;
                            } else {
                                animalSelect.innerHTML = '<option value="">Nenhum animal encontrado</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Erro ao buscar animais:', error);
                            animalSelect.innerHTML = '<option value="">Erro ao carregar</option>';
                        });
                });
            });
        </script>
</body>

</html>