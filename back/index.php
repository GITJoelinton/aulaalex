<?php
session_start();
if (!isset($_SESSION['user_id'])) {
   header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
  <link rel="stylesheet" href="styles2.css">
</head>
<body>
    <h1>Bem-vindo ao Dashboard</h1>
    <p>Você está logado com sucesso!</p>
</body>
</html>

