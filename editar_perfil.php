<?php
session_start();
require_once "conexao.php";

if (!isset($_SESSION["usuario_id"])) {
    header("Location: login.html");
    exit;
}

$id_logado = $_SESSION["usuario_id"];
$mensagem = '';
$usuario_atual = htmlspecialchars($_SESSION["usuario_nome"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $novo_username = trim($_POST["novo_username"]);
    $nova_senha = trim($_POST["nova_senha"]);
    $confirma_senha = trim($_POST["confirma_senha"]);
    $tem_mudanca = false;

    if (!empty($nova_senha) && $nova_senha !== $confirma_senha) {
        $mensagem = "<p style='color: red;'>Erro: A nova senha e a confirmação não coincidem.</p>";
    } else {
        $sql_parts = [];
        $bind_types = "";
        $bind_params = [];

     
        if ($novo_username !== $_SESSION["usuario_nome"] && !empty($novo_username)) {
           
            $check = $conn->prepare("SELECT id FROM usuarios WHERE username = ? AND id != ?");
            $check->bind_param("si", $novo_username, $id_logado);
            $check->execute();
            if ($check->get_result()->num_rows > 0) {
                 $mensagem = "<p style='color: red;'>Erro: Usuário '$novo_username' já existe.</p>";
            } else {
                $sql_parts[] = "username = ?";
                $bind_types .= "s";
                $bind_params[] = $novo_username;
                $tem_mudanca = true;
            }
        }
        
        
        if (empty($mensagem) && !empty($nova_senha)) {
            $hash = password_hash($nova_senha, PASSWORD_DEFAULT);
            $sql_parts[] = "senha = ?";
            $bind_types .= "s";
            $bind_params[] = $hash;
            $tem_mudanca = true;
        }

        
        if (empty($mensagem) && $tem_mudanca) {
            $sql = "UPDATE usuarios SET " . implode(", ", $sql_parts) . " WHERE id = ?";
            $bind_types .= "i";
            $bind_params[] = $id_logado;

            $stmt = $conn->prepare($sql);
            $stmt->bind_param($bind_types, ...$bind_params);
            
            if ($stmt->execute()) {
                $mensagem = "<p style='color: green;'>Perfil atualizado com sucesso!</p>";
                
                if (in_array("username = ?", $sql_parts)) {
                    $_SESSION["usuario_nome"] = $novo_username;
                    $usuario_atual = htmlspecialchars($novo_username);
                }
            } else {
                $mensagem = "<p style='color: red;'>Erro ao atualizar perfil.</p>";
            }
            $stmt->close();
        } elseif (!$tem_mudanca) {
            $mensagem = "<p>Nenhuma alteração para salvar.</p>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
</head>
<body>
    <h1>Editar Perfil</h1>
    
    <?php echo $mensagem; ?>

    <form method="POST" action="editar_perfil.php">
        <h3>Mudar Nome de Usuário</h3>
        <label for="novo_username">Novo Usuário (Atual: <?php echo $usuario_atual; ?>):</label><br>
        <input type="text" id="novo_username" name="novo_username" value="<?php echo $usuario_atual; ?>" required><br>
        <small>Mantenha o mesmo valor para não alterar.</small>

        <hr>
        
        <h3>Mudar Senha</h3>
        <label for="nova_senha">Nova Senha:</label><br>
        <input type="password" id="nova_senha" name="nova_senha"><br><br>

        <label for="confirma_senha">Confirmar Nova Senha:</label><br>
        <input type="password" id="confirma_senha" name="confirma_senha"><br>
        <small>Deixe os campos de senha vazios para manter a senha atual.</small>

        <hr>
        <button type="submit">Salvar Alterações</button>
    </form>
    
    <p><a href="painel.php">Voltar ao Painel</a></p>
</body>
</html>