<?php
ob_start();
include 'conexao.php';
ob_end_clean();

try {
    $stmt = $pdo->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produtos as &$produto) {
        // Normaliza o caminho da imagem
        $caminho = basename($produto['imagem']); // pega só o nome do arquivo
        $produto['imagem'] = "../produtos/CP/" . $caminho;
    }

    echo json_encode($produtos);
} catch (PDOException $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}
?>
