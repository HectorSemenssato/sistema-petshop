<?php
include "conexao.php";
header('Content-Type: application/json');

$nome_animal = $_POST['nome_animal'] ?? '';
$idade = $_POST['idade'] ?? '';
$raca = $_POST['raca'] ?? '';
$porte = $_POST['porte'] ?? '';
$id_cliente = $_POST['id_cliente'] ?? 0;

if(empty($nome_animal) || empty($id_cliente)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'A variavel de nome do animal ou o id do cliente esta vazia.']);
    exit();
}

$sql = "INSERT into ficha_animal(nome, idade, raca, porte, id_cliente) VALUES (?, ?, ?, ?, ?);";

if($stmt = $conn->prepare($sql)){
    $stmt->bind_param("sissi", $nome_animal, $idade, $raca, $porte, $id_cliente);

    if($stmt->execute()){
        $novo_id = $conn->insert_id;

        echo json_encode([
            'sucesso' => true,
            'id_animal' => $novo_id,
            'nome_animal' => $nome_animal
        ]);
    } else {
        echo json_encode(['sucesso' => false, 'mensagem' => 'Erro ao salvar o animal.']);
    }
    $stmt->close();

}else{
    echo json_encode([
        'sucesso' => false,
        'mensagem' => 'Erro durante a preparação para o envio ao banco.'
    ]);
}

$conn->close();