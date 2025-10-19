// === ELEMENTOS DO FORMULÁRIO ===
const email = document.getElementById("emailCadastro");
const usuario = document.getElementById("usuarioCadastro");
const genero = document.getElementById("generos");
const senha = document.getElementById("senhaCadastro");
const conSenha = document.getElementById("confirmar");
const nome = document.getElementById("nomeCadastro");
const cpf = document.getElementById("cpf");
const nascimento = document.getElementById("date");
const cel = document.getElementById("celular");
const tel = document.getElementById("fixo");
const mae = document.getElementById("mae");
const cep = document.getElementById("cep");
const estado = document.getElementById("estado");
const cidade = document.getElementById("cidade");
const bairro = document.getElementById("bairro");
const rua = document.getElementById("rua");
const numero = document.getElementById("numero");
const complemento = document.getElementById("complemento");

// Botões
const campos = document.querySelectorAll(".botao-campo input");
const form = document.getElementById("form");
const limpar = document.getElementById("limpar");

// === PADRÕES ===
const emailPadrao = /^[\w]+(\.[\w]+)?@(gmail|hotmail|outlook|email)\.com$/;
const senhaPadrao = /^[a-zA-Z]{8}$/;
const nomePadrao = /^[A-Za-zÀ-ÿ\s]{15,80}$/;
const usuarioPadrao = /^[a-zA-Z]{6}$/;
const cepPadrao = /^[0-9]{8}$/;
const cpfPadrao = /^(?!^(\d)\1{10}$)\d{11}$/;

// === SUBMIT DO FORMULÁRIO ===
form.addEventListener("submit", (evento) => {
  evento.preventDefault();
  // Validações
  checkEmail();
  checkUsuario();
  checkSenha();
  compaSenha();
  checkNome();
  checkGenero();
  cpfVerificador();
  checkCel();
  checkTel();
  checkMae();
  checkEstado();
  checkCidade();
  checkBairro();
  checkRua();
  checkCEP();
  checkNumero();

  const erros = document.querySelectorAll(".botao-campo.error");

  if (erros.length > 0) {
    // Impede envio só se houver erros
    
  } 
  // Envio dos dados para o PHP
   const formData = new FormData();
    formData.append("nome", nome.value);
    formData.append("usuario", usuario.value);
    formData.append("senha", senha.value);
    formData.append("confsenha", conSenha.value);
    formData.append("genero", genero.value);
    formData.append("cpf", cpf.value.replace(/\D/g, ''));
    formData.append("nascimento", nascimento.value);
    formData.append("cll", cel.value.replace(/\D/g, ''));
    formData.append("fixo", tel.value.replace(/\D/g, ''));
    formData.append("mae", mae.value);
    formData.append("cep", cep.value.replace(/\D/g, ''));
    formData.append("estado", estado.value);
    formData.append("email", email.value);
    formData.append("cidade", cidade.value);
    formData.append("bairro", bairro.value);
    formData.append("rua", rua.value);
    formData.append("numero", numero.value);
    formData.append("complemento",complemento ? complemento.value :"");
    
    fetch("../php/cadastro.php", {
      method:"POST",
      body: formData,
    })
    //Captura de erro 
    .then(res => res.text())
    .then(retorno => {
      if(retorno.includes("sucesso")){
        console.log(retorno);
        alert("Cadastro realizado com sucesso!");
        window.location.href = "/SiteLoja/pages/login.html";
      }else{
        alert("Erro no cadastro: " + retorno);
      }
    })
    .catch(erro => {
      alert("Erro na requisição: " + erro);
    });
   });
      
   
   
   


// === BOTÃO LIMPAR ===
limpar.addEventListener("click", (evento) => {
  evento.preventDefault();
  form.reset();
  window.scrollTo({ top: 0, behavior: "smooth" });
});

