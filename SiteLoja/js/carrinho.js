// ==========================
//  SISTEMA DE CARRINHO DE COMPRAS COM PÁGINA DE VISUALIZAÇÃO
// ==========================

class CarrinhoCompras {
    constructor() {
        this.itens = this.carregarCarrinho();
        this.inicializarEventos();
        this.atualizarContadorCarrinho();
    }

    // Carrega o carrinho do localStorage
    carregarCarrinho() {
        const carrinho = localStorage.getItem('nerdcore_carrinho');
        return carrinho ? JSON.parse(carrinho) : [];
    }

    // Salva o carrinho no localStorage
    salvarCarrinho() {
        localStorage.setItem('nerdcore_carrinho', JSON.stringify(this.itens));
        this.atualizarContadorCarrinho();
    }

    // Adiciona item ao carrinho
    adicionarItem(produto) {
        const itemExistente = this.itens.find(item => 
            item.id === produto.id && 
            item.cor === produto.cor && 
            item.tamanho === produto.tamanho
        );

        if (itemExistente) {
            itemExistente.quantidade += 1;
        } else {
            this.itens.push({
                id: produto.id,
                nome: produto.nome,
                preco: produto.preco,
                cor: produto.cor,
                tamanho: produto.tamanho,
                imagem: produto.imagem,
                quantidade: 1
            });
        }

        this.salvarCarrinho();
        this.mostrarNotificacao(`${produto.nome} adicionado ao carrinho!`);
        this.criarEfeitoParticulas();
    }

    // Remove item do carrinho
    removerItem(index) {
        this.itens.splice(index, 1);
        this.salvarCarrinho();
        this.atualizarVisualizacaoCarrinho();
    }

    // Atualiza quantidade de um item
    atualizarQuantidade(index, novaQuantidade) {
        if (novaQuantidade <= 0) {
            this.removerItem(index);
        } else {
            this.itens[index].quantidade = novaQuantidade;
            this.salvarCarrinho();
            this.atualizarVisualizacaoCarrinho();
        }
    }

    // Calcula total do carrinho
    calcularTotal() {
        return this.itens.reduce((total, item) => total + (item.preco * item.quantidade), 0);
    }

    // Atualiza contador do carrinho no header
    atualizarContadorCarrinho() {
        const contador = document.getElementById('carrinho-contador');
        const totalItens = this.itens.reduce((total, item) => total + item.quantidade, 0);
        
        if (contador) {
            contador.textContent = totalItens;
            contador.style.display = totalItens > 0 ? 'block' : 'none';
        }
    }

    // Mostra notificação
    mostrarNotificacao(mensagem) {
        // Remove notificação existente se houver
        const notificacaoExistente = document.querySelector('.notificacao-carrinho');
        if (notificacaoExistente) {
            notificacaoExistente.remove();
        }

        const notificacao = document.createElement('div');
        notificacao.className = 'notificacao-carrinho';
        notificacao.textContent = mensagem;
        notificacao.style.cssText = `
            position: fixed;
            top: 150px;
            right: 20px;
            background-color: #e9c80c;
            color: #0a0a2a;
            padding: 15px 20px;
            border-radius: 10px;
            font-family: 'Press Start 2P', monospace;
            font-size: 12px;
            z-index: 1000;
            box-shadow: 0 0 20px rgba(233, 200, 12, 0.8);
            animation: slideIn 0.5s ease-out;
        `;

        document.body.appendChild(notificacao);

        // Remove a notificação após 3 segundos
        setTimeout(() => {
            notificacao.style.animation = 'slideOut 0.5s ease-in';
            setTimeout(() => notificacao.remove(), 500);
        }, 3000);
    }

    // Cria efeito de partículas
    criarEfeitoParticulas() {
        for (let i = 0; i < 8; i++) {
            const particula = document.createElement('div');
            particula.style.cssText = `
                position: fixed;
                width: 6px;
                height: 6px;
                background-color: #e9c80c;
                border-radius: 50%;
                pointer-events: none;
                z-index: 1000;
                top: 50%;
                left: 50%;
            `;

            document.body.appendChild(particula);

            const angulo = (Math.PI * 2 * i) / 8;
            const distancia = 80 + Math.random() * 40;
            const duracao = 800 + Math.random() * 400;

            particula.animate([
                {
                    transform: 'translate(-50%, -50%) scale(1)',
                    opacity: 1
                },
                {
                    transform: `translate(${Math.cos(angulo) * distancia - 50}px, ${Math.sin(angulo) * distancia - 50}px) scale(0)`,
                    opacity: 0
                }
            ], {
                duration: duracao,
                easing: 'ease-out'
            }).onfinish = () => particula.remove();
        }
    }

