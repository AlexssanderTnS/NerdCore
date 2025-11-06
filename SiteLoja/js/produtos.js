// ==========================
//  MAPEAMENTO DAS CAMISAS
// ==========================

const shirtImages = {
  anya: {
    branca: "../produtos/CB/2 anya camisa branca sem fundo.png",
    preta: "../produtos/CP/1 anya camisa preta sem fundo.png",
  },
  chloe: {
    branca: "../produtos/CB/2 camisa chloe branca sem fundo.png",
    preta: "../produtos/CP/1 camisa chloe preta sem fundo.png",
  },
  gorillaz: {
    branca: "../produtos/CB/2 camisa gorillaz branca sem fundo.png",
    preta: "../produtos/CP/1 camisa gorillaz preta sem fundo.png",
  },
  kratos: {
    branca: "../produtos/CB/2 camisa kratos branca sem fundo.png",
    preta: "../produtos/CP/1 camisa kratos preta sem fundo.png",
  },
  vinne: {
    branca: "../produtos/CB/2 camisa vinne branca sem fundo.png",
    preta: "../produtos/CP/1 camisa vinne preta sem fundo.png",
  },
  okarun: {
    branca: "../produtos/CB/2 camisa okarun branca sem fundo.png",
    preta: "../produtos/CP/1 camisa okarun preta sem fundo.png",
  },
  johnmarston: {
    branca:
      "../produtos/CB/2 john marston red dead redemption camisa branca sem fundo.png",
    preta:
      "../produtos/CP/1 john marston red dead redemption camisa preta sem fundo.png",
  },
  luffy: {
    branca: "../produtos/CB/2 camisa luffy branca sem fundo.png",
    preta: "../produtos/CP/1 camisa luffy preta sem fundo.png",
  },
  kaneki: {
    branca: "../produtos/CB/2 camisa kaneki branca sem fundo.png",
    preta: "../produtos/CP/1 camisa kaneki preta sem fundo.png",
  },
  jojo: {
    branca: "../produtos/CB/2 camisa jojo branca sem fundo.png",
    preta: "../produtos/CP/1 camisa jojo preta sem fundo.png",
  },
  goku: {
    branca: "../produtos/CB/2 camisa goku branca sem fundo.png",
    preta: "../produtos/CP/1 camisa goku preta sem fundo.png",
  },
  farcry3: {
    branca: "../produtos/CB/2 camisa far cry 3 branca sem fundo.png",
    preta: "../produtos/CP/1 camisa far cry 3 preta sem fundo.png",
  },
  scottpilgrim: {
    branca: "../produtos/CB/2 camisa scott pilgrim branca sem fundo.png",
    preta: "../produtos/CP/1 camisa scott pilgrim preta sem fundo.png",
  },
  naruto: {
    branca: "../produtos/CB/2 camisa naruto branca sem fundo.png",
    preta: "../produtos/CP/1 camisa naruto preta sem fundo.png",
  },
};

// ==========================
//  MAPEAMENTO DE NOMES (ALIAS)
// ==========================
const designMap = {
  camisachloe: "chloe",
  camisascottpilgrim: "scottpilgrim",
  camisaanya: "anya",
  camisafarcry3: "farcry3",
  kratos: "kratos",
  gorillaz: "gorillaz",
  reddead: "johnmarston",
  goku: "goku",
  jojo: "jojo",
  okarun: "okarun",
  vinne: "vinne",
  luffy: "luffy",
  kaneki: "kaneki",
  naruto: "naruto",
};

// ==========================
//  ESTADO INICIAL
// ==========================
let currentDesign = "anya";
let currentColor = "branca";

// ==========================
//  FUNÇÕES PRINCIPAIS
// ==========================
function changeColor(color) {
  currentColor = color;
  const mainImage = document.getElementById("imagem-produto");

  if (shirtImages[currentDesign] && shirtImages[currentDesign][color]) {
    mainImage.src = shirtImages[currentDesign][color];
  }

  // Atualiza o estado visual
  document
    .querySelectorAll(".color-option")
    .forEach((opt) => opt.classList.remove("active"));
  const active = document.querySelector(`[data-color="${color}"]`);
  if (active) active.classList.add("active");

  // Pequena animação
  mainImage.style.transform = "scale(0.8)";
  setTimeout(() => (mainImage.style.transform = "scale(1)"), 200);
}

function updateDemoImages() {
  const pos1 = document.querySelector("#position-1 .demo-shirt");
  const pos2 = document.querySelector("#position-2 .demo-shirt");
  if (shirtImages[currentDesign]) {
    pos1.src = shirtImages[currentDesign].branca;
    pos2.src = shirtImages[currentDesign].preta;
  }
}

// ==========================
//  PREFERÊNCIAS
// ==========================
function saveUserPreference() {
  localStorage.setItem("nerdcore_color", currentColor);
  localStorage.setItem("nerdcore_design", currentDesign);
}

function loadUserPreference() {
  const savedColor = localStorage.getItem("nerdcore_color");
  const savedDesign = localStorage.getItem("nerdcore_design");
  if (savedDesign && shirtImages[savedDesign]) currentDesign = savedDesign;
  if (savedColor && shirtImages[currentDesign][savedColor])
    currentColor = savedColor;
}

// ==========================
//  INTERAÇÃO DO USUÁRIO
// ==========================
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".color-option").forEach((opt) => {
    opt.addEventListener("click", () => {
      changeColor(opt.dataset.color);
      saveUserPreference();
    });
  });

  document.querySelectorAll(".demo-shirt").forEach((shirt) => {
    shirt.addEventListener("click", () => {
      const color =
        shirt.parentElement.id === "position-1" ? "branca" : "preta";
      changeColor(color);
      saveUserPreference();
    });
  });

  loadUserPreference();
});

