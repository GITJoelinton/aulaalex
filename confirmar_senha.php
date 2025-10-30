<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login_form.php");
    exit;
}

$id_logado = $_SESSION["usuario_id"];
$acao = $_GET['acao'] ?? $_POST['acao'] ?? '';
$mensagem_erro = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['senha_atual'])) {
    $senha_digitada = trim($_POST['senha_atual'] ?? $_POST['password'] ?? "");

    $stmt = $conn->prepare("SELECT senha FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_logado);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $usuario = $resultado->fetch_assoc();

    if ($usuario && password_verify($senha_digitada, $usuario['senha'])) {
        if ($acao == 'editar') {
            header("Location: editar_perfil.php");
            exit;
        } elseif ($acao == 'excluir') {
            header("Location: excluir_conta.php");
            exit;
        }
    } else {
        $mensagem_erro = "Senha incorreta. Tente novamente.";
    }
    $stmt->close();
}

$titulo_acao = ($acao == 'editar') ? 'Mudar Usuário/Senha' : 'Excluir Conta';

if (!in_array($acao, ['editar', 'excluir'])) {
    header("Location: painel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Confirmar Senha</title>
</head>
<body>
  <h1>Confirmar Senha para <?php echo $titulo_acao; ?></h1>
  <p>Insira sua senha atual para prosseguir.</p>

  <?php if ($mensagem_erro): ?>
    <p><?php echo $mensagem_erro; ?></p>
  <?php endif; ?>

  <form method="POST" action="confirmar_senha.php">
    <input type="hidden" name="acao" value="<?php echo htmlspecialchars($acao); ?>">

    <label for="senha_atual">Senha Atual:</label>
    <input type="password" id="senha_atual" name="senha_atual" required>
    <br><br>
    <button type="submit">Continuar</button>
  </form>

  <p><a href="painel.php">Cancelar e Voltar ao Painel</a></p>
</body>
</html>