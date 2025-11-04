<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login_form.php?erro=" . urlencode("Faça login para acessar a lista de usuários."));
    exit;
}

$id_logado = $_SESSION["usuario_id"];


$stmt = $conn->prepare("SELECT id, username, senha FROM usuarios ORDER BY id ASC");
$stmt->execute();
$resultado = $stmt->get_result();
$usuarios = $resultado->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários - Didático</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Usuários Cadastrados</h1>
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION["usuario_nome"]); ?>!</p>
        <p class="mensagem erro">Aviso:A lista de usuarios e somente para trabalhos de estudo jamais faça isso mesmo que os dados estejam criptografados.</p>
        <a href="painel.php">Voltar ao Painel</a>
        <hr>

        <?php if (empty($usuarios)): ?>
            <p class="mensagem">Nenhum usuário cadastrado no momento.</p>
        <?php else: ?>
            <table class="tabela">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome de Usuário</th>
                        <th>Senha (Hasheada)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo htmlspecialchars($usuario['username']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['senha']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>