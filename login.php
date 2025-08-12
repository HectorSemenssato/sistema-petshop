<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles_cadastros.css">
    <title>Login - Petshop</title>

    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f0f2f5;
        }

        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1)
        }
    </style>
</head>

<body>
    <div class="card login-card">
    <div class="card-body">
        <h3 class="card-title text-center mb-4">Acesso ao Sistema</h3>
        <p class="card-subtitle text-center text-muted mb-4">Agendamentos de banho e tosa</p>
        <form action="valida_login.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Digite seu usuário" required>
                <label for="username">Usuário</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="password" name="password" placeholder="Digite sua senha" required>
                <label for="password">Senha</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 mb-3">Fazer login</button>
        </form>
    </div>
    </div>
</body>

</html>