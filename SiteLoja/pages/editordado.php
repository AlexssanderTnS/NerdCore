<?php
ob_start();
session_start();
require '../php/conexao.php';
ob_end_clean();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// Busca os dados do usuário logado
$sql = "SELECT * FROM usuarios WHERE user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit();
}

$modalFeedback = null;
$mensagem = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $campos = [
    'nome' => $_POST['nome'] ?? '',
    'email' => $_POST['email'] ?? '',
    'usuario' => $_POST['usuario'] ?? '',
    'cll' => $_POST['cll'] ?? '',
    'fixo' => $_POST['fixo'] ?? '',
    'cep' => $_POST['cep'] ?? '',
    'estado' => $_POST['estado'] ?? '',
    'rua' => $_POST['rua'] ?? '',
    'cidade' => $_POST['cidade'] ?? '',
    'bairro' => $_POST['bairro'] ?? '',
    'numero' => $_POST['numero'] ?? '',
    'complemento' => $_POST['complemento'] ?? ''
];

$nova_senha = $_POST['senha'] ?? '';
if (!empty($nova_senha)) {
    $campos['senha'] = password_hash($nova_senha, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET 
                nome = :nome,
                email = :email,
                usuario = :usuario,
                senha = :senha,
                cll = :cll,
                fixo = :fixo,
                cep = :cep,
                estado = :estado,
                rua = :rua,
                cidade = :cidade,
                bairro = :bairro,
                numero = :numero,
                complemento = :complemento
            WHERE user_id = :user_id";
} else {
    $sql = "UPDATE usuarios SET 
                nome = :nome,
                email = :email,
                usuario = :usuario,
                cll = :cll,
                fixo = :fixo,
                cep = :cep,
                estado = :estado,
                rua = :rua,
                cidade = :cidade,
                bairro = :bairro,
                numero = :numero,
                complemento = :complemento
            WHERE user_id = :user_id";
}

$campos['user_id'] = $id_usuario;
$stmt = $pdo->prepare($sql);
    if ($stmt->execute($campos)) {

        // guarda o modal para imprimir DENTRO do <body>
        $modalFeedback = "
        <dialog id='modalFeedback'>
            
                <p>Dados atualizados com sucesso!</p>
                <a href='../../index.php'>Ir para a página principal</a>
            
        </dialog>
        ";

        $_SESSION['usuario_nome'] = $_POST['usuario'];
        $usuario = array_merge($usuario, $campos);

    } else {
        $mensagem = 'Erro ao atualizar os dados.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../style/editordado.css"/>
    <title>Editar Perfil | NerdCore</title>
    <style>
        /* CSS mínimo para garantir dialog centralizado em navegadores que não aplicam estilos */
        dialog { border: none; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,.2); }
        dialog::backdrop { background: rgba(0,0,0,0.4); }
    </style>
</head>
<body>

<?php
// imprime o modal de feedback já dentro do body (sem atributo open)
if ($modalFeedback) echo $modalFeedback;
?>

<header class="nerdbar">
    <div class="logo">
        <img src="../assets/logoroxa.png" alt="logo">
        <h1><a href="../../index.php">NerdCore</a></h1>
    </div>
    <div class="navbar">
        <span id="menu" class="material-symbols-outlined" onclick="clickMenu()">menu</span>
        <ul id="menu-list">
            <nav class="link">
                <a href="../../index.php">Início</a>
                <a href="../pages/grupo.php">Quem Somos</a>

                <div class='dropdown'>
                    <a onclick='dropdownToggle()'>Produtos <img src='../assets/arrow.svg' alt=''/></a>
                    <div class='dropdown-content'>
                        <a href='../../index.php#main'>Camisetas</a>
                        <a href='../pages/producao.php'>Canecas</a>
                    </div>
                </div>

                <?php
                if (isset($_SESSION['usuario_nome']) && $_SESSION['usuario_acesso'] == 2) {
                    echo "
                    <div class='dropdown'>
                        <a>{$_SESSION['usuario_nome']}</a>
                        <div class='dropdown-content'>
                            <a href='../pages/adm.php'>Painel Admin</a>
                            <a href='../php/logout.php'>Logout</a>
                        </div>
                    </div>";
                } elseif (isset($_SESSION['usuario_nome'])) {
                    echo "
                    <div class='dropdown'>
                        <a>{$_SESSION['usuario_nome']}</a>
                        <div class='dropdown-content'>
                            <a href='editorinfo.php'>Perfil</a>
                            <a href='../php/logout.php'>Logout</a>
                        </div>
                    </div>";
                } else {
                    echo '<a href="../pages/cadastro.php">Cadastre-se</a>';
                    echo '<a href="../pages/login.php">Login</a>';
                }
                ?>
            </nav>
        </ul>
    </div>
</header>

<main>
    <div class="registro-container">
        <h2>Suas Informações</h2>
        <?php if (isset($mensagem)) echo "<p class='mensagem'>$mensagem</p>"; ?>

        <form method="POST" id="form">
            <div class="botao-campo">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('nome')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('email')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario['usuario'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('usuario')">Editar</button>
                <p>erro</p>
            </div>

 <div class="botao-campo">
    <label for="senha">Senha</label>
    <!-- input apenas visual, não envia nada -->
    <input type="password" id="senha" value="12345678" readonly style="text-security: disc;">
    <button type="button" onclick="habilitar('senha')">Editar</button>
    <p>erro</p>
</div>



            <div class="botao-campo">
                <label for="cll">Celular</label>
                <input type="text" id="cll" name="cll" value="<?= htmlspecialchars($usuario['cll'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('cll')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="fixo">Telefone Fixo</label>
                <input type="text" id="fixo" name="fixo" value="<?= htmlspecialchars($usuario['fixo'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('fixo')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($usuario['cep'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('cep')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($usuario['estado'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('estado')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="rua">Rua</label>
                <input type="text" id="rua" name="rua" value="<?= htmlspecialchars($usuario['rua'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('rua')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($usuario['cidade'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('cidade')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" value="<?= htmlspecialchars($usuario['bairro'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('bairro')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="numero">Número</label>
                <input type="text" id="numero" name="numero" value="<?= htmlspecialchars($usuario['numero'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('numero')">Editar</button>
                <p>erro</p>
            </div>

            <div class="botao-campo">
                <label for="complemento">Complemento</label>
                <input type="text" id="complemento" name="complemento" value="<?= htmlspecialchars($usuario['complemento'] ?? '') ?>" readonly>
                <button type="button" onclick="habilitar('complemento')">Editar</button>
                <p>erro</p>
            </div>

            <br><br>
            <button type="button" onclick="abrirModal()">Salvar alterações</button>

            <dialog id="modalSucesso">
                <div style="padding:18px; max-width:420px; text-align:center;">
                    <p>Tem certeza que deseja editar seus dados?</p>
                    <div style="display:flex; gap:10px; justify-content:center; margin-top:12px;">
                        <button type="button" onclick="fecharModal()">Não</button>
                        <button id="sim" type="submit">Sim</button>
                    </div>
                </div>
            </dialog>

        </form>

        <p><a href="../../index.php">Voltar ao Início</a></p>
    </div>
</main>

<footer class="footer">
    <div class="footer-logo">
        <h4>NerdCore LTDA.</h4>
        <img src="../assets/LogoTOPO.png" alt="Logo NerdCore">
    </div>

    <div class="footer-content">
        <h4>Nossos Links</h4>
        <ul>
            <li><a href="#">Política de Privacidade</a></li>
            <li><a href="#">Termos de Uso</a></li>
            <li><a href="./grupo.php">Sobre Nós</a></li>
            <li><a href="#">Contato</a></li>
        </ul>
    </div>
</footer>

<script src="../js/global.js"></script>
<script src="../js/editardado.js"></script>

<script>
function habilitar(id) {
    const campo = document.getElementById(id);
    if (campo) {
        campo.removeAttribute('readonly');
        campo.setAttribute('name', 'senha'); // agora sim será enviado
        campo.value = ''; // limpa para digitar nova senha
        campo.focus();
    }
}
function clickMenu() {
    const menu = document.getElementById('menu-list');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
}
function dropdownToggle() {
    const dropdowns = document.querySelectorAll('.dropdown-content');
    dropdowns.forEach(d => d.classList.toggle('show'));
}
function abrirModal() {
    const d = document.getElementById('modalSucesso');
    if (!d) return;
    if (typeof d.showModal === 'function') d.showModal();
    else d.style.display = 'block';
}
function fecharModal() {
    const d = document.getElementById('modalSucesso');
    if (!d) return;
    if (typeof d.close === 'function') d.close();
    else d.style.display = 'none';
    // restaura caso necessário
}

// Se o PHP definiu o modalFeedback, abre ele com segurança após DOM carregar
document.addEventListener('DOMContentLoaded', () => {
    const modalFeedback = document.getElementById('modalFeedback');
    if (modalFeedback) {
        // se o modal de confirmação estiver aberto, fecha
        const confirmDialog = document.getElementById('modalSucesso');
        try { if (confirmDialog && typeof confirmDialog.close === 'function') confirmDialog.close(); } catch(e){}

        if (typeof modalFeedback.showModal === 'function') {
            modalFeedback.showModal();
        } else {
            modalFeedback.style.display = 'block';
        }
    }
});
</script>

</body>
</html>
