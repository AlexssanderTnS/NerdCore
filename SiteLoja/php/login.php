<?php
session_start();
require 'conexao.php';



//Verifica se está enviando pelo método POST
if ($_SERVER['REQUEST_METHOD'] === "POST"){
$usuario = $_POST['usuario'] ?? '';
$senha = $_POST['senha'] ?? '';


if (!empty($usuario) && !empty($senha)){
    $sql = "SELECT * FROM usuarios WHERE usuario = :usuario";
    $stmt = $pdo->prepare($sql);
    $stmt-> bindValue(':usuario', $usuario);
    $stmt-> execute();
    $dados_usuario = $stmt->fetch(PDO::FETCH_ASSOC);
#compara se existe 1 usuario com o nome inserido

 if ($dados_usuario){

    if(password_verify($senha,$dados_usuario["senha"])){
        $_SESSION['usuario_id'] = $dados_usuario['id'];
        $_SESSION['usuario_nome'] = $dados_usuario['usuario'];
        $_SESSION['usuario_acesso'] = $dados_usuario['acesso'];

        header("Location: ../../index.php");
        exit;
}
else{
    header("Location: ../pages/login.php");
}}else{
    header("Location: ../pages/login.php");
}}else{
    header("Location: ../pages/login.php");
}}



?>