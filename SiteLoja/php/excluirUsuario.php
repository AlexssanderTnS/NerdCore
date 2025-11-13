<?php
require 'conexao.php';
header('Content-Type: application/json; charset=utf-8');

$id = $_POST['id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['sucesso' => true]);
    } catch (PDOException $e) {
        echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
    }
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'ID não informado']);
}
