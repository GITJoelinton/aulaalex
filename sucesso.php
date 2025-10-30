<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área Restrita</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION["usuario_nome"]); ?>!</h1>
    <p>Você está logado no sistema.</p>
    <a href="logout.php">Sair</a>
</body>
</html>
