// Seleciona os itens da sidebar
const navLinks = document.querySelectorAll(".nav-links li");
const conteudo = document.getElementById("conteudo");

// Função para trocar o conteúdo
function carregarSecao(secao) {
    let html = "";

    switch (secao) {
        case "dashboard":
            html = `
                <div id="dashboard" class="fade">
                    <h2>Bem-vindo, Administrador</h2>
                    <p>Movimentações recentes:</p>
                    <div class="cards-container">
                        <div class="card"><h4>Camisas Vendidas</h4><h2>12</h2></div>
                        <div class="card"><h4>Funcionários Ativos</h4><h2>22</h2></div>
                        <div class="card"><h4>Última Alteração</h4><h2>14/10/2025</h2></div>
                    </div>
                </div>
                <div class="foto"><img src="/SiteLoja/assets/LogoADM.png" /></div>
            `;
            break;

        case "team":
            html = `
                <div id="team" class="fade">
                    <h2>Equipe da Loja</h2>
                    <p>Lista de funcionários e funções.</p>
                </div>
            `;
            break;

        case "stock":
            html = `
                <div id="stock" class="fade">
                    <h2>Controle de Estoque</h2>
                    <p>Visualize e atualize os produtos disponíveis.</p>
                </div>
            `;
            break;

        case "products":
            html = `
                <div id="products" class="fade">
                    <h2>Cadastrar Novo Produto</h2>
                    <form>
                        <input type="text" placeholder="Nome do produto">
                        <input type="number" placeholder="Preço">
                        <button type="submit">Cadastrar</button>
                    </form>
                </div>
            `;
            break;

        case "sells":
            html = `
                <div id="sells" class="fade">
                    <h2>Registro de Vendas</h2>
                    <p>Relatórios e histórico de vendas.</p>
                </div>
            `;
            break;
    }

    conteudo.innerHTML = html;
}

// Adiciona evento de clique nos links
navLinks.forEach(link => {
    link.addEventListener("click", () => {
        // Remove classe 'active' de todos
        navLinks.forEach(l => l.classList.remove("active"));
        // Adiciona no item clicado
        link.classList.add("active");

        // Carrega a seção correspondente
        const secao = link.getAttribute("data-section");
        carregarSecao(secao);
    });
});

// Inicializa com o dashboard
carregarSecao("dashboard");
