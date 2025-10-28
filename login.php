<?php
session_start();
$host = 'sql213.byetcluster.com';
$dbname = 'if0_40124930_logins';
$user = 'if0_40124930';
$pass = '1540867234';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Erro de conexão: " . $conn->connect_error);

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$username_safe = $conn->real_escape_string($username);

$sql = "SELECT senha FROM usuarios WHERE username = '$username_safe'";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $linha = $resultado->fetch_assoc();
    $hashed_password = $linha['senha'];

    if (password_verify($password, $hashed_password)) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Senha incorreta. <a href='login.html'>Tentar novamente</a>";
    }
} else {
    echo "Usuário não encontrado. <a href='login.html'>Tentar novamente</a>";
}

$conn->close();
?>