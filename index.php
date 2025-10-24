<?php
$conn = new mysqli('sql213.byetcluster.com', 'if0_40124930', '1540867234', 'if0_40124930_logins');
if ($conn->connect_error) {
    die("erro de conexão: " . $conn->connect_error);
}
$usuario = $_POST['username'];
$senha = $_POST['password'];
$sql = "INSERT INTO users (username, senha) VALUES ('$usuario','$senha')";
if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso! <a href=login.html'> Fazer login</a>";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
$conn->close();
?>