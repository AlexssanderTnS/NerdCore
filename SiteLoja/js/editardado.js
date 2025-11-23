const nome = document.getElementById("nome");
const email = document.getElementById("email");
const usuario = document.getElementById("usuario");
const senha = document.getElementById('senha');
const cel = document.getElementById("cll");
const tel = document.getElementById("fixo");
const cep = document.getElementById("cep");
const estado = document.getElementById("estado");
const cidade = document.getElementById("cidade");
const bairro = document.getElementById("bairro");
const rua = document.getElementById("rua");
const numero = document.getElementById("numero");

const campos = document.querySelectorAll(".botao-campo input");
const botao = document.getElementById("sim");
const form = document.getElementById("form");
const limpar = document.getElementById("limpar")

const emailPadrao = /^[\w]+(\.[\w]+)?@(gmail|hotmail|outlook|email)\.com$/;
const senhaPadrao = /^[a-zA-Z]{8}$/;
const nomePadrao = /^[A-Za-zÀ-ÿ\s]{15,80}$/;
const usuarioPadrao = /^[a-zA-Z]{6}$/;
const cepPadrao = /^[0-9]{8}$/;


form.addEventListener("submit", (evento) => {
  evento.preventDefault();

  checkNome();
  checkEmail();
  checkSenha();
  checkUsuario();

  const erros = document.querySelectorAll(".botao-campo.error");

  // Se houver erro, fecha o modal de confirmação
  if (erros.length > 0) {
    const modal = document.getElementById('modalSucesso');
    if (modal) {
      if (typeof modal.close === 'function') modal.close();
      else modal.style.display = 'none';
    }
    return; // impede submit
  }

  form.submit();
});

function checkNome() {
  //Constante para pegar o valor do nome
    const nomeValue = nome.value;
//Condicional para testar se o nome atinge os requesitos ou não
  if (!nomePadrao.test(nomeValue)) {
 //Chamando a function para por a mensagem de erro
    entradaErro(nome, "O nome deve ter no mínimo 15 caracteres alfabéticos");
  }
}

function checkSenha() {
  // Só valida se o input realmente tiver name="senha", ou seja, o usuário clicou em editar
  if (!senha.hasAttribute('name')) return;

  const senhaValue = senha.value.trim();
  if (!senhaPadrao.test(senhaValue)) {
    entradaErro(senha, "Sua senha deve conter exatamente 8 caracteres alfabéticos");
  }
}


function entradaErro(entrada, mensagem) {
  const formItem = entrada.parentElement;
  const mensagemTexto = formItem.querySelector("p");

  mensagemTexto.innerText = mensagem;
  formItem.className = "botao-campo error";
  //Rola até o erro
  entrada.scrollIntoView({ behavior: "smooth", block: "center" });
};

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
      "Seu nome de usuário deve contar exatamente 6 caracteres alfabéticos"
    );
  }
}



cep.addEventListener("blur", (evento) => {
  buscaCep();
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
    .then((response) => response.json()) 
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

function limparTudo(){
    form.reset();
    campos.forEach((campo) => limparErro(campo));
    window.scrollTo({ top: 0, behavior: "smooth" });
};