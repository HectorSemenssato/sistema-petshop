<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resultado da edição</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">
        <div class="row">
          <?php
            include "conexao.php";
            $idagendamento = $_GET['id_agendamento'];
            $idfuncionario = $_GET['funcionario_agendamento'];
            $data_agendamento = $_GET['data_agendamento'];
            $hora_agendamento = $_GET['hora_agendamento'];
            $tipoanimal = $_GET['tipoanimal_agendamento'];
            $nomecliente = $_GET['nomecliente_agendamento'];

            $sql = "UPDATE `agendamento` set `id_funcionario` = $idfuncionario, `data_agendamento` = '$data_agendamento', 
                    `hora_agendamento` = '$hora_agendamento',`tipo_animal` = '$tipoanimal', `nome_cliente` = '$nomecliente'
                    WHERE `id_agendamento` = $idagendamento";
           
            if(mysqli_query($conn, $sql)){
                mensagem("Agendamento editado com sucesso :D", 'success');
            }else{
                mensagem("Agendamento não conseguiu ser editado :(", 'danger');
            }
          ?> 
          <div class="d-flex justify-content-center gap-2">
            <a href="index.php" class="btn btn-primary me-2">Ir para o início</a> 
            <a href="consultar.php" class="btn btn-success">Voltar para registro de agendamentos</a>
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>