<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

   
    <?php if (isset($_GET['status']) && $_GET['status'] === 'conta_excluida'): ?>
        <div class="alerta sucesso">
            Sua conta foi excluída com sucesso! 
            <br>Sinto muito, mas será necessário criar outra.
        </div>
    <?php endif; ?>


    
    <?php
    session_start();
    if (!empty($_SESSION["erro_login"])): ?>
        <div class="alerta erro">
            <?= $_SESSION["erro_login"]; ?>
        </div>
        <?php unset($_SESSION["erro_login"]); ?>
    <?php endif; ?>


    <h1>Entrar</h1>

    <form action="login.php" method="post">

        <label>Usuário:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="senha" required><br><br>

        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="cadastro.html">Criar conta</a></p>

</div>

</body>
</html>
