// Seleciona os itens da sidebar
const navLinks = document.querySelectorAll(".nav-links li");
const conteudo = document.getElementById("conteudo");

//function para mostrar a imagem 
function inicializarPreviewImagem() {
    // 1. Obter os elementos HTML, que agora já estão no DOM
    const inputImagem = document.getElementById('upload-imagem');
    const imagemPreview = document.getElementById('preview-imagem');

    // Verifica se os elementos foram encontrados (se estamos na seção 'products')
    if (inputImagem && imagemPreview) {
        // 2. Adicionar o "ouvinte de eventos" (event listener)
        inputImagem.addEventListener('change', function(event) {
            if (event.target.files && event.target.files[0]) {
                const arquivo = event.target.files[0];
                const leitor = new FileReader();

                leitor.onload = function(e) {
                    // Define o 'src' e torna visível
                    imagemPreview.src = e.target.result;
                    imagemPreview.style.display = 'block';
                }

                // Inicia a leitura do arquivo como uma URL de dados
                leitor.readAsDataURL(arquivo);
            } else {
                // Se o usuário cancelar a seleção, esconde a imagem
                imagemPreview.src = '';
                imagemPreview.style.display = 'none';
            }
        });
    }
}

// Função para trocar o conteúdo
function carregarSecao(secao) {
    let html = "";

    switch (secao) {
        // ... (Cases para 'dashboard', 'team', 'stock', 'sells' permanecem inalterados) ...

        case "products":
            html = `
                <div id="products" class="fade">
                    <h2>Cadastrar Novo Produto</h2>
                    <form>
                        <input type="text" placeholder="Nome do produto">
                        <input type ="text" placeholder="Descrição do produto">
                        <input type="number" placeholder="Preço">
                        <img id="preview-imagem" src="" alt="Pré-visualização da imagem" style="max-width: 300px; display: none; margin-bottom: 10px; border: 1px solid #ccc; padding: 5px;">
                        <input type="file" id="upload-imagem" name="imagem" accept="image/*">
                        <img id="preview-imagem" src="" alt="Pré-visualização da imagem" style="max-width: 300px; display: none; margin-bottom: 10px; border: 1px solid #ccc; padding: 5px;">
                        <input type="file" id="upload-imagem" name="imagem" accept="image/*">
                        
                        <select name="categoria" required>
                            <option value="camiseta">Camiseta</option>
                            <option value="caneca">Caneca</option>
                        </select>
                        <button type="submit">Cadastrar</button>
                    </form>
                </div>
            `;
            break;
            
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

    
    if (secao === "products") {
        inicializarPreviewImagem();
    }
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