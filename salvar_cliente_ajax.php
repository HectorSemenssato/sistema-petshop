<?php
include "conexao.php";
header('Content-Type: application/json');

$nome_cliente = $_POST['nome_cliente'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$email = $_POST['email'] ?? '';

if (empty($nome_cliente)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'O nome do cliente é obrigatório.']);
    exit();
}

$sql = "INSERT into clientes(nome_cliente, telefone, email) VALUES (?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("sss", $nome_cliente, $telefone, $email);

    if ($stmt->execute()) {
        $novo_id = $conn->insert_id;

        echo json_encode([
            'sucesso' => true,
            'id_cliente' => $novo_id,
            'nome_cliente' => $nome_cliente
        ]);
    }
    $stmt->close();
} else {
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro durante a preparação para o envio ao banco'
    ]);
}


$conn->close();
