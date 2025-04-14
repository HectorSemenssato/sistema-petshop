<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de agendamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col">
            <H1>
                <center>Cadastro</center>
            </H1>
                <form action="cadastrar_toDB.php">
                    <div class="mb-3">
                        <label for="idfuncionario_agendamento" class="form-label">ID do funcionário:</label>
                        <input type="text" class="form-control" name="funcionario_agendamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipoanimal_agendamento" class="form-label">Tipo de animal:</label>
                        <input type="text" class="form-control" name="tipoanimal_agendamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="nomecliente_agendamento" class="form-label">Nome do cliente:</label>
                        <input type="text" class="form-control" name="nomecliente_agendamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="data_agendamento">Data do agendamento:</label>
                        <input type="date" class="form-control" name="data_agendamento" required>
                    </div>
                    <div class="mb-3">
                        <label for="hora_agendamento">Hora do agendamento:</label>
                        <input type="time" class="form-control" name="hora_agendamento" required>
                    </div>
                    <button type="submit" class="btn btn-success">Agendar</button>
                    <a href="index.php" class="btn btn-info">Voltar para o início</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>