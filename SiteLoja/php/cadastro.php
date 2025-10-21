<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    require 'conexao.php';
    // Elementos do formulário
    $nome = $_POST['nome'] ?? '';
    $usuario = $_POST['usuario'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $confsenha = $_POST['confsenha'] ?? '';
    $nascimento = $_POST['nascimento'] ?? '';
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

    // --- Teste: exibe valores recebidos ---
    echo "<pre>POST original:\n";
    var_dump($_POST);
    echo "\n--- Campos processados ---\n";
    echo "CPF: $cpf\n";
    echo "Celular: $cll\n";
    echo "Fixo: $fixo\n";
    echo "CEP: $cep\n";
    echo "Complemento: '$complemento'\n";
    echo "</pre>";

    // --- Validações ---
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
    //Puxa os dados para o banco de dados
    try{
        $stmt = $pdo->prepare("INSERT INTO
        usuarios(
        nome, email, usuario, senha, data_nascimento, mae, genero, cpf, cll, fixo, cep, estado, cidade, bairro, numero, complemento)
        VALUES
        (:nome, :email, :usuario, :senha, :nascimento, :mae, :genero, :cpf, :cll, :fixo, :cep, :estado, :cidade, :bairro, :numero, :complemento)");
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':usuario' => $usuario,
            ':senha' => $senhacriptografada,
            ':nascimento' => $nascimento,
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
        ]);    
}catch (PDOException $e){
    die ("Erro ao cadastrar usuário: " . $e->getMessage());
}
    echo "<p>Usuário cadastrado com sucesso!</p>";
}
?>