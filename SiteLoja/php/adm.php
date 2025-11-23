<?php
require 'conexao.php';
header('Content-Type: application/json; charset=utf-8');

try {
    // Ordena por data_cadastro decrescente
    $sql = "SELECT user_id, nome, email, usuario, cpf, data_cadastro 
            FROM usuarios
            ORDER BY data_cadastro DESC";
    $stmt = $pdo->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($usuarios);
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}


?>


