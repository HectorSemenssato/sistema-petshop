<?php
    include 'protege_pagina.php'; // Nosso guardião!
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
</head>

<body>
    <div id="title">
        <h4>Cadastro de cliente</h4>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="cadastrar_toDB.php">
                    <div class="input__container input_nomeanimal" data-label="nome do animal">
                        <input type="text" name="nomeanimal" class="input__search search_cliente" placeholder="Digite o nome do bichinho" />
                    </div>
                    <div class="input__container input_idade" data-label="idade">
                        <div class="shadow__input"></div>
                        <input type="text" name="idadeanimal" class="input__search search_idade" placeholder="Digite a idade do bichinho" />
                    </div>
                    <div class="input__container input_raca" data-label="raça">
                        <div class="shadow__input"></div>
                        <input type="text" name="racaanimal" class="input__search search_raca" placeholder="Digite a raça do bichinho" />
                    </div>
                    <div class="input__container input_porte" data-label="porte">
                        <div class="shadow__input"></div>
                        <input type="text" name="porteanimal" class="input__search search_porte" placeholder="Digite o porte do bichinho" />
                    </div>
                    <div class="input__container input_tutor" data-label="tutor">
                        <div class="shadow__input"></div>
                        <input type="text" name="idadeanimal" class="input__search search_tutor" placeholder="Digite o nome do tutor" />
                    </div>
                    <button type="submit" class="btn btn-confirmaformulario">Cadastrar animal</button>
                    <a href="index.php" class="btn btn-inicio">Voltar para o início</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>