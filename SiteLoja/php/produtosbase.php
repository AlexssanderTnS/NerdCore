<?php
require 'conexao.php';


$camisas = [
    [
        'nome' => 'anya',
        'preta' => '',
        'branca' => 'BASE64_BRANCA_1'
    ],
    [
        'nome' => 'Camisa 2',
        'preta' => 'BASE64_PRETA_2',
        'branca' => 'BASE64_BRANCA_2'
    ],
    [
        'nome' => 'Camisa 3',
        'preta' => 'BASE64_PRETA_3',
        'branca' => 'BASE64_BRANCA_3'
    ],[
        'nome' => 'Camisa 2',
        'preta' => 'BASE64_PRETA_2',
        'branca' => 'BASE64_BRANCA_2'
    ],
    [
        'nome' => 'Camisa 3',
        'preta' => 'BASE64_PRETA_3',
        'branca' => 'BASE64_BRANCA_3'
    ],[
        'nome' => 'Camisa 2',
        'preta' => 'BASE64_PRETA_2',
        'branca' => 'BASE64_BRANCA_2'
    ],
    [
        'nome' => 'Camisa 3',
        'preta' => 'BASE64_PRETA_3',
        'branca' => 'BASE64_BRANCA_3'
    ],[
        'nome' => 'Camisa 2',
        'preta' => 'BASE64_PRETA_2',
        'branca' => 'BASE64_BRANCA_2'
    ],
    [
        'nome' => 'Camisa 3',
        'preta' => 'BASE64_PRETA_3',
        'branca' => 'BASE64_BRANCA_3'
    ],[
        'nome' => 'Camisa 2',
        'preta' => 'BASE64_PRETA_2',
        'branca' => 'BASE64_BRANCA_2'
    ],
    [
        'nome' => 'Camisa 3',
        'preta' => 'BASE64_PRETA_3',
        'branca' => 'BASE64_BRANCA_3'
    ],

  
];

// Preparar SQL uma vez só
$sql = "INSERT INTO produtos (nomeProduto, descricao, preco, camisaPreta, :camisaBranca, categoria, estoque)
        VALUES (:nomeProduto, :descricao, :preco, :camisaPreta, :camisaBranca, :categoria, :estoque)";
$stmt = $pdo->prepare($sql);

// Loop para inserir cada camisa
foreach ($camisas as $c) {
    $stmt->execute([
        ':nomeProduto' => $c['nome'],
        ':descricao' => $c['descricao'],
        ':preco'=> $c['preco'],
        ':camisaPreta' => $c['preta'],
        ':camisaBranca' => $c['branca'],
        ':categoria' => 'camisa',
        ':estoque' => $c['15']
    ]);
}

echo "Todas as camisas foram inseridas com sucesso!";
