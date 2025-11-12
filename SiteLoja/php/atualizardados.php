<?php
session_start();
require_once '../php/atualizardados.php'; // arquivo de conexão com o banco

// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: ../pages/editordado.php");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// Atualiza dados, caso o formulário tenha sido enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $telefone_fixo = $_POST['telefone_fixo'];
    $celular = $_POST['celular'];
    $cidade = $_POST['cidade'];
    $bairro = $_POST['bairro'];
    $endereco = $_POST['endereco'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];

    $sql = "UPDATE usuarios 
            SET nome=?, email=?, telefone=?, telefone_fixo=?, celular=?, cidade=?, bairro=?, endereco=?, rua=?, numero=? 
            WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $nome, $email, $telefone, $telefone_fixo, $celular, $cidade, $bairro, $endereco, $rua, $numero, $id_usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $mensagem = "Dados atualizados com sucesso!";
    } else {
        $mensagem = "Nenhuma alteração realizada.";
    }
}

// Busca os dados atuais do usuário
$sql = "SELECT * FROM usuarios WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>