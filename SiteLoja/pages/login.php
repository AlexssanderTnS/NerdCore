<?php
ob_start();
session_start();
require '../php/login.php'; 
ob_end_clean();

if (logado() && nivelAcesso() != 0) {
  echo '<script>
          window.location.href = "../../index.php";
        </script>';
  exit;
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="../style/login.css" />
    <link rel="icon" href="../assets/LogoTOPO.png" type="image/x-icon" />
    <script src="../js/login.js" defer></script>
    <title>Login</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />

</head>

<body>

    
       <header class="nerdbar">
        <div class="logo">

            <a href="../../index.php"><img src="../assets/logoroxa.png" alt="logo"></a>

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
                        if (isset($_SESSION['usuario_nome']) && nivelAcesso() === "2"){

                            echo "<div class = 'dropdown'>
                            '<a>{$_SESSION['usuario_nome']}</a>'
                            <div class='dropdown-content'>
                            <a href='../pages/adm.php'>Painel Admin</a>
                            <a href='../php/logout.php'>Logout</a>
                            </div>
                            </div>";
                        } 
                            else if (isset($_SESSION['usuario_nome'])) {
                                
                                echo "<div class ='dropdown'>
                                <a onclick='dropdownToggle()'>{$_SESSION['usuario_nome']}</a>
                                <div class='dropdown-content'>
                                <a href='#'> Perfil </a>
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
    <div class="elfsight-app-47963e1a-79b6-4ecf-ac6d-35be428b39f3" data-elfsight-app-lazy></div>


    <section>
        <h1>Corre pra fazer seu Login!</h1>
        <img src="../assets/pacmanonld.png" alt="Pacman" />
        <form id="formLogin" method="POST" action="../php/login.php">
            <!-- Campo do usuário -->
            <div class="botao-campo">
                <input type="text" name="usuario" id="usuario" placeholder="Usuário" />
                <p></p>
            </div>
            <!-- Campo da senha -->
            <div class="botao-campo">
                <input type="password" name="senha" id="senha" placeholder="Senha" />
                <p></p>
            </div>
            <div class="enviar">
                <!-- Botão de enviar o login -->
                <button type="submit" class="botao-funcao" id="enviar">Enviar</button>
                <button type="button" id="limpar">Limpar</button>

            </div>
            <!-- Link para cadastro -->
            <div id="cadastro-link">
                <p>Não tem uma conta? <a href="../pages/cadastro.html">Cadastre-se</a></p>
            </div>
        </form>
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
                <li><a href="./grupo.html">Sobre Nós</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </div>


    </footer>

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
