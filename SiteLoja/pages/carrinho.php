<?php
ob_start();
session_start();
require '../php/login.php'; 
ob_end_clean();
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
      <div id="itens-carrinho" class="grid-itens">
        <!-- Itens serão inseridos aqui via JavaScript -->
      </div>
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