// === VALIDAÇÕES ===
function checkNome() {
  if (!nomePadrao.test(nome.value)) entradaErro(nome, "O nome deve ter no mínimo 15 caracteres alfabéticos");
}
function checkMae() {
  if (!nomePadrao.test(mae.value)) entradaErro(mae, "O nome deve ter no mínimo 15 caracteres alfabéticos");
}
function checkEmail() {
  if (!emailPadrao.test(email.value)) entradaErro(email, "O email deve conter gmail, hotmail ou outlook");
}
function checkUsuario() {
  if (!usuarioPadrao.test(usuario.value)) entradaErro(usuario, "Seu nome de usuário deve ter exatamente 6 caracteres alfabéticos");
}
function checkSenha() {
  if (!senhaPadrao.test(senha.value)) entradaErro(senha, "Sua senha deve conter exatamente 8 caracteres alfabéticos");
}
function compaSenha() {
  if (senha.value !== conSenha.value || conSenha.value === "") entradaErro(conSenha, "As senhas devem ser iguais");
}
function checkGenero() {
  if (genero.value === "") {
    entradaErro(genero, "Por favor, selecione seu gênero.");
    genero.style.backgroundColor = "#FF0000";
  }
}
function checkCel() { if (cel.value === "") entradaErro(cel, "Número inválido"); }
function checkTel() { if (tel.value === "") entradaErro(tel, "Número inválido"); }
function checkCEP() { if (cep.value === "") entradaErro(cep, "CEP inválido"); }
function checkEstado() { if (estado.value === "") entradaErro(estado, "Digite seu estado"); }
function checkCidade() { if (cidade.value === "") entradaErro(cidade, "Digite sua cidade"); }
function checkBairro() { if (bairro.value === "") entradaErro(bairro, "Digite seu bairro"); }
function checkRua() { if (rua.value === "") entradaErro(rua, "Digite sua rua"); }
function checkNumero() { if (numero.value === "") entradaErro(numero, "Digite o número da sua casa"); }

// === EVENTO MUDANÇA GÊNERO ===
genero.addEventListener("change", () => {
  limparErro(genero);
  genero.style.backgroundColor = "#ffff00";
});

// === FUNÇÕES DE ERRO ===
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
campos.forEach((campo) => {
  campo.addEventListener("input", () => limparErro(campo));
});

// === CEP AUTOMÁTICO ===
cep.addEventListener("blur", buscaCep);
function buscaCep() {
  const cepValue = cep.value.replace(/\D/g, "");
  if (cepValue.length !== 8) { entradaErro(cep, "CEP deve ter 8 dígitos"); return; }
  fetch(`https://viacep.com.br/ws/${cepValue}/json/`)
    .then(res => res.json())
    .then(data => {
      if (data.erro) entradaErro(cep, "CEP não encontrado");
      rua.value = data.logradouro || "";
      bairro.value = data.bairro || "";
      cidade.value = data.localidade || "";
      estado.value = data.uf || "";
    })
    .catch(() => entradaErro(cep, "Erro ao buscar CEP"));
}

// === VALIDAÇÃO CPF ===
function cpfVerificador() {
  const cpfNum = cpf.value.replace(/\D/g, '');
  if (!cpfPadrao.test(cpfNum)) { entradaErro(cpf, "CPF inválido"); return; }

  let soma = 0;
  for (let i = 0; i < 9; i++) soma += parseInt(cpfNum[i]) * (10 - i);
  let digito1 = (soma % 11) < 2 ? 0 : 11 - (soma % 11);
  if (digito1 !== parseInt(cpfNum[9])) { entradaErro(cpf, "CPF inválido"); return; }

  soma = 0;
  for (let i = 0; i < 10; i++) soma += parseInt(cpfNum[i]) * (11 - i);
  let digito2 = (soma % 11) < 2 ? 0 : 11 - (soma % 11);
  if (digito2 !== parseInt(cpfNum[10])) { entradaErro(cpf, "CPF inválido"); return; }
}
