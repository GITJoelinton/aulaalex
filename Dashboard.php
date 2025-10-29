<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <h2>Opções:</h2>
    <ul>
        <li><a href="atualizar.html">Atualizar usuário e senha</a></li>
        <li><a href="deletar.html">Deletar conta</a></li>
        <li><a href="desconectar.php">Sair</a></li>
    </ul>
</body>
</html>