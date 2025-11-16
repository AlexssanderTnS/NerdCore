<?php
ob_start();
session_start();
require 'SiteLoja/php/login.php';
ob_end_clean();



//conectar com o banco para buscar os produtos
$stmt = $pdo->query("SELECT id, nomeProduto, camisaPreta FROM produtos WHERE categoria = 'camisa'");
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
                    if (isset($_SESSION['usuario_nome']) && nivelAcesso() == "2") {
                        // usuário admin logado
                        echo "<div class = 'dropdown'>
                            <a>{$_SESSION['usuario_nome']}<img src='SiteLoja/assets/arrow.svg' alt='arrow_drop_down' /></a>
                            <div class='dropdown-content'>
                            <a href='SiteLoja/pages/adm.php'>Painel Admin</a>
                            <a href='SiteLoja/php/logout.php'>Logout</a>
                            </div>
                            </div>";
                    } else if (isset($_SESSION['usuario_nome'])) {
                        // usuário normal logado
                        echo "<div class ='dropdown'>
                                <a onclick='dropdownToggle()'>{$_SESSION['usuario_nome']}<img src='SiteLoja/assets/arrow.svg' alt='arrow_drop_down' /></a>
                                <div class='dropdown-content'>
                                <a href='SiteLoja/pages/editordado.php'> Perfil </a>
                                <a href='SiteLoja/php/logout.php'>Logout</a>
                                </div>
                                </div>";
                    } else {
                        echo '<a href="SiteLoja/pages/cadastro.php">Cadastre-se</a>';
                        echo '<a href="SiteLoja/pages/login.php">Login</a>';
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
        <?php foreach ($produtos as $p): ?>
            <div class="card">
                <a href="SiteLoja/pages/compra.php?id=<?= $p['id'] ?>">
                    <img class="camisa"
                        src="<?= htmlspecialchars($p['camisaPreta']) ?>"
                        data-id="<?= $p['id'] ?>"
                        alt="<?= htmlspecialchars($p['nomeProduto']) ?>">
                </a>
                <p><a href="SiteLoja/pages/compra.php?id=<?= $p['id'] ?>">Ver produto</a></p>
            </div>
        <?php endforeach; ?>
    </main>

</body>

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

</html>