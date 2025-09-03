<?php
include 'conexao.php';
header('Content-Type: application/json');

$idagendamento = $_GET['id'] ?? 0;

if($idagendamento == 0){
    echo json_encode(['sucesso' => false, 'mensagem' => 'ID de agendamento nao foi localizado']);
    exit();
}

$sql_agendamento = "SELECT a.id_agendamento, c.id_cliente, fa.id_animal, f.id_funcionario, a.data_agendamento, a.hora_agendamento
                    FROM agendamento a JOIN funcionario f ON a.id_funcionario = f.id_funcionario
                                       JOIN clientes c ON a.id_cliente = c.id_cliente
                                       JOIN ficha_animal fa ON a.id_animal = fa.id_animal
                    WHERE a.id_agendamento = ?";

if ($stmt = $conn->prepare($sql_agendamento)) {
    $stmt->bind_param("i", $idagendamento);
    $stmt->execute();
    $resultado = $stmt->get_result();
    if ($resultado->num_rows === 1) {
        $agendamento = $resultado->fetch_assoc();
        echo json_encode(['sucesso' => true, 'dados' => $agendamento]);
    } else {
       echo json_encode(['sucesso' => false, 'mensagem' => 'Agendamento nao foi encontrado.']);
    }
    $stmt->close();
}else{
    echo json_encode(['sucesso' => false, 'mensagem' => 'Erro na preparacao da consulta.']);
}
$conn->close();
