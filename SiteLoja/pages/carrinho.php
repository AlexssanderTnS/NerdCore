<?php
ob_start();
session_start();
require '../php/login.php';
ob_end_clean();
require '../php/produtos.php';

// carrinho existente
if (!isset($_SESSION['carrinho'])) {
  $_SESSION['carrinho'] = [];
}

if (isset($_GET['action'])) {
  $action = $_GET['action'];
  $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

  switch ($action) {
    case 'add':
      // Adiciona  produto
      if (isset($produtos[$id])) {
        if (!isset($_SESSION['carrinho'][$id])) {
          $_SESSION['carrinho'][$id] = 1;
        } else {
          $_SESSION['carrinho'][$id]++;
        }
      }
      break;

    case 'remove':
      // Remove e apaga o item se bater zero
      if (isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]--;
        if ($_SESSION['carrinho'][$id] <= 0) {
          unset($_SESSION['carrinho'][$id]);
        }
      }
      break;

    case 'delete':
      // Remove completamente o produto
      unset($_SESSION['carrinho'][$id]);
      break;

    case 'clear':
      // Esvazia o carrinho
      $_SESSION['carrinho'] = [];
      break;
  }
  header("Location: carrinho.php");
  exit;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/carrinho.css">
  <link rel="icon" href="../assets/LogoTOPO.png" type="image/x-icon">
  <title>Carrinho - NerdCore</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />
</head>

<body>
  <header class="nerdbar">
    <div class="logo">
      <img src="../assets/logoroxa.png" alt="logo">
      <h1><a href="../../index.php">NerdCore</a></h1>
    </div>

    <div class="navbar">
      <span id="menu" class="material-symbols-outlined" onclick="clickMenu()">
        menu
      </span>
      <ul id="menu-list">
        <nav class="link">
          <a href="../../index.php">Inicio</a>
          <a href="../pages/cadastro.php">Cadastre-se</a>
          <a href="../pages/login.php">Login</a>
          <a href="../pages/grupo.php">Quem Somos</a>
        </nav>
      </ul>
    </div>
  </header>

  <main class="container-carrinho">
    <section class="secao-itens">
    
        <h2>Seu Carrinho</h2>

        <?php
        if (empty($_SESSION['carrinho'])) {
          echo "<p>Seu carrinho está vazio.</p>";
        } else {
          $total = 0;
          echo "<table class='tabela-carrinho'>";
          echo "<tr><th>Produto</th><th>Qtd</th><th>Preço</th><th>Subtotal</th><th>Ações</th></tr>";

          foreach ($_SESSION['carrinho'] as $id => $qtd) {
            if (isset($produtos[$id])) {
              $p = $produtos[$id];
              $subtotal = $p['preco'] * $qtd;
              $total += $subtotal;

              echo "<tr>
            <td>{$p['nome']}</td>
            <td>{$qtd}</td>
            <td>R$ " . number_format($p['preco'], 2, ',', '.') . "</td>
            <td>R$ " . number_format($subtotal, 2, ',', '.') . "</td>
            <td>
              <a href='?action=add&id={$id}' class='btn-acao'>+</a>
              <a href='?action=remove&id={$id}' class='btn-acao'>-</a>
              <a href='?action=delete&id={$id}' class='btn-acao'>Excluir</a>
            </td>
          </tr>";
            }
          }
          echo "<tr>
      <td colspan='5' style='text-align:right'>
        <a href='?action=clear' class='btn-limpar'>Esvaziar Carrinho</a>
      </td>
    </tr>";
        }
        ?>
    </section>

    <aside class="secao-resumo">
      <div class="resumo-compra">
        <h2>Resumo da Compra</h2>

        <div class="linha-resumo">
          <span>Subtotal:</span>
          <span id="subtotal-carrinho">R$ 0,00</span>
        </div>

        <div class="linha-resumo">
          <span>Frete:</span>
          <span>Grátis</span>
        </div>

        <div class="linha-resumo total">
          <span>Total:</span>
          <span id="total-carrinho">R$ 0,00</span>
        </div>

        <div class="opcoes-pagamento">
          <h3>Forma de Pagamento</h3>

          <div class="opcao-pix">
            <div class="pix-header">
              <span class="pix-icon">💳</span>
              <span class="pix-titulo">PIX</span>
            </div>

            <div class="pix-info">
              <p>Chave PIX (CPF):</p>
              <div class="pix-chave">000.000.000-00</div>
              <button class="btn-copiar-pix" onclick="copiarChavePix()">Copiar Chave</button>
            </div>

            <div class="pix-instrucoes">
              <h4>Como pagar:</h4>
              <ol>
                <li>Copie a chave PIX acima</li>
                <li>Abra seu aplicativo bancário</li>
                <li>Selecione "Transferência PIX"</li>
                <li>Cole a chave PIX</li>
                <li>Confirme o valor: <span id="valor-pix">R$ 0,00</span></li>
                <li>Finalize a transação</li>
              </ol>
            </div>
          </div>
        </div>

        <button class="btn-finalizar" onclick="finalizarCompra()">Finalizar Compra</button>
        <a href="../../index.php" class="btn-continuar">Continuar Comprando</a>
      </div>
    </aside>
  </main>

  <footer class="footer">
    <div class="footer-logo">
      <h4>NerdCore LTDA.</h4>
      <img src="../assets/LogoTOPO.png" alt="Logo NerdCore">
    </div>

    <div class="footer-content">
      <h4>Nossos Links</h4>
      <ul>
        <li><a href="#">Política de Privacidade</a></li>
        <li><a href="#">Termos de Uso</a></li>
        <li><a href="#">Sobre Nós</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="../js/carrinho.js"></script>

</body>

</html>