<?php
ob_start();
include 'conexao.php';
ob_end_clean();
header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($produtos);

} catch (PDOException $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}
?>
