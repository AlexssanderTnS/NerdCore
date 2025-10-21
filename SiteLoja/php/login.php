<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){
include 'conexao.php';

$usuario = $_POST['usuario']; ?? '';
$senha = $_POST['senha']; ?? '';

try{
    //Prepara o query para buscar o usuário pelo login
    $stmt = $pdo -> prepare("SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1");
    $stmt -> execute(['usuario' => $usuario]);

    $user = $stmt -> fetch (PDO::FETCH_ASSOC);

    if ($user){
        if(password_verify($senha, $user['senha'])){
            session_start();
            $_SESSION['usuario'] = $user['usuario'];
        }else{
            echo "Senha incorreta.";
        }else{
            echo "Usuário não encontrado.";
        }
        }
    }catch(PDOException $e){
        echo "Erro no login: " . $e->getMessage();
    }
}





?>

