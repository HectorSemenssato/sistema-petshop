<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="styles_cadastros.css">
    <title>Login - Petshop</title>
</head>

<body>
    <div id="saudacao">
        <h5>Sistema de petshop para agendamentos de banho e tosa </h5>
    </div>
    <div id="container">
        <form action="valida_login.php">
            <div class="container__login">
                <div class="input_login" data-label="usuário">
                    <input type="text" name="username" class="input__search user" placeholder="Digite o seu usuário" />
                </div>
                <div class="input_pass" data-label="senha">
                    <input type="text" name="password" class="input__search pass" placeholder="Digite a sua senha" />
                </div>
            </div>
            <button type="submit" class="btn btn_login">fazer login</button>
            <a href="index.php" class="btn btn_inicio">Voltar para o início</a>
        </form>
</body>

</html>