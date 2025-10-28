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

if ($username && $password) {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO usuarios (username, senha) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $password_hash);
    if ($stmt->execute()) {
        echo "Cadastro realizado! <a href='login.html'>Login</a>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
$conn->close();
?>