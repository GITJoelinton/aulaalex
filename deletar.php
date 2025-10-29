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
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "Usuário e senha são obrigatórios. <a href='deletar.html'>Tentar novamente</a>";
        exit();
    }

    $stmt = $conn->prepare("SELECT id, senha FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        $hashed_password = $row['senha'];

        if (password_verify($password, $hashed_password)) {
            $delete_stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
            $delete_stmt->bind_param("i", $user_id);
            if ($delete_stmt->execute()) {
                session_destroy();
                echo "<h2>Conta excluída com sucesso!</h2>";
                echo "<p><a href='login.html'>Voltar ao login</a></p>";
            } else {
                echo "Erro ao excluir: " . $conn->error;
            }
            $delete_stmt->close();
        } else {
            echo "Senha incorreta. <a href='deletar.html'>Tentar novamente</a>";
        }
    } else {
        echo "Usuário não encontrado. <a href='deletar.html'>Tentar novamente</a>";
    }
    $stmt->close();
}
$conn->close();
?>