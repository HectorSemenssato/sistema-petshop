<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agendamento de banho e tosa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
          <?php
            include "conexao.php";
            $idfuncionario = $_GET['funcionario_agendamento'];
            $idanimal = $_GET['idanimal_agendamento'];
            $idcliente = $_GET['nomecliente_agendamento'];
            $data_agendamento = $_GET['data_agendamento'];
            $hora_agendamento = $_GET['hora_agendamento'];

            $sql = "INSERT into `agendamento`(`id_funcionario`, `id_animal`, `data_agendamento`, `hora_agendamento`, `id_cliente`) 
                      VALUES ($idfuncionario, $idanimal, '$data_agendamento', '$hora_agendamento', '$idcliente')";

            if(mysqli_query($conn, $sql)){
                mensagem("Agendamento cadastrado com sucesso :D", 'success');
            }else{
                mensagem("Agendamento não foi cadastrado :(", 'danger');
            }
          ?> 
          <a href="index.php" class="btn btn-primary">Voltar</a> 
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>