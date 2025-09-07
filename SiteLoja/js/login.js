const form = document.getElementById("formLogin");
const usuario = document.getElementById("usuario");
const senha = document.getElementById("senha");
const dados = JSON.parse(localStorage.getItem("usuariosCadastrados"));

const campos = document.querySelectorAll('#formLogin input');
const limpar = document.getElementById("limpar")
form.addEventListener("submit", (evento) => {
    evento.preventDefault();
    validarLogin();
});

function validarLogin() {
    const usuarioValue = usuario.value.trim();
    const senhaValue = senha.value.trim();

    // Verifica se dados existe e se usuário e senha batem
    if (dados && usuarioValue === dados.usuario && senhaValue === dados.senha) {
        alert("Login realizado com sucesso!");
        window.location.href = "index.html";
    } else {
        if (!dados || usuarioValue !== dados.usuario) {
            entradaErro(usuario, "Usuário incorreto");
        } 
        if (!dados || senhaValue !== dados.senha) {
            entradaErro(senha, "Senha incorreta");
        }
    }
}

function entradaErro(entrada, mensagem) {
    const formItem = entrada.parentElement;
    const mensagemTexto = formItem.querySelector('p');

    mensagemTexto.innerText = mensagem;
    formItem.className = "botao-campo error";
    entrada.scrollIntoView({ behavior: "smooth", block: "center" });
}
function limparErro(entrada){
    const formItem = entrada.parentElement;
    const mensagemTexto = formItem.querySelector('p');

    mensagemTexto.innerText =""; //vai limpar a mensagem
    formItem.className = "botao-campo"; // vai remover a classe erro
}
//Loop que limpa todos os inputs
campos.forEach (campo => {
    campo.addEventListener('input', () =>{
        limparErro(campo)
    })
})

function limparCampo(){
    form.reset()
    window.scrollTo({ top: 0, behavior: "smooth" });
}

limpar.addEventListener("click", evento => {
    evento.preventDefault();
    limparCampo();
    
});