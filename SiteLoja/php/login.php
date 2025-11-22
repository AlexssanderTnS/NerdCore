<?php
ob_start();
session_start();
require 'conexao.php';
ob_end_clean();


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
        $_SESSION['usuario_id'] = $dados_usuario['user_id'];
        $_SESSION['usuario_nome'] = $dados_usuario['usuario'];
        $_SESSION['usuario_acesso'] = $dados_usuario['acesso'];

        echo "sucesso";
        
}
else{
    echo"erroSenha";
}}else{
    echo"erroUsuario";
}}else{
    echo"campos_vazios";
}
exit;
}

function logado() {
    return isset($_SESSION['usuario_id']);
}

function nivelAcesso() {
    return $_SESSION['usuario_acesso'] ?? 0;
}

function exigeAcesso($nivelMinimo) {
    if (!logado()) {
        echo'<script type="text/javascript">
            
            window.location.href = "login.php";
          </script>';
        
        exit;
    }
    if (nivelAcesso() < $nivelMinimo) {
        echo "Você não tem permissão";
        exit;
    }
}
?>