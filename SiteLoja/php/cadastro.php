<?php


if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    require 'conexao.php';
    
    
    $nome = $_POST['nome'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confsenha = $_POST['confsenha'] ?? '';
    $data_nascimento = $_POST['data_nascimento'] ?? ''; // Valor recebido: YYYY-MM-DD
    $mae = $_POST['mae'] ?? '';
    $genero = $_POST['genero'] ?? '';
    
   
    $cpf = preg_replace('/\D/', '', $_POST['cpf'] ?? '');
    $cll = preg_replace('/\D/', '', $_POST['cll'] ?? '');
    $fixo = preg_replace('/\D/', '', $_POST['fixo'] ?? '');
    $cep = preg_replace('/\D/', '', $_POST['cep'] ?? '');
    
    
    $estado = $_POST['estado'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $complemento = $_POST['complemento'] ?? '';
    
    // --- Validações ---
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        erro("E-mail inválido. Por favor, verifique o endereço e tente novamente.");
    }
    
    if (!preg_match("/^[\w]+(\.[\w]+)?@(gmail|hotmail|outlook|email)\.com$/", $email)) {
        die("Endereço de email inválido. Por favor, tente novamente.");
    }

    if (!preg_match("/^[a-zA-Z]{8}$/", $senha)) {
        die("A senha deve conter exatamente 8 letras (sem números e sem espaços).");
    }

    if ($senha !== $confsenha) {
        die("As senhas não coincidem. Por favor, tente novamente.");
    }

    if (!preg_match("/^[A-Za-zÀ-ÿ\s]{15,80}$/", $nome)) {
        die("Nome inválido. Por favor, tente novamente.");
    }

    if (!preg_match("/^[a-zA-Z]{6}$/", $usuario)) {
        die("Nome de usuário inválido. Por favor, tente novamente.");
    }

    if (!preg_match("/^(?!^(\d)\1{10}$)\d{11}$/", $cpf)) {
        die("CPF inválido. Por favor, tente novamente.");
    }

    if (!preg_match("/^[0-9]{8}$/", $cep)) {
        die("CEP inválido. Por favor, tente novamente.");
    }
    //Criptografia da senha 
    $senhacriptografada = password_hash($senha, PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO usuarios (
    nome, 
    usuario, 
    email, 
    senha, 
    data_nascimento, 
    mae, 
    genero,
    cpf,
    cll,
    fixo,
    cep,
    estado,
    cidade,
    bairro,
    numero,
    complemento) VALUES 
    (:nome,
    :usuario,
    :email,
    :senha,
    :data_nascimento,  
    :mae,
    :genero,
    :cpf,
    :cll,
    :fixo,
    :cep,
    :estado,
    :cidade,
    :bairro,
    :numero,
    :complemento)"; 
    
  //Envia os dados das variáveis para o banco de dados
    try {
        $stmt = $pdo->prepare($sql);
        
        
        $params = array(
            ':nome' => $nome,
            ':usuario' => $usuario,
            ':email' => $email,
            ':senha' => $senhacriptografada,
            ':data_nascimento' => $data_nascimento,
            ':mae' => $mae,
            ':genero' => $genero,
            ':cpf' => $cpf,
            ':cll' => $cll,
            ':fixo' => $fixo,
            ':cep' => $cep,
            ':estado' => $estado,
            ':cidade' => $cidade,
            ':bairro' => $bairro,
            ':numero' => $numero,
            ':complemento' => $complemento
        );
        
        $stmt->execute($params);
        header("Location: ../pages/login.php");
       exit();
        
        
    } catch (PDOException $e) {
        
       
        if ($e->getCode() == '23000') {
            die("ERRO_DB: 23000 - Dados já registrados (Email/CPF/Usuário Duplicado).");
        } else {
            die("ERRO_DB: " . $e->getCode() . " - " . $e->getMessage());
        }
    }
}
?>