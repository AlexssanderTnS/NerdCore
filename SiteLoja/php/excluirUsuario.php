<?php
require 'conexao.php';
ob_end_clean();
header('Content-Type: application/json; charset=utf-8');

$id = $_POST['user_id'] ?? null;

if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM usuarios WHERE user_id = ?");
        $stmt->execute([$id]);
        echo json_encode(['sucesso' => true]);
    } catch (PDOException $e) {
        echo json_encode(['sucesso' => false, 'erro' => $e->getMessage()]);
    }
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'ID não informado']);
}
