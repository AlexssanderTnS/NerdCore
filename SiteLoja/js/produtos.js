function getIdDaURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get("id");
}

window.onload = async function () {
    const id = getIdDaURL();

    try {
        const response = await fetch("produtos.json");
        const produtos = await response.json();

        const produto = produtos[id];

        if (produto) {
            document.getElementById("nome-produto").textContent = produto.nome;
            document.getElementById("imagem-produto").src = produto.imagem;
            document.getElementById("imagem-produto").alt = produto.nome;
            document.getElementById("descricao-produto").textContent = produto.descricao;
            document.getElementById("preco-produto").textContent = produto.preco
                ? `R$ ${produto.preco.toFixed(2).replace('.', ',')}`
                : "Preço indisponível.";
        } else {
            document.body.innerHTML = "<h1>Produto não encontrado</h1>";
        }
    } catch (erro) {
        console.error("Erro ao carregar o JSON: ", erro);
        document.body.innerHTML = "<h1>Erro ao carregar o produto.</h1>";
    }
};