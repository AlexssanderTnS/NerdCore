<?php
session_start();
include 'conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql_banco = "SELECT * FROM usuarios WHERE usuario = :usuario AND senha = :senha AND ativo =1";
    $stmt = $pdo->prepare($sql_banco);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':senha', $senha);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        //salvar os dados na sessão
        $_SESSION['id'] = $user['id'];
        $_SESSION['nome'] = $user['nome'];
        $_SESSION['nivel_acesso'] = $user['nivel_acesso'];
        //redirecionar com o nivel de acesso
        if ($user['nivel_acesso'] === 'admin') {
            header('Location: ../pages/adm.html');
            exit;
        } else {
            header('Location: ../index.html');
            exit;
        }
    } else {
        echo "<script>alert('Usuário ou senha incorretos!');window.location.href='../pages/login.html';</script>";
    }
}
