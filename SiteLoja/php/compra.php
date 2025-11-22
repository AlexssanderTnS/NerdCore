<?php
session_start();
require 'conexao.php'; // sua conexão PDO ou MySQL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioId   = $_SESSION['usuario_id'] ?? null;
    $produtoId   = $_POST['nomeProduto'] ?? null;
    $quantidade  = $_POST['quantidade'] ?? 1;
    $dataCompra  = date('Y-m-d H:i:s');

    if (!$usuarioId) {
        // Se não tiver ID de usuário na sessão, não faz a compra
        die("Usuário não identificado.");
    }

    $sql = "INSERT INTO compras (user_id, nomeProduto, quantidade, data_compra)
            VALUES (:user_id, :produto_id, :quantidade, :data_compra)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':user_id'     => $usuarioId,
        ':produto_id'  => $produtoId,
        ':quantidade'  => $quantidade,
        ':data_compra' => $dataCompra,
    ]);

    if ($stmt->rowCount() > 0) {
        echo "Compra registrada com sucesso!";
    } else {
        echo "Erro ao registrar a compra.";
    }
}

?>