<?php
 $host = 'sql300.byetcluster.com';
	 $dbname = 'if0_40124646_joelinto';
	$user = 'if0_40124646';
	 $pass = 'joel1240';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("erro de conexão: " . $conn->connect_error);
}
$usuario = $_POST['username'];
$senha = $_POST['password'];
$sql = "INSERT INTO users (username, senha) VALUES ('$usuario','$senha')";
if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso! <a href='login.html'>Fazer login</a>";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
$conn->close();
?>