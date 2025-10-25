<?php
 $host='sql100.byetcluster.com';
	 $dbname='icei_40249526_trabalho';
	$user='icei_40249526';
	 $pass='joel1240';
$conn = new mysqli($host, $user, $pass, $dbname);
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