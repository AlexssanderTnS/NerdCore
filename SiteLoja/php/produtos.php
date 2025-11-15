<?php
ob_start();
include 'conexao.php';
ob_end_clean();

try {
    $stmt = $pdo->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produtos as &$produto) {
        // Cria UM campo final - imagem
        $produto['imagem'] = "../" . $produto['camisaPreta'];
    }

    echo json_encode($produtos);
} catch (PDOException $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}
?>
