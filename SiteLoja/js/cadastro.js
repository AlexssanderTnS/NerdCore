//dados
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
const numero = document.getElementById("numero")

//Botões
const campos = document.querySelectorAll(".botao-campo input");
const botao = document.getElementById("pronto");
const form = document.getElementById("form");
const limpar = document.getElementById("limpar")
//Padrões

const emailPadrao = /^[\w]+(\.[\w]+)?@(gmail|hotmail|outlook|email)\.com$/;
const senhaPadrao = /^[a-zA-Z]{8}$/;
const nomePadrao = /^[a-z A-Z]{15,80}$/;
const usuarioPadrao = /^[a-z A-Z]{6}/;
const cepPadrao = /^[0-9]{8}$/;
const cpfPadrao = /^(?!^(\d)\1{10}$)\d{11}$/;


//Botão enviar
form.addEventListener("submit", (evento) => {
  evento.preventDefault();
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
  cpfVerificador();
  checkEstado();
  checkCidade();
  checkBairro();
  checkRua();
  checkCEP();
  checkNumero();
  const erros = document.querySelectorAll(".botao-campo.error");
  //condicional que impede do programa funcionar se tiver algum campo com erro
  if (erros.length === 0) {
    armazenamentoDeDados();
    alert("Usuário Cadastrado com sucesso");
    window.location.href = "login.html";
    form.reset();
  }
});
//Botão de limpar tudo
limpar.addEventListener("click", evento => {
    evento.preventDefault();
    limparTudo();
    
});
//function que faz o cep funcionar
cep.addEventListener("blur", (evento) => {
  buscaCep();
});

//Validação
function checkNome() {
  //Constante para pegar o valor do nome
    const nomeValue = nome.value;
//Condicional para testar se o nome atinge os requesitos ou não
  if (!nomePadrao.test(nomeValue)) {
 //Chamando a function para por a mensagem de erro
    entradaErro(nome, "O nome deve ter no mínimo 6 caracteres alfabéticos");
  }
}
function checkMae() {
  const maeValue = mae.value;
  if (!nomePadrao.test(maeValue)) {
    entradaErro(mae, "O nome deve ter no mínimo 15 caracteres alfabéticos");
  }
}

function checkEmail() {
  const emailValue = email.value;
  if (!emailPadrao.test(emailValue)) {
    entradaErro(
      email,
      "O email deve conter um dos domínios: gmail, hotmail ou outlook "
    );
  }
}

function checkUsuario() {
  const usuarioValue = usuario.value;
  if (!usuarioPadrao.test(usuarioValue)) {
    entradaErro(
      usuario,
      "Seu nome de usuário deve contar exatamente 15  caracteres alfabéticos"
    );
  }
}
function checkSenha() {
  const senhaValue = senha.value;

  if (!senhaPadrao.test(senhaValue)) {
    entradaErro(senha, "Sua senha deve conter exatamente 8 caracteres alfabéticos");
  }
}
//Comparação das senhas
function compaSenha() {
  const conSenhaValue = conSenha.value;
  const senhaValue = senha.value;
  if (senhaValue != conSenhaValue || conSenhaValue === "") {
    entradaErro(conSenha, "As senhas devem ser iguais");
  }
}
function checkGenero() {
  const generoValue = genero.value;
  if (generoValue == "") {
    entradaErro(genero, "Por favor, selecione seu gênero.");
    //deixa o fundo do gênero vermelho
    genero.style.backgroundColor = "#FF0000";
  }
}


function checkCel() {
  const celValue = cel.value;
  if (celValue === "") {
    entradaErro(cel, "Número inválido");
  };
};
function checkTel() {
  const telValue = tel.value;
  if (telValue === "") {
    entradaErro(tel, "Número inválido");
  };
};
function checkCEP() {
  const cepValor = cep.value;
  if (cepValor === "") {
    entradaErro(cep, "CEP inválido");
  };
};
function checkEstado(){
    const estadoValue = estado.value;
    if (estadoValue === ""){
        entradaErro(estado, "Digite seu estado");
    };
};
function checkCidade(){
    const cidadeValue = cidade.value;
    if(cidadeValue ===""){
        entradaErro(cidade, "Digite sua cidade");
    }

}
function checkBairro(){
    const bairroValue = bairro.value;
    if (bairroValue === ""){
        entradaErro(bairro, "Digite seu bairro")
    }
}
function checkRua(){
    const ruaValue = rua.value
    if(ruaValue ===""){
        entradaErro(rua, "Digite sua rua")
    }
}
function checkNumero(){
    const numeroValue = numero.value
    if(numeroValue ===""){
        entradaErro(numero, "Digite o número da sua casa")
    }
}
//erro do gênero
genero.addEventListener("change", () => {
  limparErro(genero);
  genero.style.backgroundColor = "#ffff00";
});

