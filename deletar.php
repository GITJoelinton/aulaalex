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
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        echo "Usuário e senha são obrigatórios para exclusão.";
        exit();
    }

    $username_safe = $conn->real_escape_string($username);
    $sql_select = "SELECT id, senha FROM usuarios WHERE username = '$username_safe'";
    $resultado = $conn->query($sql_select);

    if ($resultado && $resultado->num_rows > 0) {
        $linha = $resultado->fetch_assoc();
        $user_id = $linha['id'];
        $hashed_password = $linha['senha'];

        if (password_verify($password, $hashed_password)) {
            
            $sql_delete = "DELETE FROM usuarios WHERE id=$user_id";
            if ($conn->query($sql_delete) === TRUE) {
                echo "Usuário excluído com sucesso.";
            } else {
                echo "Erro ao excluir usuário: " . $conn->error;
            }
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}

$conn->close();
?>