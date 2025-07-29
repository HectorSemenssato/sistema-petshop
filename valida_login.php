<?php
session_start();

include "conexao.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];


    if (empty($username) || empty($password)) {
        die("usuário não encontrado");
    }

    $sql = "select id_usuario, nome_usuario, senha_usuario FROM usuarios WHERE nome_usuario = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['senha_usuario'])) {
                $_SESSION['user_id'] = $user['id_usuario'];
                $_SESSION['username'] = $user['nome_usuario'];

                unset($_SESSION['login_error']);

                header("Location: index.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Usuário ou senha inválidos.";
                header("Location: login.php");
                exit();
            }
            $stmt->close();
        }
        $conn->close();
    }else{
        header("Location: login.php");
        exit();
    }
}
