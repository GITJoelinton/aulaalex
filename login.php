<?php
 $host = 'sql300.byetcluster.com';
	 $dbname = 'if0_40124646_joelinto';
	$user = 'if0_40124646';
	 $pass = 'joel1240';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("erro de conexão: " . $conn->connect_error);
}

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['username'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$usuario' AND senha='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $usuario;
        header("Location: dashboard.php");
        exit();
       
    } else {
        echo "Usuário ou senha incorretos. <a href='login.html'>Tentar novamente</a>";
    }
};

$conn->close();
?>