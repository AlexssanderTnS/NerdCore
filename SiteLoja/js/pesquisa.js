// O nome do arquivo JS que você referenciou no HTML é 'pesquisa.js'
document.addEventListener("DOMContentLoaded", async function () {
  const form = document.getElementById("searchForm");
  const input = document.getElementById("site-search");
  const errorMessage = document.getElementById("errorMessage");
  const container = document.getElementById("produtosContainer");

  let produtos = []; // Array de produtos do JSON

  // === 1. Função para buscar e carregar os produtos do JSON ===
  async function carregarProdutos() {
    try {
      // Nota: O caminho pode precisar de ajuste dependendo de onde o 'pesquisa.js' está.
      // Se 'pesquisa.js' está em /SiteLoja/js/, o caminho para 'dados.json' deve ser ../dados.json
      const resposta = await fetch("../SiteLoja/produtos/produtos.json"); 
      
      // Se o JSON estiver no formato de objeto, use:
      // const dadosObjeto = await resposta.json();
      // produtos = Object.values(dadosObjeto); 
      
      // Se o JSON estiver no formato de Array (como o modificado acima), use:
      produtos = await resposta.json(); 
      
      renderizarProdutos(produtos); // Renderiza todos ao carregar
    } catch (erro) {
      console.error("Erro ao carregar produtos:", erro);
      errorMessage.textContent = "Erro ao carregar os produtos. Verifique o console para detalhes.";
    }
  }

  // === 2. Função para renderizar os produtos na tela ===
  function renderizarProdutos(lista) {
    container.innerHTML = ""; // **MUITO IMPORTANTE:** Limpa o container antes de renderizar

    if (!lista || lista.length === 0) {
      errorMessage.textContent = "Nenhuma camisa encontrada.";
      return;
    }

    errorMessage.textContent = "";

    lista.forEach((produto) => {
      const card = document.createElement("div");
      card.classList.add("card");
      
      // Garantindo que 'produto.id' e 'produto.preco' existam (caso o JSON mude)
      const id = produto.id || Math.random().toString(36).substring(2); // Usa id ou gera um temporário
      const precoFormatado = produto.preco ? produto.preco.toFixed(2) : "—";
      const descricao = produto.descricao || "";

      card.innerHTML = `
        <a href="/SiteLoja/pages/compra.html?id=${id}">
          <img class="camisa" src="${produto.imagem}" alt="${produto.nome}">
        </a>
        <p>${produto.nome}</p>
        <p class="descricao-produto">${descricao}</p>
        <p class="preco-produto">R$ ${precoFormatado}</p>
      `;

      container.appendChild(card);
    });
  }

  // === 3. Filtro de camisas (Lógica de Pesquisa) ===
  function filtrarCamisas() {
    const termo = input.value; // Pega o valor atual do input
    const termoMin = termo.toLowerCase().trim();

    if (termoMin === "") {
        // Se a busca estiver vazia, mostra todos os produtos
        renderizarProdutos(produtos); 
        return;
    }
    
    // Filtragem: usa o método .filter() no array de produtos
    const resultados = produtos.filter(produto =>
      // Verifica se o NOME do produto contém o texto digitado
      produto.nome.toLowerCase().includes(termoMin) 
    );

    renderizarProdutos(resultados);
  }

  // === 4. Eventos de Pesquisa em Tempo Real e Submit ===
  
  // A. Evento para filtrar em tempo real (a cada tecla digitada)
  input.addEventListener("input", filtrarCamisas);

  // B. Evento de submit para evitar o recarregamento da página (comportamento padrão de formulário)
  form.addEventListener("submit", function (event) {
    event.preventDefault(); // Impede o envio do formulário e o recarregamento da página
    // O filtro já foi aplicado pelo evento 'input', mas manteremos o submit para usabilidade (ex: apertar Enter)
    filtrarCamisas(); 
  });
  
  // === 5. Inicialização ===
  await carregarProdutos();
});