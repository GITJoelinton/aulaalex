<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php
    
    if (isset($_GET['status']) && $_GET['status'] === 'conta_excluida') {
        
        echo "<p>Sua conta foi excluída com sucesso! Para acessar o sistema, você precisa criar uma nova conta.</p><hr>";
    }
    ?>
    
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