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
        nome VARCHAR(50) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        usuario VARCHAR(6) UNIQUE NOT NULL,
        senha CHAR(8) NOT NULL,
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
        numero INT(6) NOT NULL);";
    //executa o para criar a tabela
    $pdo->exec($usuTable);
    echo "Tabela criada com sucesso!";

    $team = "CREATE TABLE IF NOT EXISTS equipe(
        id_func INT(11) AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        cargo VARCHAR(100) NOT NULL,
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
    $pdo->exec($team);
    echo "Tabela 'equipe' criada/verificada com sucesso!<br>";
} catch (PDOException $e) {
    die("ERRO na criação da tabela: " . $e->getMessage());
}
echo "Conexão com o banco de dados realizada com sucesso!";
