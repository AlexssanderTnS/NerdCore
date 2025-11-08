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
                <li data-section="team">Equipe</li>
                <li data-section="stock">Estoque</li>
                <li data-section="products">Cadastrar Produtos</li>
                <li data-section="sells">Registro de vendas</li>
            </ul>
        </div>
        <div class="logout">Sair</div>
    </aside>

    <main class="content" id="conteudo">
        <div id="dashboard" class="fade">
            <h2>Bem-vindo, Administrador</h2>
            <p>Movimentações recentes:</p>

            <div class="cards-container">
                <div class="card">
                    <h4>Camisas Vendidas</h4>
                    <h2>12</h2>
                </div>
                <div class="card">
                    <h4>Funcionários Ativos</h4>
                    <h2>22</h2>
                </div>
                <div class="card">
                    <h4>Ultima Alteração</h4>
                    <h2>14/10/2025</h2>
                </div>
            </div>
        </div>
        <div class="foto">
            <img src="../assets/LogoADM.png"/>
        </div>
    </main>

    <script src="../js/adm.js"></script>
</body>

</html>