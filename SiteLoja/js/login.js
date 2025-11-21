const form = document.getElementById("formLogin");
const usuario = document.getElementById("usuario");
const senha = document.getElementById("senha");
const limpar = document.getElementById("limpar");

const dialogSucesso = document.getElementById("modalSucesso");
// --- EVENTO DE ENVIO DO FORM ---
form.addEventListener("submit", (evento) => {
  evento.preventDefault(); // impede reload
  validarLogin();
});

// --- FUNÇÃO PRINCIPAL DE VALIDAÇÃO ---
function validarLogin() {
  const usuarioValue = usuario.value.trim();
  const senhaValue = senha.value.trim();

  if (usuarioValue === "" || senhaValue === "") {
    entradaErro(usuario, "Preencha todos os campos!");
    entradaErro(senha, "Preencha todos os campos!");
    return;
  }

  // monta os dados pra enviar pro PHP
  const formData = new FormData();
  formData.append("usuario", usuarioValue);
  formData.append("senha", senhaValue);

  // envia pro PHP
  fetch("../php/login.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((resposta) => {
      resposta = resposta.trim(); // remove espaços e quebras de linha

      if (resposta === "sucesso"){
        dialogSucesso.showModal();
        return;
      }else if (resposta === "erroSenha"){
        entradaErro(senha, "Senha incorreta!");
      }else if (resposta ==="erroUsuario"){
        entradaErro(usuario, "Usuário não encontrado!");
      }else{
        entrada(senha, "Erro ao fazer o login!")
      }
    }) 
    .catch((erro) => {
      console.error("Erro ao enviar dados:", erro);
    });
}

// --- FUNÇÃO PARA MOSTRAR ERRO ---
function entradaErro(entrada, mensagem) {
  const formItem = entrada.parentElement;
  const mensagemTexto = formItem.querySelector("p");

  if (mensagemTexto) {
    mensagemTexto.innerText = mensagem;
  }

  formItem.className = "botao-campo error";
  entrada.scrollIntoView({ behavior: "smooth", block: "center" });
}

// --- FUNÇÃO PARA LIMPAR ERRO ---
function limparErro(entrada) {
  const formItem = entrada.parentElement;
  const mensagemTexto = formItem.querySelector("p");

  if (mensagemTexto) {
    mensagemTexto.innerText = "";
  }

  formItem.className = "botao-campo";
}

// --- LIMPA ERROS QUANDO DIGITA NOVAMENTE ---
const campos = document.querySelectorAll("#formLogin input");
campos.forEach((campo) => {
  campo.addEventListener("input", () => {
    limparErro(campo);
  });
});

// --- BOTÃO LIMPAR ---
function limparCampo() {
  form.reset();
  window.scrollTo({ top: 0, behavior: "smooth" });

  // limpa mensagens também
  campos.forEach((campo) => limparErro(campo));
}

limpar.addEventListener("click", (evento) => {
  evento.preventDefault();
  limparCampo();
});
