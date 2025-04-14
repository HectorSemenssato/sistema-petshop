<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cadastro de animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles_cadastros.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <H1>Cadastro de animal</H1>
                <form action="cadastrar_toDB.php">
                    <div class="input__container input_nomeanimal" data-label="nome do animal">
                        <div class="shadow__input"></div>
                        <button class="input__button__shadow">
                            <p>🐾</p>
                        </button>
                        <input
                            type="text"
                            name="nomeanimal"
                            class="input__search search_nomeanimal"
                            placeholder="Digite o nome do bichinho" />
                    </div>
                    <div class="input__container input_idade" data-label="idade">
                        <div class="shadow__input"></div>
                        <input
                            type="text"
                            name="idadeanimal"
                            class="input__search search_idade"
                            placeholder="Digite a idade do bichinho" />
                    </div>
                    <div class="input__container input_raca" data-label="raça">
                        <div class="shadow__input"></div>
                        <input
                            type="text"
                            name="racaanimal"
                            class="input__search search_raca"
                            placeholder="Digite a raça do bichinho" />
                    </div>
                    <div class="input__container input_porte" data-label="porte">
                        <div class="shadow__input"></div>
                        <input
                            type="text"
                            name="porteanimal"
                            class="input__search search_porte"
                            placeholder="Digite o porte do bichinho" />
                    </div>
                    <div class="input__container input_tutor" data-label="tutor">
                        <div class="shadow__input"></div>
                        <input
                            type="text"
                            name="idadeanimal"
                            class="input__search search_tutor"
                            placeholder="Digite o nome do tutor" />
                    </div>
                    <!-- <div class="mb-3">
                        <label for="lb_nomeanimal" class="form-label">Nome do animal:</label>
                        <input type="text" class="form-control" name="nomeanimal" required>
                    </div>
                    <div class="mb-3">
                        <label for="lb_idadeanimal" class="form-label">Idade:</label>
                        <input type="text" class="form-control" name="idadeanimal" required>
                    </div>
                    <div class="mb-3">
                        <label for="lb_raca">Raça:</label>
                        <input type="text" class="form-control" name="raca" required>
                    </div>
                    <div class="mb-3">
                        <label for="lb_porte">Porte:</label>
                        <input type="text" class="form-control" name="porte" required>
                    </div>
                    <div class="mb-3">
                        <label for="lb_tutor">Tutor:</label>
                        <input type="text" class="form-control" name="tutor" required>
                    </div> -->
                    <button type="submit" class="btn btn-success">Cadastrar animal</button>
                    <a href="index.php" class="btn btn-info">Voltar para o início</a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>