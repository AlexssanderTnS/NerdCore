<?php
require 'conexao.php';

// Regex de validação
$formulario = [
    'nome'=>'/^[a-zA-Z\s]{15,80}$/',
    'usuario'=>'/^[a-zA-Z0-9]{6}$/',
    'email'=>'/^[a-zA-Z0-9._%+\-$#]+@(gmail|yahoo|outlook)\.com$/',
    'senha'=>'/^[a-zA-Z]{8}$/',
    'confirmaSenha'=>'/^[a-zA-Z]{8}$/',
    'data'=>'/^\d{4}-\d{2}-\d{2}$/',
    'genero' =>'/^(masculino|feminino|outro)$/',
    'mae'=>'/^[a-zA-Z\s]{15,80}$/',
    'cpf'=>'/^\d{3}\.?\d{3}\.?\d{3}-?\d{2}$/',
    'cel' => '/^\(?\d{2}\)?\s?\d{4,5}-?\d{4}$/',
    'tel' => '/^\(?\d{2}\)?\s?\d{4}-?\d{4}$/',
    'cep'=>'/^\d{5}-?\d{3}$/',
    'estado'=>'/^[a-zA-Z]{2,50}$/',
    'cidade'=>'/^[a-zA-Z\s]{5,50}$/',
    'bairro'=>'/^[a-zA-Z\s]{5,50}$/',
    'rua'=>'/^[a-zA-Z0-9\s]{5,100}$/',
    'numero'=>'/^[0-9]{1,5}$/',
    'complemento'=>'/^[a-zA-Z0-9\s,.-]{0,100}$/'
];

// Função para validar
function validarCampo($nomeCampo, $regex) {
    if (!isset($_POST[$nomeCampo]) || !preg_match($regex, trim($_POST[$nomeCampo]))) {
        die("Campo $nomeCampo inválido!");
    }
    return trim($_POST[$nomeCampo]);
}

// Validando cada campo
$nome = validarCampo('nome', $formulario['nome']);
$usuario = validarCampo('usuario', $formulario['usuario']);
$email = validarCampo('email', $formulario['email']);
$senha = validarCampo('senha', $formulario['senha']);
$confirmaSenha = validarCampo('confirmaSenha', $formulario['confirmaSenha']);
$data = validarCampo('data', $formulario['data']);
$genero = validarCampo('genero', $formulario['genero']);
$mae = validarCampo('mae', $formulario['mae']);
$cpf = validarCampo('cpf', $formulario['cpf']);
$cel = validarCampo('cel', $formulario['cel']);
$tel = validarCampo('tel', $formulario['tel']);
$cep = validarCampo('cep', $formulario['cep']);
$estado = validarCampo('estado', $formulario['estado']);
$cidade = validarCampo('cidade', $formulario['cidade']);
$bairro = validarCampo('bairro', $formulario['bairro']);
$rua = validarCampo('rua', $formulario['rua']);
$numero = validarCampo('numero', $formulario['numero']);
$complemento = validarCampo('complemento', $formulario['complemento']);

// Verificação de senha
if ($senha !== $confirmaSenha) {
    die("As senhas não coincidem!");
}
?>
