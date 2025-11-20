







form.addEventListener("submit", (evento) => {
  evento.preventDefault();
  checkNome();
 
  const erros = document.querySelectorAll(".botao-campo.error");
  //condicional que impede do programa funcionar se tiver algum campo com erro
  if (erros.length === 0) {
    form.submit();

    
  }
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