<?php
ob_start();
require('conexao.php'); // precisa ter $pdo aqui dentro
ob_end_clean();

$nome = $_POST['nomeProduto'];
$descricao = $_POST['descricao'];
$preco = $_POST['preco'];
$categoria = $_POST['categoria'];

$imagem1 = $_FILES['imagem1'];
$imagem2 = $_FILES['imagem2'];

// função pra converter imagem pra Base64
function convertIMG($tmp) {
    $tipo = mime_content_type($tmp);
    $dados = file_get_contents($tmp);
    return "data:" . $tipo . ";base64," . base64_encode($dados);
}

$img1 = convertIMG($imagem1['tmp_name']);
$img2 = convertIMG($imagem2['tmp_name']);

$sql = "INSERT INTO produtos (
            nomeProduto,
            descricao,
            preco,
            categoria,
            camisaPreta,
            camisaBranca
        ) VALUES (
            :nome,
            :descricao,
            :preco,
            :categoria,
            :img1,
            :img2
        )";

$stmt = $pdo->prepare($sql);

if ($stmt->execute([
    ':nome' => $nome,
    ':descricao' => $descricao,
    ':preco' => $preco,
    ':categoria' => $categoria,
    ':img1' => $img1,
    ':img2' => $img2
])) {
    echo "Produto cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar produto!";
}

header("Location: ../pages/adm.php");
exit;
?>
