<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/editordado.css"/>
    <title>Dados do Cliente | NerdCore</title>
    <link rel="icon" href="../assets/LogoTOPO.png" type="image/x-icon" />
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />

  <header class="nerdbar">
    <div class="logo">
      <img src="../assets/logoroxa.png" alt="logo">
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
                        if (isset($_SESSION['usuario_nome']) && nivelAcesso() == "2"){
                                // usuário admin logado
                            echo "<div class = 'dropdown'>
                            '<a>{$_SESSION['usuario_nome']}</a>'
                            <div class='dropdown-content'>
                            <a href='../pages/adm.php'>Painel Admin</a>
                            <a href='../php/logout.php'>Logout</a>
                            </div>
                            </div>";
                        } 
                            else if (isset($_SESSION['usuario_nome'])) {
                                // usuário normal logado
                                echo "<div class ='dropdown'>
                                <a onclick='dropdownToggle()'>{$_SESSION['usuario_nome']}</a>
                                <div class='dropdown-content'>
                                <a href='editorinfo.php'> Perfil </a>
                                <a href='../php/logout.php'>Logout</a>
                                </div>
                                </div>"; 
                        }  
                        else{
                            echo '<a href="../pages/cadastro.php">Cadastre-se</a>';
                            echo'<a href="../pages/login.php">Login</a>';
                        }
                        ?>
                        <!-- <a href="SiteLoja/pages/carrinho.html">Carrinho</a> -->
                </nav>
            </ul>
        </div>
        
    </header>



  <script src="https://static.elfsight.com/platform/platform.js" async></script>
  <!-- Script de acessibilidade Elfsight -->
  <div class="elfsight-app-47963e1a-79b6-4ecf-ac6d-35be428b39f3" data-elfsight-app-lazy></div> <!-- Widget Elfsight -->




</head>

    

<body>
    <main>
        <div class="registro-container">
            <h2>Dados do Cliente</h2>

            <form>
                <label for="nome">Nome de usuário</label>
                <input type="text" id="nome" name="nome" value=""  readonly>
                <button type="button" >✏️</button>

                <label for="email">E-mail</label>
                <input type="text" id="email" name="email" value=""  readonly>
                 <button type="button" >✏️</button>

                <label for="telefone">Telefone</label>
                <input type="text" id="telefone" name="telefone" value="" readonly>
                <button type="button" >✏️</button>

                <label for="endereco">Telefone fixo</label>
                <input type="text" id="endereco" name="endereco" value="" readonly>
                 <button type="button" >✏️</button>

                <label for="cadastro">Celular</label>
                <input type="text" id="cadastro" name="cadastro" value="" readonly>
                <button type="button" >✏️</button>

                <label for="telefone">Cidade</label>
                <input type="text" id="telefone" name="telefone" value="" readonly>
                <button type="button" >✏️</button>

                <label for="telefone">Bairro</label>
                <input type="text" id="telefone" name="telefone" value="" readonly>
                <button type="button" >✏️</button>

                <label for="telefone">Endereço</label>
                <input type="text" id="telefone" name="telefone" value="" readonly>
                <button type="button" >✏️</button>

                <label for="telefone">Rua</label>
                <input type="text" id="telefone" name="telefone" value="" readonly>
                <button type="button" >✏️</button>

                <label for="telefone">N°</label>
                <input type="text" id="telefone" name="telefone" value="" readonly>
                <button type="button" >✏️</button>


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
        <li><a href="./grupo.php">Sobre Nós</a></li>
        <li><a href="#">Contato</a></li>
      </ul>
    </div>


  </footer>

 
</html>