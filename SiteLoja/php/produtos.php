<?php
require 'conexao.php';

// JSON CORRIGIDO
$json = '{
  
    "6": {
      "nomeProduto": "Camisa Gorillaz",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa gorillaz preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa gorillaz branca sem fundo.png",
      "descricao": "100% algodão com atitude.",
      "preco": 84.90
    },
    "7": {
      "nomeProduto": "Camisa Red Dead",
      "camisaPreta": "SiteLoja/produtos/CP/1 john marston red dead redemption camisa preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 john marston red dead redemption camisa branca sem fundo.png",
      "descricao": "Conforto no Velho Oeste.",  
      "preco": 84.90
    },
    "8": {
      "nomeProduto": "Camisa Goku",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa goku preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa goku branca sem fundo.png",
      "descricao": "O poder do algodão superior.",
      "preco": 84.90
    },
    "9": {
      "nomeProduto": "Camisa Jojo",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa jojo preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa jojo branca sem fundo.png",
      "descricao": "Estilo bizarro e confortável.",
      "preco": 84.90
    },
    "10": {
      "nomeProduto": "Camisa Okarun",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa okarun preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa okarun branca sem fundo.png",
      "descricao": "Tecido leve, visual ousado.",
      "preco": 84.90
    },
    "11": {
      "nomeProduto": "Camisa Vinne",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa vinne preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa vinne branca sem fundo.png",
      "descricao": "Casual com toque moderno.",
      "preco": 84.90
    },
    "12": {
      "nomeProduto": "Camisa Luffy",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa luffy preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa luffy branca sem fundo.png",
      "descricao": "Liberdade em algodão puro.",
      "preco": 84.90
    },
    "13": {
      "nomeProduto": "Camisa Kaneki",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa kaneki preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa kaneki branca sem fundo.png",
      "descricao": "Sombria, macia e estilosa.",
      "preco": 84.90
    },
    "14": {
      "nomeProduto": "Camisa Naruto",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa naruto preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa naruto branca sem fundo.png",
      "descricao": "Ninja style com conforto.",
      "preco": 84.90
    },
    "15": {
      "nomeProduto": "Camisa The Last of Us",
      "camisaPreta": "SiteLoja/produtos/CP/1 camisa the last of us preta sem fundo.png",
      "camisaBranca": "SiteLoja/produtos/CB/1 camisa the last of us branca sem fundo.png",
      "descricao": "Aventura e conforto unidos.",
      "preco": 84.90
    }
  }';

$produtos = json_decode($json, true);

if (!$produtos) {
    die("Erro ao decodar JSON.");
}

try {
    $stmt = $pdo->prepare("INSERT INTO produtos 
        (nomeProduto, descricao, preco, camisaPreta, camisaBranca, categoria, estoque)
        VALUES (:nomeProduto, :descricao, :preco, :camisaPreta, :camisaBranca, :categoria, :estoque)");

    foreach ($produtos as $produto) {
        $stmt->execute([
            ':nomeProduto' => $produto['nomeProduto'],
            ':descricao' => $produto['descricao'],
            ':preco' => $produto['preco'],
            ':camisaPreta' => $produto['camisaPreta'],
            ':camisaBranca' => $produto['camisaBranca'],
            ':categoria' => 'camisa',
            ':estoque' => 15
        ]);
    }

    echo "Produtos cadastrados com sucesso!";
} catch (PDOException $e) {
    echo "Erro ao cadastrar produtos: " . $e->getMessage();
    exit;
}

?>
