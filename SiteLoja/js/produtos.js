// Atualiza a imagem principal de acordo com a cor selecionada
function changeColor(color) {
    const img = document.getElementById("imagem-produto");

    if (!shirtImages[color]) {
        console.error("Imagem não encontrada para a cor:", color);
        return;
    }

    img.src = shirtImages[color];

    // Atualiza visual dos botões
    document.querySelectorAll(".color-option").forEach(op => {
        op.classList.remove("active");
    });

    document.querySelector(`.color-option[data-color="${color}"]`).classList.add("active");
}
