<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/editorinfo.css"/>
    <title>Dados do Cliente | NerdCore</title>
    <link rel="icon" href="../assets/LogoTOPO.png" type="image/x-icon" />
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />

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
          <a href="../../index.php">Inici00</a>
          <a href="/SiteLoja/pages/cadastro.php">Cadastre-se00</a>
          <a href="/SiteLoja/pages/login.php">Login</a>
          <a href="/SiteLoja/pages/grupo.php">Quem Somos</a>
          <a href="/SiteLoja/pages/registro.html">registro</a>  
        </nav>
      </ul>
    </div>
  </header>


</head>

    

<body>
    <main>
        <div class="registro-container">
            <h2>Dados do Cliente</h2>

            <form>
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" value="" readonly>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="" readonly>

                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" value="" readonly>

                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" value="" readonly>

                <label for="cadastro">Data de Cadastro</label>
                <input type="text" id="cadastro" name="cadastro" value="" readonly>

                <button type="button">Editar Dados</button>
            </form>

            <p><a href="/index.php">Voltar ao Início</a></p>
        </div>
    </main>

</body>

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
                <li><a href="./grupo.html">Sobre Nós</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </div>


</html>