<?php
  if ($_SERVER['REQUEST_METHOD'] === "POST") {

    //conexão com o banco de dados
    

    //Elementos do formulário
    $nome = $_POST['nome'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confsenha =$_POST['confsenha'] ?? '';
    $data_nascimento = $_POST['date'] ?? '';
    $mae =  $_POST['mae'] ?? '';
    $genero = $_POST['genero'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $cll = $_POST['cll'] ?? '';
    $fixo = $_POST['fixo'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $complemento = $_POST['complemento'] ?? '';


    //Validações dos campos

    if (!preg_match("/^[\w]+(\.[\w]+)?@(gmail|hotmail|outlook|email)\.com$/", $email)){
         echo ("Endereço de email inválido. Por favor, tente novamente.");
    } 

    if (!preg_match("/^[a-zA-Z]{8}$/", $senha)) {
        die("A senha deve conter exatamente 8 letras (sem números e sem espaços).");
    }
    
    if ($senha !== $confsenha) {
        
    }else{
        die("As senhas não coincidem. Por favor, tente novamente.");
    }
     
    if (!preg_match("/^[A-Za-zÀ-ÿ\s]{15,80}$/", $nome)){
    die("Nome inválido. Por favor, tente novamente.");
    }

    if (!preg_match("/^[a-zA-Z]{6}$/", $usuario)){
        die("Nome de usuário inválido. Por favor, tente novamente.");
    }

    if (!preg_match("/^(?!^(\d)\1{14}$)\d{14}$/", $cpf)){
        die("CPF iválido . Por favor, tente novamente.");
    }

    if (!preg_match("/^[0-9]{8}$/", $cep)){
        die("CEP inválido. Por favor, tente novamente.");
    }


   //Criptograia da senha
   $senhacriptografada = password_hash($senha, PASSWORD_DEFAULT);

    
   echo "<p>Usuário cadastrado com sucesso!</p>";

   
  }
?>