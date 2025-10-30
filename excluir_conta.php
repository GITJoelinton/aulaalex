<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.html");
    exit;
}

$id_logado = $_SESSION["usuario_id"];

$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id_logado);

if ($stmt->execute()) {
 
    session_unset();
    session_destroy();

    header("Location: login.html?status=conta_excluida");
    exit;
} else {
  
    die("Erro ao excluir a conta. Tente novamente mais tarde.");
}
?>