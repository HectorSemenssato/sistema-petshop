<?php
session_start();
include "conexao.php";
include 'protege_pagina.php';

$idfuncionario = $_GET['funcionario_agendamento'] ?? '';
$idanimal = $_GET['idanimal_agendamento'] ?? '';
$idcliente = $_GET['nomecliente_agendamento'] ?? '';
$data_agendamento = $_GET['data_agendamento'] ?? '';
$hora_agendamento = $_GET['hora_agendamento'] ?? '';

$sql = "INSERT into `agendamento`(`id_funcionario`, `id_animal`, `data_agendamento`, `hora_agendamento`, `id_cliente`) 
                      VALUES (?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("iissi", $idfuncionario, $idanimal, $data_agendamento, $hora_agendamento, $idcliente);

  if ($stmt->execute()) {
    $novo_id = $conn->insert_id;

    $_SESSION['notificacao'] = [
      'tipo' => 'success',
      'title' => 'Tudo ok!',
      'texto' => 'Agendamento feito'
    ];
  } else {
    $_SESSION['notificacao'] = [
      'tipo' => 'error',
      'title' => 'Hum... Não foi dessa vez!',
      'texto' => 'Erro no cadastro do agendamento'
    ];
  }
  $stmt->close();
  $conn->close();
  header('Location: consultar.php');
  exit();
}
