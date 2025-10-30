<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.html");
    exit;
}


$id_logado = $_SESSION["usuario_id"];
$stmt = $conn->prepare("SELECT id, username FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id_logado);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Painel</title>
</head>
<body>
  <h1>Painel do Usuário</h1>
  <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION["usuario_nome"]); ?>!</p>
  <a href="logout.php">Sair</a>
  <hr>

  <h2>Minha Conta</h2>
  <p>ID: <?php echo $usuario['id']; ?></p>
  <p>Usuário: <?php echo htmlspecialchars($usuario['username']); ?></p>

  <h3>Ações de Segurança</h3>
  <ul>
    <li>
        <a href='confirmar_senha.php?acao=editar'>Mudar Usuário e/ou Senha</a>
    </li>
    <li>
        <a href='confirmar_senha.php?acao=excluir'>Excluir Minha Conta</a>
    </li>
  </ul>

</body>
</html>