// Instancia o carrinho
function clickMenu() {
  const menuList = document.getElementById("menu-list");
  if (menuList.style.display === "flex") {
    menuList.style.display = "none";
  } else {
    menuList.style.display = "flex";
  }
}

// Carrega itens do carrinho quando a página abre
document.addEventListener("DOMContentLoaded", () => {
  if (carrinho) {
    carrinho.atualizarVisualizacaoCarrinho();
    atualizarResumoCompra();
  }
});

// Atualiza resumo da compra
function atualizarResumoCompra() {
  if (!carrinho) return;

  const total = carrinho.calcularTotal();
  const subtotalElement = document.getElementById("subtotal-carrinho");
  const totalElement = document.getElementById("total-carrinho");
  const valorPixElement = document.getElementById("valor-pix");

  if (subtotalElement) {
    subtotalElement.textContent = `R$ ${total.toFixed(2).replace(".", ",")}`;
  }

  if (totalElement) {
    totalElement.textContent = `R$ ${total.toFixed(2).replace(".", ",")}`;
  }

  if (valorPixElement) {
    valorPixElement.textContent = `R$ ${total.toFixed(2).replace(".", ",")}`;
  }
}

// Copia chave PIX para clipboard
function copiarChavePix() {
  const chavePix = "000.000.000-00";
  navigator.clipboard
    .writeText(chavePix)
    .then(() => {
      const btn = document.querySelector(".btn-copiar-pix");
      const textoOriginal = btn.textContent;
      btn.textContent = "✓ Copiado!";
      btn.style.backgroundColor = "#4CAF50";

      setTimeout(() => {
        btn.textContent = textoOriginal;
        btn.style.backgroundColor = "";
      }, 2000);
    })
    .catch((err) => {
      alert("Erro ao copiar: " + err);
    });
}

// Finaliza compra
function finalizarCompra() {
  if (!carrinho || carrinho.itens.length === 0) {
    alert("Seu carrinho está vazio!");
    return;
  }

  const total = carrinho.calcularTotal();
  const mensagem = `Olá! Gostaria de confirmar meu pedido no valor de R$ ${total
    .toFixed(2)
    .replace(
      ".",
      ","
    )}. Já realizei a transferência PIX para a chave 206.246.647-71.`;

  // Abre WhatsApp com mensagem pré-preenchida (opcional)
  // const whatsappUrl = `https://wa.me/55XXXXXXXXXXX?text=${encodeURIComponent(mensagem)}`;
  // window.open(whatsappUrl);

  // Mostra mensagem de sucesso
  alert(
    "Obrigado pela compra! Você será redirecionado para confirmar o pagamento."
  );

  // Limpa carrinho
  carrinho.itens = [];
  carrinho.salvarCarrinho();

  // Redireciona para home após 2 segundos
  setTimeout(() => {
    window.location.href = "../../index.php";
  }, 2000);
}

// Monitora mudanças no carrinho
const observer = new MutationObserver(() => {
  atualizarResumoCompra();
});

document.addEventListener("DOMContentLoaded", () => {
  const containerItens = document.getElementById("itens-carrinho");
  if (containerItens) {
    observer.observe(containerItens, { childList: true, subtree: true });
  }
});
