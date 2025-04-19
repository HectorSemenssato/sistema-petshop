<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consulta de agendamentos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>
    <?php
        $pesquisa = $_POST['busca'] ?? '';

        include "conexao.php";

        $sql = "SELECT * from agendamento WHERE id_agendamento like '%$pesquisa%'
                                          OR id_funcionario like '%$pesquisa%'
                                          OR id_animal LIKE '%$pesquisa%'
                                          OR nome_cliente LIKE '%$pesquisa%'
                                          OR data_agendamento LIKE '%$pesquisa%' 
                                          OR hora_agendamento LIKE '%$pesquisa%'";
        $dados = mysqli_query($conn, $sql);
    ?>

    <div class="container">
        <div class="row">
            <div class="col">
            <h1>Registro de agendamentos</h1>
            <nav class="navbar bg-body-tertiary">
                <div class="container-fluid">
                    <form class="d-flex" action="consultar.php" method="POST">
                    <input class="form-control me-2" type="search" placeholder="Digite aqui o que deseja encontrar" aria-label="Search" name="busca" autofocus>
                    <button class="btn btn-busca" type="submit">Buscar</button>
                    <a href="index.php" class="btn btn_inicio">Início</a>
                    </form>
                </div>
            </nav>

        <table class="table table-borderless">
            <thead>
               <tr>
                    <th scope="col">ID do agendamento</th>
                    <th scope="col">ID do funcionário</th>
                    <th scope="col">ID do animal</th>
                    <th scope="col">Nome do cliente</th>
                    <th scope="col">Data do agendamento</th>
                    <th scope="col">Hora do agendamento</th>
                    <th scope="col">Funções</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($linha = mysqli_fetch_assoc($dados)){
                        $idagendamento = $linha['id_agendamento'];
                        $idfuncionario = $linha['id_funcionario']; 
                        $idanimal = $linha['id_animal'];
                        $nomecliente = $linha['nome_cliente'];
                        $dataagendamento = $linha['data_agendamento'];
                        $dataagendamento = dataPadraoBR($dataagendamento);  
                        $horaagendamento = $linha['hora_agendamento'];

                        echo "<tr>
                                <th scope='row'>$idagendamento</th>
                                <td>$idfuncionario</td>
                                <td>$idanimal</td>
                                <td>$nomecliente</td>
                                <td>$dataagendamento</td>
                                <td>$horaagendamento</td>
                                <td width=100px><a href='editar.php?id_agendamento=$idagendamento' class='btn btn-editar'>Editar</a>
                                    <a href='#' class='btn btn-exclusao' data-bs-toggle='modal' data-bs-target='#modalconfirmacao'
                                    onclick=" .'"' ."pegar_dados($idagendamento)" .'"' .">Excluir</a>
                                     <button type='button' class='btn btn-outline-danger' data-bs-dismiss='modal'>Finalizar agendamento </button>
                                </td>
                             <tr>";
                    }
                ?>
            </tbody>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalconfirmacao" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Uma segunda chance para evitar problemas futuros...</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="excluir_toDB.php" method="POST">
                <p>Você tem certeza de que deseja excluir esses dados?</p>
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
            function pegar_dados(id_exclusao){
                document.getElementById('id_exclusao').value = id_exclusao;
            }
        </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
  </body>
</html>