// Limpa todos os campos
function limparTudo(){
    form.reset();
    window.scrollTo({ top: 0, behavior: "smooth" });
};

//function que mostra a mensagem de erro
function entradaErro(entrada, mensagem) {
  const formItem = entrada.parentElement;
  const mensagemTexto = formItem.querySelector("p");

  mensagemTexto.innerText = mensagem;
  formItem.className = "botao-campo error";
  //Rola até o erro
  entrada.scrollIntoView({ behavior: "smooth", block: "center" });
};

//function para tirar a mensagem de erro
function limparErro(entrada) {
  const formItem = entrada.parentElement;
  const mensagemTexto = formItem.querySelector("p");

  mensagemTexto.innerText = ""; //vai limpar a mensagem
  formItem.className = "botao-campo"; // vai remover a classe erro
};
//Loop que limpa todos os inputs
campos.forEach((campo) => {
  campo.addEventListener("input", () => {
    limparErro(campo);
  });
});

function buscaCep() {
  // Pega o valor digitado no campo CEP e remove tudo que não for número (ex: pontos e traços)
  const cepValue = document.getElementById("cep").value.replace(/\D/g, "");

  // Monta a URL da API ViaCEP com o CEP informado
  let linkCep = `https://viacep.com.br/ws/${cepValue}/json/`;

  // Verifica se o CEP tem exatamente 8 dígitos
  if (cepValue.length !== 8) {
    entradaErro(document.getElementById("cep"), "CEP deve ter 8 dígitos");
    return; // Interrompe a função se for inválido
  };

  // Faz uma requisição HTTP GET para a API ViaCEP
  fetch(linkCep)
    .then((response) => response.json()) // Converte a resposta para JSON
    .then((data) => {
      // Se a API retornar erro (ex: CEP inexistente)
      if (data.erro) {
        entradaErro(document.getElementById("cep"), "CEP não encontrado");
      }

      // Preenche automaticamente os campos do formulário com os dados do CEP
      document.getElementById("rua").value = data.logradouro;
      document.getElementById("bairro").value = data.bairro;
      document.getElementById("cidade").value = data.localidade;
      document.getElementById("estado").value = data.uf;
    })
    .catch((err) => {
      // Se ocorrer algum erro na requisição (ex: sem internet, API fora do ar)
      entradaErro(document.getElementById("cep"), "erro ao buscar cep");
      console.error(err); // Mostra o erro no console do navegador
    });
};


//Local Storage
function armazenamentoDeDados() {
  const dadosUsuario = {
    email: email.value,
    nome: nome.value,
    usuario: usuario.value,
    senha: senha.value,
    genero: genero.value,
    cpf: cpf.value,
    nascimento: nascimento.value,
    cel: cel.value,
    tel: tel.value,
    mae: mae.value,
    cep: cep.value,
    rua: rua.value,
    estado: estado.value,
    bairro: bairro.value,
    numero: numero.value,

  };
  localStorage.setItem("usuariosCadastrados", JSON.stringify(dadosUsuario));
};

function cpfVerificador() {
  const cpfNum = cpf.value.replace(/\D/g, '');

  if (!cpfPadrao.test(cpfNum)) {
    entradaErro(cpf, "CPF inválido");
    return;
  }

  // Primeiro dígito verificador
  let soma = 0;
  for (let i = 0; i < 9; i++) {
    soma += parseInt(cpfNum[i]) * (10 - i);
  }

  let digito1 = (soma % 11) < 2 ? 0 : 11 - (soma % 11);

  if (digito1 !== parseInt(cpfNum[9])) {
    entradaErro(cpf, "CPF inválido");
    return;
  }

  // Segundo dígito verificador
  soma = 0;
  for (let i = 0; i < 10; i++) {
    soma += parseInt(cpfNum[i]) * (11 - i);
  }

  let digito2 = (soma % 11) < 2 ? 0 : 11 - (soma % 11);

  if (digito2 !== parseInt(cpfNum[10])) {
    entradaErro(cpf, "CPF inválido");
    return;
  }

 
 
}

