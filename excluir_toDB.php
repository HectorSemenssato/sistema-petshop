<?php
session_start();
include 'conexao.php';
include 'protege_pagina.php';

$idagendamento = $_GET['id'];

$sql = "UPDATE `agendamento` SET `status_agendamento` = 3 WHERE `id_agendamento` = ?";

if ($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("i", $idagendamento);

  if ($stmt->execute() == true) {
    $_SESSION['notificacao'] = [
      'tipo' => 'success',
      'title' => 'Tudo ok!',
      'texto' => 'Agendamento cancelado com sucesso'
    ];
  } else {
    $_SESSION['notificacao'] = [
      'tipo' => 'error',
      'title' => 'Hum... Não foi dessa vez!',
      'texto' => 'Erro no cancelamento do agendamento'
    ];
  }
  $stmt->close();
  $conn->close();
  header('Location: consultar.php');
  exit();
}
