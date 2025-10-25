<?php
session_start();
$host = 'sql308.byetcluster.com';
$dbname = 'if0_40249420_trabalho';
$user = 'if0_40249420';
$pass = 'joel1240';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Erro de conexão: " . $conn->connect_error);

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username && $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO users (username, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password_hash);
    if ($stmt->execute()) {
        echo "Cadastro realizado! <a href='login.html'>Login</a>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
$conn->close();
?>
