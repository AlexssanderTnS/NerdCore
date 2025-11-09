<?php
ob_start();
require('conexao.php'); // aqui o $conexao deve ser seu objeto PDO
ob_end_clean();
$nome = $_POST['nomeProduto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$imagem1 = $_FILES['imagem1'];
$imagem2 = $_FILES['imagem2'];

// função que converte a imagem pra base64
function convertIMG($arquivoTemporario) {
    $tipo = mime_content_type($arquivoTemporario);
    $dados = file_get_contents($arquivoTemporario);
    return "data:" . $tipo . ";base64," . base64_encode($dados);
}

$img1 = convertIMG($imagem1['tmp_name']);
$img2 = convertIMG($imagem2['tmp_name']);

$sql = "INSERT INTO produtos (
            nomeProduto,
            descricao,
            preco,
            camisaPreta,
            camisaBranca
        ) VALUES (
            :nomeProduto,
            :descricao,
            :preco,
            :camisaPreta,
            :camisaBranca
        )";

$stmt = $pdo->prepare($sql);

if ($stmt->execute([
    ':nomeProduto' => $nome,
    ':descricao' => $descricao,
    ':preco' => $preco,
    ':camisaPreta' => $img1,
    ':camisaBranca' => $img2
])) {
    echo "Produto cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar produto!";
}

header("Location: ../pages/adm.php")
?>
