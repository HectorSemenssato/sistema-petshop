<?php
session_start();
include 'conexao.php';
include 'protege_pagina.php';

$idagendamento = $_GET['id'];

$sql = "DELETE from `agendamento` WHERE `id_agendamento` = ?";

if ($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("i", $idagendamento);

  if ($stmt->execute() == true) {
    $_SESSION['notificacao'] = [
      'tipo' => 'success',
      'title' => 'Tudo ok!',
      'texto' => 'Agendamento excluído com sucesso'
    ];
  } else {
    $_SESSION['notificacao'] = [
      'tipo' => 'error',
      'title' => 'Hum... Não foi dessa vez!',
      'texto' => 'Erro na exclusão do agendamento'
    ];
  }
  $stmt->close();
  $conn->close();
  header('Location: consultar.php');
  exit();
}
