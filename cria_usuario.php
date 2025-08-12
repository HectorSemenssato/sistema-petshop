<?php
include "conexao.php";

$username = "admin"; // Defina o nome de usuário
$plain_password = "senhaforte123"; // Defina a senha

// Criptografa a senha
$hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

// Insere no banco de dados
$sql = "INSERT INTO usuarios (nome_usuario, senha_usuario) VALUES (?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("ss", $username, $hashed_password);
    if ($stmt->execute()) {
        echo "Usuário '$username' criado com sucesso!";
    } else {
        echo "Erro ao criar usuário: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