// ==========================
//  CARREGAMENTO DO PRODUTO
// ==========================
function getIdDaURL() {
  const params = new URLSearchParams(window.location.search);
  return params.get("id");
}

window.onload = async function () {
  const id = getIdDaURL();
  try {
    const response = await fetch("../produtos/produtos.json");
    const produtos = await response.json();

    const produto = produtos[id];
    if (!produto) {
      document.body.innerHTML = "<h1>Produto não encontrado</h1>";
      return;
    }

    // Processa o nome e aplica o alias correto
    const nomeProcessado = produto.nome
      .toLowerCase()
      .replace(/\s/g, "")
      .replace(/[^a-z0-9]/g, "");
    currentDesign = designMap[nomeProcessado] || nomeProcessado;

    // Atualiza conteúdo da página
    document.getElementById("nome-produto").textContent = produto.nome;
    document.getElementById("descricao-produto").textContent =
      produto.descricao;
    document.getElementById("preco-produto").textContent = `R$ ${produto.preco
      .toFixed(2)
      .replace(".", ",")}`;

    // Atualiza imagem inicial e demos
    if (shirtImages[currentDesign]) {
      document.getElementById("imagem-produto").src =
        shirtImages[currentDesign][currentColor];
      updateDemoImages();
    } else {
      document.getElementById("imagem-produto").src = produto.imagem;
    }
  } catch (erro) {
    console.error("Erro ao carregar o JSON: ", erro);
    document.body.innerHTML = "<h1>Erro ao carregar o produto.</h1>";
  }
};

document.querySelectorAll(".demo-shirt").forEach((shirt) => {
  shirt.addEventListener("mouseenter", function () {
    this.style.transform = "scale(1.1) rotate(2deg)";
  });

  shirt.addEventListener("mouseleave", function () {
    this.style.transform = "scale(1) rotate(0deg)";
  });
});

function addClickEffect(element) {
  element.style.transform = "scale(0.9)";
  setTimeout(() => {
    element.style.transform = "scale(1.1)";
    setTimeout(() => {
      element.style.transform = "scale(1)";
    }, 100);
  }, 100);
}

function createParticleEffect(element) {
  for (let i = 0; i < 10; i++) {
    const particle = document.createElement("div");
    particle.style.position = "absolute";
    particle.style.width = "4px";
    particle.style.height = "4px";
    particle.style.backgroundColor = "#e9c80c";
    particle.style.borderRadius = "50%";
    particle.style.pointerEvents = "none";
    particle.style.zIndex = "1000";

    const rect = element.getBoundingClientRect();
    particle.style.left = rect.left + rect.width / 2 + "px";
    particle.style.top = rect.top + rect.height / 2 + "px";

    document.body.appendChild(particle);

    // Animar a partícula
    const angle = (Math.PI * 2 * i) / 10;
    const distance = 50 + Math.random() * 50;
    const duration = 1000 + Math.random() * 500;

    particle.animate(
      [
        {
          transform: "translate(0, 0) scale(1)",
          opacity: 1,
        },
        {
          transform: `translate(${Math.cos(angle) * distance}px, ${
            Math.sin(angle) * distance
          }px) scale(0)`,
          opacity: 0,
        },
      ],
      {
        duration: duration,
        easing: "ease-out",
      }
    ).onfinish = () => {
      particle.remove();
    };
  }
}

// Adicionar efeito de partículas ao trocar cor
const originalChangeColor = changeColor;
changeColor = function (color) {
  const activeOption = document.querySelector(".color-option.active");
  if (activeOption) {
    createParticleEffect(activeOption);
  }
  originalChangeColor(color);
};

// Função para adicionar sons (opcional - requer arquivos de áudio)
function playSound(soundType) {
  // Esta função pode ser expandida para incluir efeitos sonoros
  // quando arquivos de áudio forem adicionados ao projeto
  console.log(`Playing ${soundType} sound`);
}

// Função para carregar preferência do usuário
function loadUserPreference() {
  const savedColor = localStorage.getItem("nerdcore_color_preference");
  const savedDesign = localStorage.getItem("nerdcore_design_preference");

  if (savedColor && shirtImages[currentDesign][savedColor]) {
    changeColor(savedColor);
  }

  if (savedDesign && shirtImages[savedDesign]) {
    currentDesign = savedDesign;
    updateDemoImages();
  }
}

// Carregar preferências ao inicializar
document.addEventListener("DOMContentLoaded", function () {
  loadUserPreference();
});

// Salvar preferências quando a cor for alterada
const originalChangeColorWithSave = changeColor;
changeColor = function (color) {
  originalChangeColorWithSave(color);
  saveUserPreference();
};

const carrinho = new CarrinhoCompras();

document.getElementById("btn-adicionar").addEventListener("click", () => {
  const nome = document.getElementById("nome-produto").textContent;
  const precoTexto = document
    .getElementById("preco-produto")
    .textContent.replace("R$ ", "")
    .replace(",", ".");
  const preco = parseFloat(precoTexto);
  const imagem = document.getElementById("imagem-produto").getAttribute("src");
  const tamanho = document.getElementById("tamanho").value;
  const corAtiva = document.querySelector(".color-option.active");
  const cor = corAtiva ? corAtiva.getAttribute("data-color") : "";

  const produto = {
    id: Date.now(), // Ou outro ID mais confiável
    nome,
    preco,
    imagem,
    tamanho,
    cor,
  };

  carrinho.adicionarItem(produto);
});