    // Abre página de carrinho
    abrirCarrinho() {
        window.location.href = '/SiteLoja/pages/carrinho.html';
    }

    // Atualiza visualização do carrinho
    atualizarVisualizacaoCarrinho() {
        // Esta função será chamada quando a página de carrinho estiver aberta
        const containerItens = document.getElementById('itens-carrinho');
        if (containerItens) {
            containerItens.innerHTML = this.gerarHTMLItens();
            this.adicionarEventosItens();
            this.atualizarTotalCarrinho();
        }
    }

    // Gera HTML dos itens
    gerarHTMLItens() {
        if (this.itens.length === 0) {
            return `
                <div style="
                    text-align: center;
                    padding: 40px;
                    color: #f5f5f5;
                    font-family: 'Press Start 2P', monospace;
                    font-size: 14px;
                    grid-column: 1 / -1;
                ">
                    Seu carrinho está vazio
                </div>
            `;
        }

        let html = '';
        this.itens.forEach((item, index) => {
            html += `
                <div class="item-carrinho-card" style="
                    background-color: #0a0a2a;
                    border: 2px solid #e9c80c;
                    border-radius: 15px;
                    padding: 20px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    text-align: center;
                    transition: all 0.3s ease;
                    position: relative;
                ">
                    <img src="${item.imagem}" alt="${item.nome}" style="
                        width: 150px;
                        height: 150px;
                        object-fit: contain;
                        margin-bottom: 15px;
                        border-radius: 10px;
                        background: rgba(233, 200, 12, 0.1);
                        padding: 10px;
                    ">
                    
                    <h3 style="
                        color: #e9c80c;
                        font-family: 'Press Start 2P', monospace;
                        font-size: 14px;
                        margin-bottom: 10px;
                    ">${item.nome}</h3>
                    
                    <div style="
                        color: #f5f5f5;
                        font-family: 'Press Start 2P', monospace;
                        font-size: 11px;
                        margin-bottom: 15px;
                        line-height: 1.6;
                    ">
                        <div>Cor: <span style="color: #e9c80c;">${item.cor}</span></div>
                        <div>Tamanho: <span style="color: #e9c80c;">${item.tamanho}</span></div>
                        <div>Preço: <span style="color: #ffcc00;">R$ ${item.preco.toFixed(2).replace('.', ',')}</span></div>
                    </div>
                    
                    <div style="
                        display: flex;
                        align-items: center;
                        gap: 10px;
                        margin-bottom: 15px;
                        background-color: rgba(233, 200, 12, 0.1);
                        padding: 10px;
                        border-radius: 10px;
                    ">
                        <button class="diminuir-qtd" data-index="${index}" style="
                            background-color: #e9c80c;
                            border: none;
                            width: 30px;
                            height: 30px;
                            border-radius: 5px;
                            cursor: pointer;
                            font-family: 'Press Start 2P', monospace;
                            font-size: 14px;
                            transition: all 0.2s ease;
                        ">−</button>
                        
                        <span style="
                            color: #f5f5f5;
                            font-family: 'Press Start 2P', monospace;
                            font-size: 14px;
                            min-width: 30px;
                            text-align: center;
                        ">${item.quantidade}</span>
                        
                        <button class="aumentar-qtd" data-index="${index}" style="
                            background-color: #e9c80c;
                            border: none;
                            width: 30px;
                            height: 30px;
                            border-radius: 5px;
                            cursor: pointer;
                            font-family: 'Press Start 2P', monospace;
                            font-size: 14px;
                            transition: all 0.2s ease;
                        ">+</button>
                    </div>
                    
                    <div style="
                        color: #ffcc00;
                        font-family: 'Press Start 2P', monospace;
                        font-size: 12px;
                        margin-bottom: 15px;
                    ">
                        Subtotal: R$ ${(item.preco * item.quantidade).toFixed(2).replace('.', ',')}
                    </div>
                    
                    <button class="remover-item" data-index="${index}" style="
                        background-color: #ff4444;
                        border: none;
                        color: white;
                        padding: 10px 15px;
                        border-radius: 8px;
                        cursor: pointer;
                        font-family: 'Press Start 2P', monospace;
                        font-size: 11px;
                        transition: all 0.2s ease;
                        width: 100%;
                    ">Remover</button>
                </div>
            `;
        });

        return html;
    }

