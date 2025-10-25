<?php
session_start();
$host = 'sql100.byetcluster.com';
$dbname = 'icei_40249526_trabalho';
$user = 'icei_40249526';
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
