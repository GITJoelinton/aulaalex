<?php
error_reporting(
E_ALL);
ini_set('display_errors', 1);
$host = 'sql100.byetcluster.com';
$dbname = 'icei_40249526_trabalho';
$user = 'icei_40249526';
$pass = 'joel1240';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Erro de conexão: " . $conn->connect_error);

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$stmt = $conn->prepare("SELECT senha FROM users WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
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

$stmt->close();
$conn->close();
?>
