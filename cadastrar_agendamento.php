<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de agendamento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles_cadastros.css">
</head>

<body>
    <div id="title">
        <h4>Agendamento</h4>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="cadastrar_toDB.php">
                    <div class="input__container input_ag_idfuncionario" data-label="id do funcionário (provisório)">
                        <input type="text" class="input__search" name="funcionario_agendamento" required>
                    </div>
                    <div class="input__container input_ag_idanimal" data-label="id do animal (provisório)">
                        <input type="text" class="input__search" name="idanimal_agendamento" required>
                    </div>
                    <div class="input__container  input_ag_nomecliente" data-label="nome do cliente: (não configurado)">
                        <input type="text" class="input__search" name="nomecliente_agendamento">
                    </div>
                    <div class="input__container input_ag_dataagenda" data-label="data do agendamento:">
                        <input type="date" class="input__search" name="data_agendamento" required>
                    </div>
                    <div class="input__container input_ag_horaagenda" data-label="hora do agendamento:">
                        <input type="time" class="input__search " name="hora_agendamento" required>
                    </div>
                    <button type="submit" class="btn btn_agendar">Agendar</button>
                    <a href="index.php" class="btn btn_inicio">Voltar para o início</a>
                    <input type="checkbox" id="chkbox_banhoetosa">Banho e tosa</label>
                </form>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>