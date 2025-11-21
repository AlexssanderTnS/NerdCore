<?php
ob_start();
session_start();
require '../php/login.php'; 
ob_end_clean();

// redireciona se logado e não for nível 0
if (logado() && nivelAcesso() != 0) {
    echo '<script>window.location.href="../../index.php";</script>';
    exit;
}

$mostrarModal = false;
if (isset($_SESSION['cadastro_sucesso'])) {
    $mostrarModal = true;
    unset($_SESSION['cadastro_sucesso']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <link rel="icon" href="../assets/LogoTOPO.png" type="image/x-icon">
  <title>Cadastro</title>
  <link rel="stylesheet" href="../style/cadastro.css">
</head>

<body>

<header class="nerdbar">
    <div class="logo">
        <a href="../../index.php"><img src="../assets/logoroxa.png" alt="logo"></a>
        <h1><a href="../../index.php">NerdCore</a></h1>
    </div>
</header>

<form class="parte1" id="form" action="../php/cadastro.php" method="POST">
    <h1>Cadastre-se no estilo!</h1>

    <main class="bloco1">
        <div class="botao-campo">
            <input type="text" id="nomeCadastro" placeholder="Nome completo" name="nome">
            <p></p>
        </div>
        <div class="botao-campo">
            <input type="text" id="usuarioCadastro" placeholder="Nome de usuário" name="usuario">
            <p></p>
        </div>
        <div class="botao-campo">
            <input type="email" id="emailCadastro" placeholder="E-mail" name="email">
            <p></p>
        </div>
        <div class="botao-campo">
            <input type="password" id="senhaCadastro" placeholder="Senha" name="senha">
            <p></p>
        </div>
        <div class="botao-campo">
            <input type="password" id="confirmar" placeholder="Confirme sua senha" name="confsenha">
            <p></p>
        </div>
        <div class="botao-campo">
            <input type="date" id="date" name="data_nascimento">
            <p></p>
        </div>
    </main>

    <section class="bloco2">
        <div class="botao-campo">
            <input type="text" id="mae" placeholder="Nome materno" name="mae">
            <p></p>
        </div>

        <div class="botao-campo">
            <select name="genero" id="generos">
                <option value="">Gênero</option>
                <option value="Feminino">Feminino</option>
                <option value="Masculino">Masculino</option>
                <option value="Outro">Outro/Prefiro não dizer</option>
            </select>
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="text" id="cpf" maxlength="14" placeholder="CPF" name="cpf">
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="tel" id="celular" placeholder="Celular" name="cll">
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="tel" id="fixo" placeholder="Tel Fixo" name="fixo">
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="text" id="cep" placeholder="CEP" name="cep">
            <p></p>
        </div>
    </section>

    <section class="bloco3">
        <div class="botao-campo">
            <input type="text" id="estado" placeholder="Estado" name="estado">
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="text" id="cidade" placeholder="Cidade" name="cidade">
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="text" id="bairro" placeholder="Bairro" name="bairro">
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="text" id="numero" placeholder="Número" name="numero">
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="text" id="rua" placeholder="Rua" name="rua">
            <p></p>
        </div>

        <div class="botao-campo">
            <input type="text" id="complemento" placeholder="Complemento" name="complemento">
            <p></p>
        </div>
    </section>

    <section class="botao">
        <button type="submit" id="pronto">Pronto!</button>

        <button type="button" id="limpar">Limpar tudo</button>
    </section>

    <dialog id="modalSucesso">
        <p>Cadastro realizado com sucesso!</p>
        <a href="login.php">Fazer login</a>
        <a href="../../index.php">Tela principal</a>
    </dialog>

</form>

<script src="../js/cadastro.js"></script>

<?php if ($mostrarModal): ?>
<script>
document.getElementById("modalSucesso").showModal();
</script>
<?php endif; ?>

</body>
</html>
