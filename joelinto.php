<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

	 $host = 'sql300.byetcluster.com';
	 $dbname = 'if0_40124646_joelinto';
	$user = 'if0_40124646';
	 $pass = 'joel1240';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
} else {
    echo "Conexão bem-sucedida!";
}
?>
