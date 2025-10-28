<?php
$host = 'sql213.byetcluster.com';
$dbname = 'if0_40124930_logins';
$user = 'if0_40124930';
$pass = '1540867234';

$conn = new mysqli($host, $user, $pass, $dbname);
{if ($conn->connect_error) die("Erro de conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $novoUsuario = $_POST['Nome'] ?? '';
    $novaSenha = $_POST['Senha'] ?? '';
    if (empty($novoUsuario) || empty($novaSenha)) {
        echo "Nome de usuário e senha não podem estar vazios.";
        exit();
    }

    $sql = "UPDATE users
    SET username='$novoUsuario' , senha='$novaSenha'
    WHERE id=$id";
    

   if ($conn->query($sql) === TRUE) {
        echo "Usuario e senha atualizados com sucesso. <a href='login.html'>Voltar ao login</a>";
    } else {
        echo "Erro ao atualizar registro: " . $conn->error;
    }
}
$conn->close();
?>

    
