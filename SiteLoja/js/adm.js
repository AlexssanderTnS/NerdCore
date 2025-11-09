// Seleciona os itens da sidebar
const navLinks = document.querySelectorAll(".nav-links li");
const conteudo = document.getElementById("conteudo");

// Função ajustada para configurar um par específico de input/preview
function configurarPreviewImagem(idInput, idPreview) {
    // 1. Obter os elementos HTML, que agora já estão no DOM
    const inputImagem = document.getElementById(idInput);
    const imagemPreview = document.getElementById(idPreview);

    // Verifica se os elementos foram encontrados
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
        case "products":
            html = `
                <div id="products" class="fade">
                    <h2>Cadastrar Novo Produto</h2>
                    <form action="../php/upload.php" method="POST" enctype="multipart/form-data">
                        <input type="text" placeholder="Nome do produto" class="np" name="nomeProduto" required>
                        <input type ="text" placeholder="Descrição do produto" class="np" name="descricao"required>
                        <input type="number" placeholder="Preço" class="np" name="preco" name="preco"required>

                        <img id="preview-imagem1" src="" alt="Pré-visualização da imagem 1" style="max-width: 100px; display: none; margin-bottom: 10px; border: 1px solid #ccc; padding: 5px;">
                        <input type="file" id="upload-imagem1" name="imagem1" accept="image/*" name="imagem1"required>
                        
                        <img id="preview-imagem2" src="" alt="Pré-visualização da imagem 2" style="max-width: 100px; display: none; margin-bottom: 10px; border: 1px solid #ccc; padding: 5px;">
                        <input type="file" id="upload-imagem2" name="imagem2" accept="image/*" name="imagem2"required>
                        
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

    // Insere o novo HTML no DOM
    conteudo.innerHTML = html; 

    // Chama a função de configuração para CADA PAR de input/preview
    if (secao === "products") {
        configurarPreviewImagem("upload-imagem1", "preview-imagem1");
        configurarPreviewImagem("upload-imagem2", "preview-imagem2");
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