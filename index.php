<?php
ob_start();
session_start();
require 'SiteLoja/php/login.php'; 
ob_end_clean();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="SiteLoja/style/home.css">
    <link rel="icon" href="SiteLoja/assets/LogoTOPO.png" type="image/x-icon">
    <title>Nerdcore</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />
</head>

<body>

    <script src="https://static.elfsight.com/platform/platform.js" async></script>
    <div class="elfsight-app-47963e1a-79b6-4ecf-ac6d-35be428b39f3" data-elfsight-app-lazy></div>

    <header class="nerdbar">
        <div class="logo">

            <a href="index.php"><img src="SiteLoja/assets/logoroxa.png" alt="logo"></a>

            <h1><a href="index.php">NerdCore</a></h1>
        </div>

      <div class="navbar">
            <span id="menu" class="material-symbols-outlined" onclick="clickMenu()">menu</span>
            <ul id="menu-list">
                 <nav class="link">
                        <a href="index.php">Inicio</a>
                        <a href='SiteLoja/pages/grupo.php'>Quem Somos</a>
                        <div class='dropdown'>
                            <a onclick='dropdownToggle()'>Produtos <img src='SiteLoja/assets/arrow.svg' alt='arrow_drop_down' /></a>
                        <div class='dropdown-content'>
                            <a href='index.php#main'>Camisetas</a>
                            <a href='SiteLoja/pages/producao.php'>Canecas</a>
                            </div>
                        </div>
                        <?php
                        if (isset($_SESSION['usuario_nome']) && nivelAcesso() === "2"){
                                // usuário admin logado
                            echo "<div class = 'dropdown'>
                            '<a>{$_SESSION['usuario_nome']}</a>'
                            <div class='dropdown-content'>
                            <a href='SiteLoja/pages/adm.php'>Painel Admin</a>
                            <a href='SiteLoja/php/logout.php'>Logout</a>
                            </div>
                            </div>";
                        } 
                            else if (isset($_SESSION['usuario_nome'])) {
                                // usuário normal logado
                                echo "<div class ='dropdown'>
                                <a onclick='dropdownToggle()'>{$_SESSION['usuario_nome']}</a>
                                <div class='dropdown-content'>
                                <a href='#'> Perfil </a>
                                <a href='SiteLoja/php/logout.php'>Logout</a>
                                </div>
                                </div>"; 
                        }  
                        else{
                            echo '<a href="SiteLoja/pages/cadastro.php">Cadastre-se</a>';
                            echo'<a href="SiteLoja/pages/login.php">Login</a>';
                        }
                        ?>
                        <!-- <a href="SiteLoja/pages/carrinho.html">Carrinho</a> -->
                </nav>
            </ul>
        </div>
        
    </header>
    
    <div class="Banner-Principal">
        <img id="pacman" src="SiteLoja/assets/pacman2.png" alt="PacMan">
        <img id="banner" src="SiteLoja/assets/banner.png" alt="">
    </div>
    
    <section id="produtosContainer">
    </section>

    <main id="main">
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=1"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa chloe preta sem fundo.png" data-id="1" alt="1"></a>
            <p><a href="SiteLoja/pages/compra.php?id=1">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=2"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa scott pilgrim preta sem fundo.png" data-id="2" alt="2"></a>
            <p><a href="SiteLoja/pages/compra.php?id=2">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=3"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 anya camisa preta sem fundo.png" data-id="3" alt="3"></a>
            <p><a href="SiteLoja/pages/compra.php?id=3">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=4"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa far cry 3 preta sem fundo.png" data-id="4" alt="4"></a>
            <p><a href="SiteLoja/pages/compra.php?id=4">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=5"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa kratos preta sem fundo.png" data-id="5" alt="5"></a>
            <p><a href="SiteLoja/pages/compra.php?id=5">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=6"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa gorillaz preta sem fundo.png" data-id="6" alt="6"></a>
            <p><a href="SiteLoja/pages/compra.php?id=6">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=7"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 john marston red dead redemption camisa preta sem fundo.png" data-id="7"
                    alt="7"></a>
            <p><a href="SiteLoja/pages/compra.php?id=7">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=8"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa goku preta sem fundo.png" data-id="8" alt="8"></a>
            <p><a href="SiteLoja/pages/compra.php?id=8">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=9"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa jojo preta sem fundo.png" data-id="9" alt="9"></a>
            <p><a href="SiteLoja/pages/compra.php?id=9">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=10"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa okarun preta sem fundo.png" data-id="10" alt="10"></a>
            <p><a href="SiteLoja/pages/compra.php?id=10">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=11"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa vinne preta sem fundo.png" data-id="11" alt="11"></a>
            <p><a href="SiteLoja/pages/compra.php?id=11">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=12"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa luffy preta sem fundo.png" data-id="12" alt="12"></a>
            <p><a href="SiteLoja/pages/compra.php?id=12">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=13"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa kaneki preta sem fundo.png" data-id="13" alt="13"></a>
            <p><a href="SiteLoja/pages/compra.php?id=13">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=14"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa naruto preta sem fundo.png" data-id="14" alt="14"></a>
            <p><a href="SiteLoja/pages/compra.php?id=14">Ver produto</a></p>
        </div>
        <div class="card">
            <a href="SiteLoja/pages/compra.php?id=15"><img class="camisa"
                    src="SiteLoja/produtos/CP/1 camisa the last of us preta sem fundo.png" data-id="15" alt="15"></a>
            <p><a href="SiteLoja/pages/compra.php?id=15">Ver produto</a></p>
        </div>
    </main>





    <footer class="footer">
        <div class="footer-logo">
                <h4>NerdCore LTDA.</h4>
            <img src="SiteLoja/assets/LogoTOPO.png" alt="Logo NerdCore">
        </div>

        <div class="footer-content">
                <h4>Nossos Links</h4>
            <ul>
                <li><a href="#">Política de Privacidade</a></li>
                <li><a href="#">Termos de Uso</a></li>
                <li><a href="SiteLoja/pages/grupo.php">Sobre Nós</a></li>
                <li><a href="#">Contato</a></li>
            </ul>
        </div>
       
    
    </footer>


    <script src="/SiteLoja/js/home.js"></script>


</body>

</html>