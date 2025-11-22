<?php
require 'conexao.php';
ob_end_clean();

header('Content-Type: application/json; charset=utf-8');

try {
    $sql = "SELECT user_id, nome, email, usuario, acesso, data_cadastro FROM usuarios";
    $stmt = $pdo->query($sql);
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($usuarios);
} catch (PDOException $e) {
    echo json_encode(['erro' => $e->getMessage()]);
}

?>


