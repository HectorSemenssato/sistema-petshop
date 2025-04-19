<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edição de agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style_edicao.css">
  </head>
  <body>
    <?php
        include "conexao.php";
        $id = $_GET['id_agendamento'] ?? '';
        $sql = "SELECT * from agendamento WHERE id_agendamento = $id";

        $dados = mysqli_query($conn, $sql);
        $linha = mysqli_fetch_assoc($dados);
    ?>


        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>Edição de agendamentos</h1>
                    <form action="editar_toDB.php">
                        <div class="mb-3">
                            <label for="idfuncionario_agendamento" class="form-label">ID do funcionário:</label>
                            <input type="text" class="form-control" name="funcionario_agendamento" required value="<?php echo $linha['id_funcionario'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="tipoanimal_agendamento" class="form-label">Tipo de animal:</label>
                            <input type="text" class="form-control" name="idanimal_agendamento" required value="<?php echo $linha['id_animal'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="nomecliente_agendamento" class="form-label">Nome do cliente:</label>
                            <input type="text" class="form-control" name="nomecliente_agendamento" required value="<?php echo $linha['nome_cliente'] ?>">
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
                        <input type="hidden" name="id_agendamento" value="<?php echo $linha['id_agendamento']; ?>">
                        <a href="consultar.php" class="btn btn-secondary">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>