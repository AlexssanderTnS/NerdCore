<?php
// Conexão com o banco de dados

//define aonde o banco está hospedado
$localhost = "localhost";
//define o nome do usuário do banco de dados
$user = "root";
//senha do usuário do banco de dados
$pass = "";
//nome do banco de dados
$dbname = "nerdcore_logins";

try {
    $pdo = new PDO ("mysql:dbname=".$dbname."; host=".$localhost, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch (PDOException $e) {
    echo "Erro com banco de dados: ".$e->getMessage();
    exit;
}


?>