<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}

$host = 'sql213.byetcluster.com';
$dbname = 'if0_40124930_logins';
$user = 'if0_40124930';
$pass = '1540867234';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) die("Erro de conexão: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($id) || empty($username) || empty($password)) {
        echo "Todos os campos são obrigatórios.";
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE usuarios SET username = ?, senha = ? WHERE id = ?");
    $stmt->bind_param("ssi", $username, $password_hash, $id);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
    
            if ($_SESSION['username'] === $username) {
                $_SESSION['username'] = $username;
            }
            echo "Usuário atualizado com sucesso! <a href='dashboard.php'>Voltar</a>";
        } else {
            echo "ID não encontrado.";
        }
    } else {
        echo "Erro: " . $conn->error;
    }
    $stmt->close();
}
$conn->close();
?>