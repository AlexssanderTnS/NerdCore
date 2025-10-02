// Mapeamento das camisas por cor e design #AQUI ESTÃO AS CAMISAS E AS IMAGENS DELA
const shirtImages = {
    anya: {
        branca: '2anyacamisabrancasemfundo.png',
        preta: '1anyacamisapretasemfundo.png'
    },
    chloe: {
        branca: '2camisachloebrancasemfundo.png',
        preta: '1camisachloepretasemfundo.png'
    },
    gorillaz: {
        branca: '2camisagorillazbrancasemfundo.png',
        preta: '1camisagorillazpretasemfundo(1).png'
    },
    kratos: {
        branca: '2camisakratosbrancasemfundo.png',
        preta: '1camisakratospretasemfundo(1).png'
    },
    vinne: {
        branca: '2camisavinnebrancasemfundo.png',
        preta: '1camisavinnepretasemfundo.png'
    },
    okarun: {
        branca: '2camisaokarunbrancasemfundo.png',
        preta: '1camisaokarunbrancasemfundo.png'
    },
    johnmarston: {
        branca: '2johnmarstonreddeadredemptioncamisabrancasemfundo.png',
        preta: '1johnmarstonreddeadredemptioncamisapretasemfundo.png'
    },
    luffy: {
        branca: '2camisaluffybrancasemfundo.png',
        preta: '1camisaluffypretasemfundo.png'
    },
    kaneki: {
        branca: '2camisakanekipretasemfundo.png',
        preta: '1camisakanekibrancasemfundo.png'
    },
    jojo: {
        branca: '2camisajojobrancasemfundo.png',
        preta: '1camisajojobrancasemfundo.png'
    },
    goku: {
        branca: '2camisagokucabrancasemfundo.png',
        preta: '1camisagokupretasemfundo.png'
    },
    farcry3: {
        branca: 'camisafarcry3brancasemfundo.png',
        preta: 'camisafarcry3pretasemfundo.png'
    },
    scottpilgrim: {
        branca: 'camisascottpilgrimbrancasemfundo.png',
        preta: 'camisascottpilgrimpretasemfundo.png'
    },

};

// Design atual selecionado (padrão: anya)
let currentDesign = 'anya';
let currentColor = 'branca';

// Função para trocar a cor da camisa
function changeColor(color) {
    currentColor = color;

    // Atualizar a imagem principal
    const mainImage = document.getElementById('imagem-produto');
    mainImage.src = shirtImages[currentDesign][color];

    // Atualizar os seletores de cor
    document.querySelectorAll('.color-option').forEach(option => {
        option.classList.remove('active');
    });
    document.querySelector(`[data-color="${color}"]`).classList.add('active');

    // Animar a troca
    mainImage.style.transform = 'scale(0.8)';
    setTimeout(() => {
        mainImage.style.transform = 'scale(1)';
    }, 200);

    // Se a cor preta for selecionada, animar a camisa 02
    if (color === 'preta') {
        animateShirt02();
    }
}

// Função para animar a camisa 02 em direção à camisa 01
function animateShirt02() {
    const position2 = document.getElementById('position-2');

    // Adicionar classe de animação
    position2.classList.add('moving');

    // Remover a animação após 2 segundos
    setTimeout(() => {
        position2.classList.remove('moving');
    }, 2000);
}

// Função para trocar o design da camisa (para futuras expansões)
function changeDesign(design) {
    if (shirtImages[design]) {
        currentDesign = design;
        changeColor(currentColor);

        // Atualizar as imagens de demonstração
        updateDemoImages();
    }
}

// Função para atualizar as imagens de demonstração
function updateDemoImages() {
    const position1Img = document.querySelector('#position-1 .demo-shirt');
    const position2Img = document.querySelector('#position-2 .demo-shirt');

    position1Img.src = shirtImages[currentDesign]['branca'];
    position2Img.src = shirtImages[currentDesign]['preta'];
}

// Função para adicionar efeitos visuais aos quadradinhos #NÃO MEXA
function addColorSquareEffects() {
    const colorSquares = document.querySelectorAll('.color-square');

    colorSquares.forEach(square => {
        square.addEventListener('mouseenter', function () {
            this.style.transform = 'scale(1.2) rotate(5deg)';
            this.style.boxShadow = '0 0 15px rgba(233, 200, 12, 0.8)';
        });

        square.addEventListener('mouseleave', function () {
            this.style.transform = 'scale(1) rotate(0deg)';
            this.style.boxShadow = 'none';
        });
    });
}

// Função para adicionar efeito de clique nos quadradinhos #NÃO MEXA
function addClickEffect(element) {
    element.style.transform = 'scale(0.9)';
    setTimeout(() => {
        element.style.transform = 'scale(1.1)';
        setTimeout(() => {
            element.style.transform = 'scale(1)';
        }, 100);
    }, 100);
}

