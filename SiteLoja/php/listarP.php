
<?php
ob_start();
include 'conexao.php';
ob_end_clean();
header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT * FROM produtos");
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($produtos as &$produto) {

        // Normaliza a imagem preta
        if (!empty($produto['camisaPreta'])) {
            $arquivoPreto = basename($produto['camisaPreta']);
            $produto['camisaPreta'] = "../produtos/CP/" . $arquivoPreto;
        }

        // Normaliza a imagem branca (se quiser usar depois)
        if (!empty($produto['camisaBranca'])) {
            $arquivoBranco = basename($produto['camisaBranca']);
            $produto['camisaBranca'] = "../produtos/CB/" . $arquivoBranco;
        }
    }

    echo json_encode($produtos);

} catch (PDOException $e) {
    echo json_encode(["erro" => $e->getMessage()]);
}
?>
