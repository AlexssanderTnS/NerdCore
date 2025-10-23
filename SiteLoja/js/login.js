const form = document.getElementById("formLogin");
const usuario = document.getElementById("usuario");
const senha = document.getElementById("senha");
const limpar = document.getElementById("limpar");

form.addEventListener("submit", (evento) => {
  evento.preventDefault(); // impede reload
  validarLogin();
});

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

  // manda pro PHP via fetch (POST normal, não JSON)
  fetch("../php/login.php", {
    method: "POST",
    body: formData,
  })
    .then((res) => res.text())
    .then((resposta) => {
      if (resposta.includes("sucesso")) {
        alert("Login realizado com sucesso!");
        window.location.href = "../../index.html";
      } else {
        entradaErro(senha, "Usuário ou senha incorretos");
      }
    })
    .catch((erro) => {
      console.error("Erro ao enviar dados:", erro);
    });
}

function entradaErro(entrada, mensagem) {
  const formItem = entrada.parentElement;
  const mensagemTexto = formItem.querySelector("p");

  mensagemTexto.innerText = mensagem;
  formItem.className = "botao-campo error";
  entrada.scrollIntoView({ behavior: "smooth", block: "center" });
}

function limparErro(entrada) {
  const formItem = entrada.parentElement;
  const mensagemTexto = formItem.querySelector("p");

  mensagemTexto.innerText = "";
  formItem.className = "botao-campo";
}

const campos = document.querySelectorAll("#formLogin input");
campos.forEach((campo) => {
  campo.addEventListener("input", () => {
    limparErro(campo);
  });
});

function limparCampo() {
  form.reset();
  window.scrollTo({ top: 0, behavior: "smooth" });
}

limpar.addEventListener("click", (evento) => {
  evento.preventDefault();
  limparCampo();
});
