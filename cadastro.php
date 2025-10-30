<?php
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $senha = trim($_POST["senha"] ?? $_POST["password"] ?? "");

    if (empty($username)) {
        die("O campo Usuário está vazio.");
    }
    if (empty($senha)) {
        die("O campo Senha está vazio.");
    }
    
    $check = $conn->prepare("SELECT * FROM usuarios WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        die("Usuário já existe. <a href='login_form.php'>Fazer login</a>");
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (username, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hash);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        session_start();
        $_SESSION["usuario_id"] = $stmt->insert_id;
        $_SESSION["usuario_nome"] = $username;
        header("Location: painel.php");
        exit;
    } else {
        echo "Erro ao cadastrar usuário.";
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: cadastro.html");
    exit;
}
?>