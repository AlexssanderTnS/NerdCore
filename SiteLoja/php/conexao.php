<?php
// Conexão com o banco de dados

//define aonde o banco está hospedado
$localhost = "localhost";
//define o nome do usuário do banco de dados
$user = "root";
//senha do usuário do banco de dados
$pass = "";
//nome do banco de dados
$dbname = "nerdcore";

try {
    // CONEXÃO CORRETA: Conecta APENAS ao HOST para poder executar o CREATE DATABASE
    $con_server = new PDO("mysql:host=" . $localhost, $user, $pass);
    $con_server->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //criação do banco de dados
    $sql_banco = "CREATE DATABASE IF NOT EXISTS $dbname CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";

    $con_server->exec($sql_banco);
     echo "Banco de dados $dbname criado com sucesso!";
} catch (PDOException $e) {
    die("Erro com banco de dados: " . $e->getMessage());
};

try {
    $pdo = new PDO("mysql:dbname=" . $dbname . "; host=" . $localhost, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //tabela do banco de dados
    $usuTable = "CREATE TABLE IF NOT EXISTS usuarios(
        id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        acesso int(1) UNSIGNED NOT NULL DEFAULT 1,
        nome VARCHAR(50) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        usuario VARCHAR(6) UNIQUE NOT NULL,
        senha VARCHAR(60) NOT NULL,
        data_nascimento DATE NOT NULL,
        mae CHAR(50) NOT NULL,
        genero VARCHAR(15) NOT NULL,
        cpf CHAR(11) UNIQUE NOT NULL,
        cll CHAR(11) UNIQUE NOT NULL,
        fixo CHAR(11) UNIQUE NOT NULL,
        cep CHAR(8) NOT NULL,
        estado CHAR(20) NOT NULL,
        cidade VARCHAR(50) NOT NULL,
        bairro VARCHAR(50) NOT NULL,
        numero INT(6) NOT NULL,
        complemento VARCHAR(50) DEFAULT NULL,
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP);";

        
    //executa o para criar a tabela
    $pdo->exec($usuTable);
    
    
$event_log = "CREATE TABLE IF NOT EXISTS event_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    event_type VARCHAR(50) NOT NULL,
    description TEXT,
    metadata JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES usuarios(id) ON DELETE CASCADE
);";


$produtos = "CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nomeProduto VARCHAR(100) NOT NULL,
    descricao TEXT,
    preco DECIMAL(10,2) NOT NULL,
    camisaPreta LONGTEXT,
    camisaBranca LONGTEXT,
    categoria ENUM('camisa', 'caneca') NOT NULL,
    estoque INT DEFAULT 0,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);";
$pdo->exec($produtos);

//Cria o perfil do ADM
$check = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE usuario = ?");
$check->execute(['admin1']);
if ($check->fetchColumn() == 0) {
    $senha = password_hash("nerdcore", PASSWORD_DEFAULT);
    $stmt = $pdo->prepare("INSERT INTO usuarios (nome, email, usuario, senha, data_nascimento, mae, genero, cpf, cll, fixo, cep, estado, cidade, bairro, numero, acesso)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute(['Admin', 'admin@nerdcore.com', 'admin1', $senha, '2000-01-01', 'Mãe Admin', 'Outro', '12345678901', '21999999999', '2122223333', '20000000', 'RJ', 'Rio de Janeiro', 'Centro', 100, 2]);
}

} catch (PDOException $e) {
    die("ERRO na criação da tabela: " . $e->getMessage());
}

?>