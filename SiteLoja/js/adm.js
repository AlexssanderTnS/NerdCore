// Seleciona os itens da sidebar
const navLinks = document.querySelectorAll(".nav-links li");
const conteudo = document.getElementById("conteudo");

// Função para configurar preview de imagem
function configurarPreviewImagem(idInput, idPreview) {
  const inputImagem = document.getElementById(idInput);
  const imagemPreview = document.getElementById(idPreview);

  if (inputImagem && imagemPreview) {
    inputImagem.addEventListener("change", function (event) {
      if (event.target.files && event.target.files[0]) {
        const leitor = new FileReader();
        leitor.onload = (e) => {
          imagemPreview.src = e.target.result;
          imagemPreview.style.display = "block";
        };
        leitor.readAsDataURL(event.target.files[0]);
      } else {
        imagemPreview.src = "";
        imagemPreview.style.display = "none";
      }
    });
  }
}

// ---------------------------------------------------------------------------
// FUNÇÃO PRINCIPAL
// ---------------------------------------------------------------------------
function carregarSecao(secao) {
  let html = "";

  switch (secao) {
    case "products":
      html = `
        <div id="products" class="fade">
            <h2>Cadastrar Novo Produto</h2>
            <form action="../php/upload.php" method="POST" enctype="multipart/form-data">
                <input type="text" placeholder="Nome do produto" class="np" name="nomeProduto" required>
                <input type="text" placeholder="Descrição do produto" class="np" name="descricao" required>
                <input type="number" placeholder="Preço" class="np" name="preco" required>

                <img id="preview-imagem1" style="max-width:100px;display:none;margin-bottom:10px;border:1px solid #ccc;padding:5px;">
                <input type="file" id="upload-imagem1" accept="image/*" name="imagem1" required>

                <img id="preview-imagem2" style="max-width:100px;display:none;margin-bottom:10px;border:1px solid #ccc;padding:5px;">
                <input type="file" id="upload-imagem2" accept="image/*" name="imagem2" required>

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
        <div class="foto"><img src="../assets/LogoADM.png"></div>
      `;
      break;

    case "team":
      html = `
        <div id="team" class="fade">
            <h2>Usuários Cadastrados</h2>

            <input type="text" id="searchUser" placeholder="Buscar por nome, email ..."
              style="margin-bottom:10px;padding:5px">

            <table border="1" cellpadding="10" id="tabelaUsuarios">
              <thead>
                <tr>
                  <th>ID</th><th>Nome</th><th>Email</th><th>Usuário</th>
                  <th>Acesso</th><th>Data Cadastro</th><th>Ações</th>
                </tr>
              </thead>
              <tbody id="tabelaUsuariosBody">
                <tr><td colspan="7">Carregando...</td></tr>
              </tbody>
            </table>
        </div>
      `;
      break;

    case "stock":
      html = `
        <div id="stock" class="fade"></div>

        <div id="lista-produtos" class="lista-produtos">
          <p>Carregando produtos...</p>
        </div>
      `;
      break;

    case "sells":
      html = `
        <div id="sells" class="fade">
            <h2>Registro de Vendas</h2>
            
            <table border="1" cellpadding="10" id="tabelaVendas">
            <input type="text" id="searchSell" placeholder="Buscar venda...">
              <thead>
                <tr>
                  <th>ID Compra</th>
                  <th>Usuário</th>
                  <th>Produto</th>
                  <th>Tamanho</th>
                  <th>Cor</th>
                  <th>Quantidade</th><th>Total</th><th>Data</th>
                </tr>
              </thead>
              <tbody id="tabelaVendasBody">
                <tr><td colspan="6">Carregando...</td></tr>
              </tbody>
            </table>
        </div>
      `;
      break;

    default:
      html = `<p>Seção não encontrada</p>`;
  }

  conteudo.innerHTML = html;
  void conteudo.offsetHeight; 
  // ========================================================================
  // CARREGAR USUÁRIOS
  // ========================================================================
  if (secao === "team") {
    fetch("../php/adm.php")
      .then((r) => r.json())
      .then((usuarios) => {
        const tbody = document.getElementById("tabelaUsuariosBody");
        tbody.innerHTML = "";

        usuarios.forEach((u) => {
          tbody.innerHTML += `
            <tr class="usuario-linha" >
              <td>${u.user_id}</td>
              <td>${u.nome}</td>
              <td>${u.email}</td>
              <td>${u.usuario}</td>
              <td>${u.acesso}</td>
              <td>${u.data_cadastro}</td>
              <td><button onclick="excluirUsuario(${u.user_id})">Excluir</button></td>
            </tr>
          `;
        });

        const input = document.getElementById("searchUser");
        input.addEventListener("input", () => {
          const filtro = input.value.toLowerCase();
          document.querySelectorAll(".usuario-linha").forEach((tr) => {
            const tdArray = Array.from(tr.children).map(td => td.textContent.toLowerCase());
            const texto = tdArray.join(" ");
            tr.style.display = texto.includes(filtro) ? "" : "none";
          });
        });
      });
  }

  // ========================================================================
  // CARREGAR PRODUTOS
  // ========================================================================
  if (secao === "stock") {
    fetch("../php/listarP.php")
      .then((r) => r.json())
      .then((produtos) => {
        const div = document.getElementById("lista-produtos");
        div.innerHTML = "";

        produtos.forEach((p) => {
          const img = p.camisaPreta.startsWith("data:") ? p.camisaPreta : "../" + p.camisaPreta;

          div.innerHTML += `
            <div class="produto-card ${p.disponivel == 0 ? "indisponivel" : ""}">
              <img src="${img}">
              <h3>${p.nomeProduto}</h3>
              <p>R$ ${Number(p.preco).toFixed(2)}</p>
              <button onclick="excluirProduto('${p.id}')">Excluir</button>
            </div>
          `;
        });
      });
  }

  // ========================================================================
  // CARREGAR VENDAS
  // ========================================================================
  if (secao === "sells") {
    fetch("../php/listarCompras.php")
      .then((r) => r.json())
      .then((vendas) => {
        const tbody = document.getElementById("tabelaVendasBody");
        tbody.innerHTML = "";

        vendas.forEach((v) => {
          tbody.innerHTML += `
            <tr class="venda-linha" style="background-color:#FFFFFF">
              <td>${v.id}</td>
              <td>${v.usuario_nome}</td>
              <td>${v.produto_nome}</td>
              <td>${v.tamanho}</td>
              <td>${v.cor}</td>
              <td>${v.quantidade}</td>
              <td>R$ ${Number(v.total).toFixed(2)}</td>
              <td>${v.data_compra}</td>
            </tr>
          `;
        });

        const inputSell = document.getElementById("searchSell");
        inputSell.addEventListener("input", () => {
          const filtro = inputSell.value.toLowerCase();
          document.querySelectorAll(".venda-linha").forEach((tr) => {
            const tdArray = Array.from(tr.children).map(td => td.textContent.toLowerCase());
            const texto = tdArray.join(" ");
            tr.style.display = texto.includes(filtro) ? "" : "none";
          });
        });
      });
  }

  // ========================================================================
  // CONFIGURAR PREVIEW IMAGENS
  // ========================================================================
  if (secao === "products") {
    configurarPreviewImagem("upload-imagem1", "preview-imagem1");
    configurarPreviewImagem("upload-imagem2", "preview-imagem2");
  }
}

