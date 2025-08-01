<?php
session_start();
include 'conexao.php';
include 'protege_pagina.php';

$idagendamento = $_GET['id'];

$sql = "DELETE from `agendamento` WHERE `id_agendamento` = ?";

if ($stmt = $conn->prepare($sql)) {
  $stmt->bind_param("i", $idagendamento);

  if ($stmt->execute() == true) {
    $_SESSION['mensagem_sucesso'] = "Exclusão feita com sucesso!";
  } else {
    $_SESSION['mensagem_falha'] = "Não foi possível excluir este agendamento.";
  }
  $stmt->close();
  $conn->close();
  header('Location: consultar.php');
  exit();
}
