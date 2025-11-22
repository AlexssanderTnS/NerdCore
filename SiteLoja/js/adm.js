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
    inputImagem.addEventListener("change", function (event) {
      if (event.target.files && event.target.files[0]) {
        const arquivo = event.target.files[0];
        const leitor = new FileReader();

        leitor.onload = function (e) {
          // Define o 'src' e torna visível
          imagemPreview.src = e.target.result;
          imagemPreview.style.display = "block";
        };

        // Inicia a leitura do arquivo como uma URL de dados
        leitor.readAsDataURL(arquivo);
      } else {
        // Se o usuário cancelar a seleção, esconde a imagem
        imagemPreview.src = "";
        imagemPreview.style.display = "none";
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
                        <input type="file" id="upload-imagem1" accept="image/*" name="imagem1"required>
                        
                        <img id="preview-imagem2" src="" alt="Pré-visualização da imagem 2" style="max-width: 100px; display: none; margin-bottom: 10px; border: 1px solid #ccc; padding: 5px;">
                        <input type="file" id="upload-imagem2" accept="image/*" name="imagem2"required>
                        
                        <select name="categoria" required>
                            <option value="camisa">Camisa</option>
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
                <div class="foto"><img src="../assets/LogoADM.png" /></div>
            `;
      break;

    case "team":
  html = `
    <div id="team" class="fade">
      <h2>Usuários Cadastrados</h2>

      <input
        type="text"
        id="searchUser"
        placeholder="Buscar por nome, email ..."
        style="margin-bottom: 10px; padding: 5px;"
      />

      <table border="1" cellpadding="10" id="tabelaUsuarios">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Usuário</th>
            <th>Acesso</th>
            <th>Data do cadastro</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody id="tabelaUsuariosBody">
          <tr><td colspan="7">Carregando...</td></tr>
        </tbody>
      </table>
    </div>
  `;
  break;


      break;

    case "stock":
      html = `
        <div id="stock" class="fade">
        </div>
        <div id="lista-produtos" class="lista-produtos">
            <p>Carregando produtos...</p>
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
  if (secao === "team") {
  fetch("../php/adm.php")
    .then((res) => res.json())
    .then((data) => {
      const tbody = document.getElementById("tabelaUsuariosBody");
      tbody.innerHTML = "";
      data.forEach((usuario) => {
        tbody.innerHTML += `
          <tr class="usuario-linha">
            <td>${usuario.user_id}</td>
            <td>${usuario.nome}</td>
            <td>${usuario.email}</td>
            <td>${usuario.usuario}</td>
            <td>${usuario.acesso}</td>
            <td>${usuario.data_cadastro}</td>
            <td><button onclick="excluirUsuario(${usuario.user_id})">Excluir</button></td>
          </tr>
        `;
      });

      // ** Aqui: liga o filtro **
      const inputBusca = document.getElementById("searchUser");
      inputBusca.addEventListener("input", function () {
        const filtro = inputBusca.value.toLowerCase();
        const linhas = tbody.querySelectorAll(".usuario-linha");
        linhas.forEach((tr) => {
          // pega o texto de cada célula relevante (você pode filtrar por várias colunas)
          const nome = tr.cells[1].textContent.toLowerCase();
          const email = tr.cells[2].textContent.toLowerCase();
          const usuarioCampo = tr.cells[3].textContent.toLowerCase();

          // se corresponder a pelo menos uma coluna, mostra, senão esconde
          if (
            nome.includes(filtro) ||
            email.includes(filtro) ||
            usuarioCampo.includes(filtro)
          ) {
            tr.style.display = "";
          } else {
            tr.style.display = "none";
          }
        });
      });
    })
    .catch((err) => {
      console.error("Erro ao carregar usuários:", err);
    });
}


  // Chama a função de configuração para CADA PAR de input/preview
  if (secao === "products") {
    configurarPreviewImagem("upload-imagem1", "preview-imagem1");
    configurarPreviewImagem("upload-imagem2", "preview-imagem2");
  }

  if (secao === "stock") {
    const lista = document.getElementById("lista-produtos");

    fetch("../php/listarP.php")
      .then((res) => res.json())
      .then((dados) => {
        const container = document.getElementById("lista-produtos");
        container.innerHTML = "";

        dados.forEach((produto) => {
          const classeIndisponivel =
            produto.disponivel == 0 ? "indisponivel" : "";

          const imagem = produto.camisaPreta;

          // Verifica se é base64 ou caminho físico
          const src = imagem.startsWith("data:") ? imagem : "../" + imagem; // coloca ../ antes, porque o painel está dentro de /SiteLoja/admin/

          container.innerHTML += `
        <div class="produto-card ${classeIndisponivel}">
          <img src="${src}" alt="${produto.nomeProduto}">
          <h3>${produto.nomeProduto}</h3>
          <p>R$ ${Number(produto.preco).toFixed(2)}</p>
          <button class="excluir" onclick="excluirProduto('${produto.id}')">
            Excluir
          </button>
        </div>
      `;
        });
      })
      .catch((err) => {
        console.error(err);
      });
  }
}

navLinks.forEach((link) => {
  link.addEventListener("click", () => {
    navLinks.forEach((l) => l.classList.remove("active"));
    // Adiciona no item clicado
    link.classList.add("active");

    const secao = link.getAttribute("data-section");
    carregarSecao(secao);
  });
});

function excluirUsuario(user_id) {
  mostrarModal(
    "Excluir Usuário",
    "Tem certeza que deseja excluir este usuário?",
    [
      {
        texto: "Cancelar",
        classe: "modal-cancel",
        acao: () => {},
      },
      {
        texto: "Excluir",
        classe: "modal-confirm",
        acao: () => {
          fetch("../php/excluirUsuario.php", {
            method: "POST",
            body: new URLSearchParams({ user_id }),
          })
            .then((res) => res.json())
            .then((ret) => {
              if (ret.sucesso) {
                mostrarModal("Sucesso", "Usuário excluído com sucesso!", [
                  {
                    texto: "Ok",
                    classe: "modal-ok",
                    acao: () => {
                      document.querySelector('button[onclick*="team"]').click();
                    },
                  },
                ]);
              } else {
                mostrarModal("Erro", ret.erro, [
                  { texto: "Ok", classe: "modal-ok", acao: () => {} },
                ]);
              }
            });
        },
      },
    ]
  );
}

function excluirProduto(id) {
  mostrarModal(
    "Excluir Produto",
    "Tem certeza que deseja excluir este produto?",
    [
      {
        texto: "Cancelar",
        classe: "modal-cancel",
        acao: () => {},
      },
      {
        texto: "Excluir",
        classe: "modal-confirm",
        acao: () => {
          fetch("../php/excluirProduto.php", {
            method: "POST",
            body: new URLSearchParams({ id }),
          })
            .then((res) => res.json())
            .then((ret) => {
              if (ret.sucesso) {
                mostrarModal("Sucesso", "Produto removido!", [
                  {
                    texto: "Ok",
                    classe: "modal-ok",
                    acao: () =>
                      document.querySelector('[data-section="stock"]').click(),
                  },
                ]);
              } else {
                mostrarModal("Erro", ret.erro, [
                  { texto: "Ok", classe: "modal-ok", acao: () => {} },
                ]);
              }
            });
        },
      },
    ]
  );
}

function mostrarModal(titulo, mensagem, botoes = []) {
  document.getElementById("modal-titulo").textContent = titulo;
  document.getElementById("modal-msg").textContent = mensagem;

  const box = document.getElementById("modal-botoes");
  box.innerHTML = "";

  botoes.forEach((btn) => {
    const b = document.createElement("button");
    b.textContent = btn.texto;
    b.className = "modal-btn " + btn.classe;
    b.onclick = () => {
      btn.acao();
      fecharModal();
    };
    box.appendChild(b);
  });

  document.getElementById("modal-overlay").style.display = "flex";
}

function fecharModal() {
  document.getElementById("modal-overlay").style.display = "none";
}
