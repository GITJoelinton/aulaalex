<?php
session_start();
require_once "conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

 
    $username = trim($_POST["username"] ?? "");
    $senha = trim($_POST["senha"] ?? $_POST["password"] ?? "");

   
    if (empty($username) || empty($senha)) {
        $_SESSION["erro_login"] = "Preencha todos os campos.";
        header("Location: login_form.php");
        exit;
    }

    
    $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

   
    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        
        if (password_verify($senha, $usuario["senha"])) {

            
            $_SESSION["usuario_id"] = $usuario["id"];
            $_SESSION["usuario_nome"] = $username;

            header("Location: painel.php");
            exit;
        } else {
           
            $_SESSION["erro_login"] = "Senha incorreta.";
            header("Location: login_form.php");
            exit;
        }

    } else {
        
        $_SESSION["erro_login"] = "Usuário não encontrado.";
        header("Location: login_form.php");
        exit;
    }

} else {
    header("Location: login_form.php");
    exit;
}
?>
