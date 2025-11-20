<?php
ob_start();
session_start();
require '../php/conexao.php'; // usa o mesmo conexao.php que cria o banco e o objeto $pdo
ob_end_clean();
// Verifica se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

$id_usuario = $_SESSION['usuario_id'];

// Busca os dados do usuário logado
$sql = "SELECT * FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id_usuario, PDO::PARAM_INT);
$stmt->execute();
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuário não encontrado.";
    exit();
}

// Atualiza os dados caso o formulário seja enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $campos = [
        'nome' => $_POST['nome'],
        'email' => $_POST['email'],
        'usuario' => $_POST['usuario'],
        'cll' => $_POST['cll'],
        'fixo' => $_POST['fixo'],
        'cep' => $_POST['cep'],
        'estado' => $_POST['estado'],
        'cidade' => $_POST['cidade'],
        'bairro' => $_POST['bairro'],
        'numero' => $_POST['numero'],
        'complemento' => $_POST['complemento']
    ];

    $sql = "UPDATE usuarios SET 
                nome = :nome, 
                email = :email, 
                usuario = :usuario, 
                cll = :cll, 
                fixo = :fixo, 
                cep = :cep, 
                estado = :estado, 
                cidade = :cidade, 
                bairro = :bairro, 
                numero = :numero, 
                complemento = :complemento
            WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $campos['id'] = $id_usuario;

    if ($stmt->execute($campos)) {
        $mensagem = "Dados atualizados com sucesso!";
        $_SESSION['usuario_nome'] = $_POST['usuario'];
        $usuario = array_merge($usuario, $campos);
    } else {
        $mensagem = "Erro ao atualizar os dados.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/editordado.css"/>
    <title>Editar Perfil | NerdCore</title>
    <link rel="icon" href="../assets/LogoTOPO.png" type="image/x-icon" />
    <link rel="stylesheet"  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=menu" />
</head>

<body>
    
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
                        <a onclick='dropdownToggle()'>Produtos <img src='../assets/arrow.svg' alt='arrow_drop_down' /></a>
                        <div class='dropdown-content'>
                            <a href='../../index.php#main'>Camisetas</a>
                            <a href='../pages/producao.php'>Canecas</a>
                        </div>
                    </div>

                    <?php
                    // Exibe opções diferentes dependendo do login
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
                            <a onclick='dropdownToggle()'>{$_SESSION['usuario_nome']}</a>
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

            <form method="POST">
                <div class="botao-campo">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" readonly>
                <p></p>
                <button type="button" onclick="habilitar('nome')">///</button>
                </div>

                <div class="botao-campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" readonly>
                <button type="button" onclick="habilitar('email')">Editar</button>
                </div>
                
                <div class="botao-campo">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" readonly>
                <button type="button" onclick="habilitar('usuario')">Editar</button>
                </div>

                <div class="botao-campo">
                <label for="cll">Celular</label>
                <input type="text" id="cll" name="cll" value="<?= htmlspecialchars($usuario['cll']) ?>" readonly>
                <button type="button" onclick="habilitar('cll')">Editar</button>
                </div>

                <div class="botao-campo">
                <label for="fixo">Telefone Fixo</label>
                <input type="text" id="fixo" name="fixo" value="<?= htmlspecialchars($usuario['fixo']) ?>" readonly>
                <button type="button" onclick="habilitar('fixo')">Editar</button>
                </div>

                <div class="botao-campo">
                <label for="cep">CEP</label>
                <input type="text" id="cep" name="cep" value="<?= htmlspecialchars($usuario['cep']) ?>" readonly>
                <button type="button" onclick="habilitar('cep')">///</button>
                </div>

                <div class="botao-campo">
                <label for="estado">Estado</label>
                <input type="text" id="estado" name="estado" value="<?= htmlspecialchars($usuario['estado']) ?>" readonly>
                <button type="button" onclick="habilitar('estado')">///</button>
                </div>
                
                <div class="botao-campo">
                <label for="cidade">Cidade</label>
                <input type="text" id="cidade" name="cidade" value="<?= htmlspecialchars($usuario['cidade']) ?>" readonly>
                <button type="button" onclick="habilitar('cidade')">///</button>
                </div>
                <div class="botao-campo">
                <label for="bairro">Bairro</label>
                <input type="text" id="bairro" name="bairro" value="<?= htmlspecialchars($usuario['bairro']) ?>" readonly>
                <button type="button" onclick="habilitar('bairro')">///</button>
                </div>

                <div class="botao-campo">
                <label for="numero">Número</label>
                <input type="text" id="numero" name="numero" value="<?= htmlspecialchars($usuario['numero']) ?>" readonly>
                <button type="button" onclick="habilitar('numero')">Editar</button>
                </div>

                <div class="botao-campo">
                <label for="complemento">Complemento</label>
                <input type="text" id="complemento" name="complemento" value="<?= htmlspecialchars($usuario['complemento']) ?>" readonly>
                <button type="button" onclick="habilitar('complemento')">Editar</button>
                </div>
                <br><br>
                <button type="submit">Salvar Alterações</button>
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

    <script src="../js/editardado.js"></script>
    <script>
        function habilitar(id) {
            const campo = document.getElementById(id);
            campo.removeAttribute('readonly');
            campo.focus();
        }

        function clickMenu() {
            const menu = document.getElementById('menu-list');
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        }

        function dropdownToggle() {
            const dropdowns = document.querySelectorAll('.dropdown-content');
            dropdowns.forEach(d => d.classList.toggle('show'));
        }
    </script>
</body>
</html>