// ---------------------------------------------------------------------------
// EVENTOS E FUNÇÕES DE EXCLUSÃO
// ---------------------------------------------------------------------------
navLinks.forEach((link) => {
  link.addEventListener("click", () => {
    navLinks.forEach((l) => l.classList.remove("active"));
    link.classList.add("active");
    carregarSecao(link.dataset.section);
  });
});

function excluirUsuario(user_id) {
  mostrarModal(
    "Excluir Usuário",
    "Tem certeza que deseja excluir este usuário?",
    [
      { texto: "Cancelar", classe: "modal-cancel", acao: () => {} },
      {
        texto: "Excluir",
        classe: "modal-confirm",
        acao: () => {
          fetch("../php/excluirUsuario.php", {
            method: "POST",
            body: new URLSearchParams({ user_id }),
          })
            .then((r) => r.json())
            .then(() => {
              mostrarModal("Sucesso", "Usuário excluído", [
                {
                  texto: "Ok",
                  classe: "modal-ok",
                  acao: () =>
                    document.querySelector('[data-section="team"]').click(),
                },
              ]);
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
      { texto: "Cancelar", classe: "modal-cancel", acao: () => {} },
      {
        texto: "Excluir",
        classe: "modal-confirm",
        acao: () => {
          fetch("../php/excluirProduto.php", {
            method: "POST",
            body: new URLSearchParams({ id }),
          })
            .then((r) => r.json())
            .then(() => {
              mostrarModal("Sucesso", "Produto removido!", [
                {
                  texto: "Ok",
                  classe: "modal-ok",
                  acao: () =>
                    document.querySelector('[data-section="stock"]').click(),
                },
              ]);
            });
        },
      },
    ]
  );
}

function mostrarModal(t, msg, botoes) {
  document.getElementById("modal-titulo").textContent = t;
  document.getElementById("modal-msg").textContent = msg;

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
