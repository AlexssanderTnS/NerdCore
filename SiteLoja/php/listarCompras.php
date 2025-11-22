<?php
require 'conexao.php';

// CONSULTA COMPLETA
$sql = $pdo->prepare("
    SELECT 
        c.id,
        u.nome AS usuario_nome,
        p.nomeProduto AS produto_nome,
        c.quantidade,
        c.total,
        c.data_compra
    FROM compra c
    INNER JOIN usuarios u ON c.usuario_id = u.user_id
    INNER JOIN produtos p ON c.produto_id = p.produto_id
    ORDER BY c.data_compra DESC
");

$sql->execute();

// RETORNA JSON
echo json_encode($sql->fetchAll(PDO::FETCH_ASSOC));
?>
