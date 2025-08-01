<?php
include 'conexao.php';

$cliente_id = $_GET['cliente_id'] ?? 0;

$sql = "SELECT id_animal, nome FROM ficha_animal WHERE id_cliente = ? ORDER BY nome ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cliente_id);
$stmt->execute();

$resultado = $stmt->get_result();

$animais = [];
while($linha = $resultado->fetch_assoc()){
    $animais[] = $linha;
}

$stmt->close();
$conn->close();

// O cabeçalho da resposta vira JSON para o JS compreender
header('Content-Type: application/json');

// Converte o array criado para formato JSON e imprime
echo json_encode($animais);

?>