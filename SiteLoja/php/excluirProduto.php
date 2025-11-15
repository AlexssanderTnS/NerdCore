<?php
include 'conexao.php';
ob_clean();

$id = $_POST['id'] ?? null;

if (!$id) {
    echo json_encode(["erro" => "ID inválido"]);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM produtos WHERE id = ?");
$ok = $stmt->execute([$id]);

echo json_encode(["sucesso" => $ok]);
