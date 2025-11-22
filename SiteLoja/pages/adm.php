<?php
ob_start();
session_start();
require '../php/login.php';
ob_end_clean();
exigeAcesso(2);

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Empreenda.Já</title>
    <link rel="stylesheet" href="../style/adm.css">
</head>

<body>

    <aside class="sidebar">
        <div>
            <div class="sidebar-header">
                <h4>Painel do Administrador</h4>
            </div>
            <ul class="nav-links">
                <li class="active" data-section="dashboard">Painel Principal</li>
                <li data-section="team">Usuários</li>
                <li data-section="stock">Estoque</li>
                <li data-section="products">Cadastrar Produtos</li>
                <li data-section="sells">Histórico</li>
            </ul>
        </div>
        <a class="logout" href="../../index.php">Sair</a>
    </aside>

    <main class="content" id="conteudo">
        <div class="info">
            <h2>Bem-vindo ao Painel Administrativo, <?php echo $_SESSION['usuario_nome']; ?>!</h2>
            <p>Use o menu lateral para navegar entre as seções do painel.</p>
        </div>
        <div class="foto">
            <img src="../LogoADM.png" />
        </div>
    </main>
    <div id="modal-overlay" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <h3 id="modal-titulo"></h3>
            <p id="modal-msg"></p>

            <div id="modal-botoes" class="modal-buttons">
        
            </div>
        </div>
    </div>





    <script src="../js/adm.js"></script>
</body>

</html>