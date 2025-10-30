<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $senha = trim($_POST["senha"] ?? $_POST["password"] ?? "");

    if (empty($username) || empty($senha)) {
        die("Preencha todos os campos!");
    }

    $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($senha, $user["senha"])) {
            $_SESSION["usuario_id"] = $user["id"];
            $_SESSION["usuario_nome"] = $username;

            header("Location: sucesso.php");
            exit;
        } else {
            die("Senha incorreta. <a href='login.html'>Tentar novamente</a>");
        }
    } else {
        die("Usuário não encontrado. <a href='cadastro.html'>Criar conta</a>");
    }
} else {
    header("Location: login.html");
    exit;
}
?>