    // Adiciona eventos aos itens
    adicionarEventosItens() {
        document.querySelectorAll('.diminuir-qtd').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.target.dataset.index);
                this.atualizarQuantidade(index, this.itens[index].quantidade - 1);
            });
        });

        document.querySelectorAll('.aumentar-qtd').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.target.dataset.index);
                this.atualizarQuantidade(index, this.itens[index].quantidade + 1);
            });
        });

        document.querySelectorAll('.remover-item').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const index = parseInt(e.target.dataset.index);
                this.removerItem(index);
            });
        });
    }

    // Atualiza total do carrinho
    atualizarTotalCarrinho() {
        const totalElement = document.getElementById('total-carrinho');
        if (totalElement) {
            const total = this.calcularTotal();
            totalElement.textContent = `R$ ${total.toFixed(2).replace('.', ',')}`;
        }
    }

    // Inicializa eventos
    inicializarEventos() {
        // Adiciona CSS das animações
        this.adicionarCSS();
        
        // Adiciona botão do carrinho ao header se não existir
        this.adicionarBotaoCarrinho();
    }

    // Adiciona CSS necessário
    adicionarCSS() {
        const style = document.createElement('style');
        style.textContent = `
            @keyframes slideIn {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideOut {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }

            .botao-carrinho {
                position: relative;
                background-color: #e9c80c;
                color: #0a0a2a;
                border: none;
                padding: 10px 15px;
                border-radius: 10px;
                font-family: 'Press Start 2P', monospace;
                font-size: 12px;
                cursor: pointer;
                transition: all 0.3s ease;
                margin-left: 20px;
            }

            .botao-carrinho:hover {
                background-color: #f5f5f5;
                transform: scale(1.05);
            }

            .carrinho-contador {
                position: absolute;
                top: -8px;
                right: -8px;
                background-color: #ff4444;
                color: white;
                border-radius: 50%;
                width: 20px;
                height: 20px;
                font-size: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Press Start 2P', monospace;
            }

            .item-carrinho-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 0 20px rgba(233, 200, 12, 0.6);
            }

            .diminuir-qtd:hover,
            .aumentar-qtd:hover {
                background-color: #f5f5f5;
                transform: scale(1.1);
            }

            .remover-item:hover {
                background-color: #ff6666;
                transform: scale(1.05);
            }
        `;
        document.head.appendChild(style);
    }

    // Adiciona botão do carrinho ao header
    adicionarBotaoCarrinho() {
        const navbar = document.querySelector('.navbar nav');
        if (navbar && !document.getElementById('botao-carrinho')) {
            const botaoCarrinho = document.createElement('button');
            botaoCarrinho.id = 'botao-carrinho';
            botaoCarrinho.className = 'botao-carrinho';
            botaoCarrinho.innerHTML = `
                🛒 Carrinho
                <span id="carrinho-contador" class="carrinho-contador" style="display: none;">0</span>
            `;
            
            botaoCarrinho.addEventListener('click', () => {
                this.abrirCarrinho();
            });

            navbar.appendChild(botaoCarrinho);
        }
    }
}

// Instância global do carrinho
let carrinho;

// Inicializa o carrinho quando o DOM estiver carregado
document.addEventListener('DOMContentLoaded', () => {
    carrinho = new CarrinhoCompras();
});

// ==========================
//  FUNÇÕES PARA ADICIONAR AO CARRINHO
// ==========================

// Função para adicionar ao carrinho na página de compras
function adicionarAoCarrinho() {
    if (!carrinho) {
        console.error('Carrinho não inicializado');
        return;
    }

    const nomeProduto = document.getElementById('nome-produto').textContent;
    const precoProduto = parseFloat(document.getElementById('preco-produto').textContent.replace('R$ ', '').replace(',', '.'));
    const tamanhoSelecionado = document.getElementById('tamanho').value;
    const imagemProduto = document.getElementById('imagem-produto').src;
    
    // Determina a cor atual baseada na classe ativa
    const corAtiva = document.querySelector('.color-option.active');
    const corSelecionada = corAtiva ? corAtiva.dataset.color : 'branca';

    const produto = {
        id: `${currentDesign}_${corSelecionada}_${tamanhoSelecionado}`,
        nome: nomeProduto,
        preco: precoProduto,
        cor: corSelecionada,
        tamanho: tamanhoSelecionado,
        imagem: imagemProduto
    };

    carrinho.adicionarItem(produto);
}

// Função para adicionar ao carrinho na página inicial
function adicionarAoCarrinhoHome(elemento) {
    if (!carrinho) {
        console.error('Carrinho não inicializado');
        return;
    }

    const id = elemento.getAttribute('data-id');
    const nome = elemento.getAttribute('data-nome') || 'Camisa NerdCore';
    const preco = parseFloat(elemento.getAttribute('data-preco') || '49.99');
    const imagem = elemento.src;

    const produto = {
        id: `${id}_branca_M`,
        nome: nome,
        preco: preco,
        cor: 'branca',
        tamanho: 'M',
        imagem: imagem
    };

    carrinho.adicionarItem(produto);
}