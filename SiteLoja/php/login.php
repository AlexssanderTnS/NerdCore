<?php
//require_once 'conexao.php';

$nome = $_POST['nome'] ?? 'Erro: Campo nome não enviado';
$usuario = $_POST['usuario'] ?? 'Erro: Campo usuário não enviado';

echo "Nome: $nome <br> Usuário: $usuario";
?>