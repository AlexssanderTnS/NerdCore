<?php
session_start();
require 'conexao.php';

// GARANTE LOGIN
if (!isset($_SESSION['usuario_id'])) {
    die("Usuário não logado.");
}

$usuario_id = $_SESSION['usuario_id'];

// RECEBE DADOS DO FORMULÁRIO
$produto_id = isset($_POST['produto_id']) ? intval($_POST['produto_id']) : 0;
$quantidade = isset($_POST['quantidade']) ? intval($_POST['quantidade']) : 1;

// PEGA DADOS DO PRODUTO
$sqlProd = $pdo->prepare("SELECT nomeProduto, preco FROM produtos WHERE produto_id = ?");
$sqlProd->execute([$produto_id]);
$produto = $sqlProd->fetch(PDO::FETCH_ASSOC);

if (!$produto) {
    die("Produto não encontrado.");
}

$produto_nome = $produto['nomeProduto'];
$preco = $produto['preco'];
$total = $preco * $quantidade;

// INSERE COMPRA
$stmt = $pdo->prepare("
    INSERT INTO compra (usuario_id, produto_id, quantidade, total)
    VALUES (?, ?, ?, ?)
");

$stmt->execute([$usuario_id, $produto_id, $quantidade, $total]);

echo "Compra registrada com sucesso!";
?>