// Adicionar eventos de clique aos seletores de cor
document.addEventListener('DOMContentLoaded', function () {
    // Adicionar efeitos aos quadradinhos
    addColorSquareEffects();

    // Adicionar evento de clique com efeito visual #NÃO MEXA
    document.querySelectorAll('.color-option').forEach(option => {
        option.addEventListener('click', function () {
            const colorSquare = this.querySelector('.color-square');
            addClickEffect(colorSquare);
        });
    });

    // Adicionar efeito hover às camisas de demonstração
    document.querySelectorAll('.demo-shirt').forEach(shirt => {
        shirt.addEventListener('mouseenter', function () {
            this.style.transform = 'scale(1.1) rotate(2deg)';
        });

        shirt.addEventListener('mouseleave', function () {
            this.style.transform = 'scale(1) rotate(0deg)';
        });
    });

    // Adicionar funcionalidade de clique nas camisas de demonstração
    document.getElementById('position-1').addEventListener('click', function () {
        changeColor('branca');
    });

    document.getElementById('position-2').addEventListener('click', function () {
        changeColor('preta');
        animateShirt02();
    });
});

// Função para criar efeito de partículas quando a cor é trocada 
function createParticleEffect(element) {
    for (let i = 0; i < 10; i++) {
        const particle = document.createElement('div');
        particle.style.position = 'absolute';
        particle.style.width = '4px';
        particle.style.height = '4px';
        particle.style.backgroundColor = '#e9c80c';
        particle.style.borderRadius = '50%';
        particle.style.pointerEvents = 'none';
        particle.style.zIndex = '1000';

        const rect = element.getBoundingClientRect();
        particle.style.left = (rect.left + rect.width / 2) + 'px';
        particle.style.top = (rect.top + rect.height / 2) + 'px';

        document.body.appendChild(particle);

        // Animar a partícula
        const angle = (Math.PI * 2 * i) / 10;
        const distance = 50 + Math.random() * 50;
        const duration = 1000 + Math.random() * 500;

        particle.animate([
            {
                transform: 'translate(0, 0) scale(1)',
                opacity: 1
            },
            {
                transform: `translate(${Math.cos(angle) * distance}px, ${Math.sin(angle) * distance}px) scale(0)`,
                opacity: 0
            }
        ], {
            duration: duration,
            easing: 'ease-out'
        }).onfinish = () => {
            particle.remove();
        };
    }
}

// Adicionar efeito de partículas ao trocar cor
const originalChangeColor = changeColor;
changeColor = function (color) {
    const activeOption = document.querySelector('.color-option.active');
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

// Adicionar funcionalidade de teclado
document.addEventListener('keydown', function (event) {
    switch (event.key) {
        case '1':
            changeColor('branca');
            break;
        case '2':
            changeColor('preta');
            break;
        case 'ArrowLeft':
            changeColor('branca');
            break;
        case 'ArrowRight':
            changeColor('preta');
            break;
    }
});

// Função para salvar preferência do usuário
function saveUserPreference() {
    localStorage.setItem('nerdcore_color_preference', currentColor);
    localStorage.setItem('nerdcore_design_preference', currentDesign);
}

// Função para carregar preferência do usuário
function loadUserPreference() {
    const savedColor = localStorage.getItem('nerdcore_color_preference');
    const savedDesign = localStorage.getItem('nerdcore_design_preference');

    if (savedColor && shirtImages[currentDesign][savedColor]) {
        changeColor(savedColor);
    }

    if (savedDesign && shirtImages[savedDesign]) {
        currentDesign = savedDesign;
        updateDemoImages();
    }
}

// Carregar preferências ao inicializar
document.addEventListener('DOMContentLoaded', function () {
    loadUserPreference();
});

// Salvar preferências quando a cor for alterada
const originalChangeColorWithSave = changeColor;
changeColor = function (color) {
    originalChangeColorWithSave(color);
    saveUserPreference();
};


function getIdDaURL() {
    const params = new URLSearchParams(window.location.search);
    return params.get("id");
}

window.onload = async function () {
    const id = getIdDaURL();

    try {
        const response = await fetch("/SiteLoja/produtos/produtos.json"); // caminho absoluto
        const produtos = await response.json();

        // se JSON for array e id começar do 1
        const produto = produtos[id - 0];

        if (produto) {
            document.getElementById("nome-produto").textContent = produto.nome;
            document.getElementById("imagem-produto").src = produto.imagem;
            document.getElementById("imagem-produto").alt = produto.nome;
            document.getElementById("descricao-produto").textContent = produto.descricao;
            document.getElementById("preco-produto").textContent =
                typeof produto.preco === "number"
                    ? `R$ ${produto.preco.toFixed(2).replace('.', ',')}`
                    : (produto.preco || "Preço indisponível.");
        } else {
            document.body.innerHTML = "<h1>Produto não encontrado</h1>";
        }
    } catch (erro) {
        console.error("Erro ao carregar o JSON: ", erro);
        document.body.innerHTML = "<h1>Erro ao carregar o produto.</h1>";
    }
};

