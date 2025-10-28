<?php
$host = 'sql308.byetcluster.com';
$dbname = 'if0_40249420_trabalho';
$user = 'if0_40249420';
$pass = 'joel1240';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';

    if (empty($id)) {
        echo "ID inválido.";
    } else {
        $sql = "DELETE FROM users WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {
            echo "Usuário excluído com sucesso.";
        } else {
            echo "Erro ao excluir usuário: " . $conn->error;
        }
    }
}

$conn->close();
?>
