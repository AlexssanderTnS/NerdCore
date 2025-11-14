<?php
ob_start();
session_start();
  require '../php/login.php';
ob_end_clean();
exigeAcesso(1);

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$produto = $produtos[$id] ?? null;
if (!$produto) {
  echo "<p>Produto não encontrado.</p>";
  exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">


<!--Links JS,CSS-->

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../style/compra.css">
  <link rel="icon" href="../assets/LogoTOPO.png" type="image/x-icon">
  <title>NerdCore</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />

</head>

<body>

  <header class="nerdbar">
    <div class="logo">

      <a href="../../index.html"><img src="../assets/logoroxa.png" alt="logo"></a>

      <h1><a href="../../index.php">NerdCore</a></h1>
    </div>

    <div class="navbar">
      <span id="menu" class="material-symbols-outlined" onclick="clickMenu()">menu</span>
      <ul id="menu-list">
        <nav class="link">
          <a href="../../index.php">Inicio</a>
          <a href='../pages/grupo.php'>Quem Somos</a>
          <div class='dropdown'>
            <a onclick='dropdownToggle()'>Produtos <img src='../assets/arrow.svg' alt='arrow_drop_down' /></a>
            <div class='dropdown-content'>
              <a href='../../index.php#main'>Camisetas</a>
              <a href='../pages/producao.php'>Canecas</a>
            </div>
          </div>
          <?php
          if (isset($_SESSION['usuario_nome']) && nivelAcesso() == "2") {
            // usuário admin logado
            echo "<div class = 'dropdown'>
                            '<a>{$_SESSION['usuario_nome']}</a>'
                            <div class='dropdown-content'>
                            <a href='../pages/adm.php'>Painel Admin</a>
                            <a href='../php/logout.php'>Logout</a>
                            </div>
                            </div>";
          } else if (isset($_SESSION['usuario_nome'])) {
            // usuário normal logado
            echo "<div class ='dropdown'>
                                <a onclick='dropdownToggle()'>{$_SESSION['usuario_nome']}</a>
                                <div class='dropdown-content'>
                                <a href='editorinfo.php'> Perfil </a>
                                <a href='../php/logout.php'>Logout</a>
                                </div>
                                </div>";
          } else {
            echo '<a href="../pages/cadastro.php">Cadastre-se</a>';
            echo '<a href="../pages/login.php">Login</a>';
          }
          ?>

        </nav>
      </ul>
    </div>

  </header>

  <!--Caixa de Compra-->

  <section>

    <div class="minaazul">
      <img id="imagem-produto" src="<?php echo $produto['nomeProduto']; ?>" alt="<?php echo $produto['nomeProduto']; ?>">
    </div>
    <div class="caixa">
      <h2 id="nome-produto"><?php echo $produto['nomeProduto']; ?></h2>
      <p id="descricao-produto"><?php echo $produto['descricao']; ?></p>
      <div class="preco" id="preco-produto">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></div>
      <div class="parcelamento">em 12x R$16,99 "Sem Juros"</div>
      <label for="tamanho">Tamanho:</label>
      <select id="tamanho" name="tamanho">
        <option value="P">P</option>
        <option value="M">M</option>
        <option value="G">G</option>
        <option value="GG">GG</option>
      </select>

      <!-- Seletor de Cores -->
      <div class="color-selector">
        <label for="cor">Cor:</label>
        <div class="color-options">
          <div class="color-option active" data-color="branca" onclick="changeColor('branca')">
            <div class="color-square white"></div>
            <span>Branca</span>
          </div>
          <div class="color-option" data-color="preta" onclick="changeColor('preta')">
            <div class="color-square black"></div>
            <span>Preta</span>
          </div>
        </div>
      </div>

      <a href="../pages/carrinho.php?action=add&id=<?php echo $id; ?>" class="botao">Adicionar ao Carrinho</a>
      <a href="../pages/carrinho.php?action=add&id=<?php echo $id; ?>" id="botaocompra">Comprar</a>
    </div>
  </section>

  <!-- Área de demonstração das camisas -->
  <section class="demo-section">
    <div class="demo">
      <h3>cores disponiveis</h3>
      <div class="shirt-demo">
        <div class="shirt-position" id="position-1">
          <img src="2anyacamisabrancasemfundo.png" alt="Camisa Branca" class="demo-shirt">
          <span>Camisa 01 - Branca</span>
        </div>
        <div class="shirt-position" id="position-2">
          <img src="1anyacamisapretasemfundo.png" alt="Camisa Preta" class="demo-shirt">
          <span>Camisa 02 - Preta</span>
        </div>
      </div>
    </div>
  </section>


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

  <!--Link com JS-->

  <script src="../js/produtos.js"></script>


  <script>
    function clickMenu() {
      const menuList = document.getElementById("menu-list");
      if (menuList.style.display === "flex") {
        menuList.style.display = "none";
      } else {
        menuList.style.display = "flex";
      }
    }
  </script>

</body>

</html>