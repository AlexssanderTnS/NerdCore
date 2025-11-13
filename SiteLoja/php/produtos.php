<?php
require '.conexao.php';

// Catálogo de produtos
$json = '{
  "1": {
    "nome": "Camisa Chloe",
    "imagem": "../produtos/CP/1 camisa chloe preta sem fundo.png",
    "descricao": "Estilo e personalidade com Chloe!",
    "preco": 89.90
  },
  "2": {
    "nome": "Camisa Scott Pilgrim",
    "imagem": "../produtos/CP/1 camisa scott pilgrim preta sem fundo.png",
    "descricao": "O maior lutador de Ontário.",
    "preco": 86.70
  },
  "3": {
    "nome": "Camisa Anya",
    "imagem": "../produtos/CP/1 anya camisa preta sem fundo.png",
    "descricao": "A fofura espiã que todos amam.",
    "preco": 84.90
  },
  "4": {
    "nome": "Camisa Far Cry 3",
    "imagem": "../produtos/CP/1 camisa far cry 3 preta sem fundo.png",
    "descricao": "Algodão macio, estilo gamer.",
    "preco": 84.90
  },
  "5": {
    "nome": "Camisa Kratos",
    "imagem": "../produtos/CP/1 camisa kratos preta sem fundo.png",
    "descricao": "Força, fúria e conforto.",
    "preco": 84.90
  },
  "6": {
    "nome": "Camisa Gorillaz",
    "imagem": "../produtos/CP/1 camisa gorillaz preta sem fundo.png",
    "descricao": "100% algodão com atitude.",
    "preco": 84.90
  },
  "7": {
    "nome": "Camisa Red Dead",
    "imagem": "../produtos/CP/1 john marston red dead redemption camisa preta sem fundo.png",
    "descricao": "Conforto no Velho Oeste.",
    "preco": 84.90
  },
  "8": {
    "nome": "Camisa Goku",
    "imagem": "../produtos/CP/1 camisa goku preta sem fundo.png",
    "descricao": "O poder do algodão superior.",
    "preco": 84.90
  },
  "9": {
    "nome": "Camisa Jojo",
    "imagem": "../produtos/CP/1 camisa jojo preta sem fundo.png",
    "descricao": "Estilo bizarro e confortável.",
    "preco": 84.90
  },
  "10": {
    "nome": "Camisa Okarun",
    "imagem": "../produtos/CP/1 camisa okarun preta sem fundo.png",
    "descricao": "Tecido leve, visual ousado.",
    "preco": 84.90
  },
  "11": {
    "nome": "Camisa Vinne",
    "imagem": "../produtos/CP/1 camisa vinne preta sem fundo.png",
    "descricao": "Casual com toque moderno.",
    "preco": 84.90
  },
  "12": {
    "nome": "Camisa Luffy",
    "imagem": "../produtos/CP/1 camisa luffy preta sem fundo.png",
    "descricao": "Liberdade em algodão puro.",
    "preco": 84.90
  },
  "13": {
    "nome": "Camisa Kaneki",
    "imagem": "../produtos/CP/1 camisa kaneki preta sem fundo.png",
    "descricao": "Sombria, macia e estilosa.",
    "preco": 84.90
  },
  "14": {
    "nome": "Camisa Naruto",
    "imagem": "../produtos/CP/1 camisa naruto preta sem fundo.png",
    "descricao": "Ninja style com conforto.",
    "preco": 84.90
  },
  "15": {
    "nome": "Camisa The Last of Us",
    "imagem": "../produtos/CP/1 camisa the last of us preta sem fundo.png",
    "descricao": "Aventura e conforto unidos.",
    "preco": 84.90
  }
}';

$produtos = json_decode($json, true);


return $produtos;


if (false) { //  true se quiser adicionar ao banco
  try {
      $stmt = $pdo->prepare("INSERT INTO produtos (nome, descricao, preco, imagem, categoria, estoque)
      VALUES (:nome, :descricao, :preco, :imagem, :categoria, :estoque)");

      foreach ($produtos as $produto) {
          $stmt->execute([
              ':nome' => $produto['nome'],
              ':descricao' => $produto['descricao'],
              ':preco' => $produto['preco'],
              ':imagem' => $produto['imagem'],
              ':categoria' => 'camisa',
              ':estoque' => 15
          ]);
      }

      echo "Produtos cadastrados com sucesso!";
  } catch (PDOException $e) {
      echo "Erro ao cadastrar produtos:" . $e->getMessage();
      exit;
  }
}
?>
