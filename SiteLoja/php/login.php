<?php
session_start();
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $usuario = $_POST['usuario'] ?? '';
    $senha = $_POST['senha'] ?? '';

    try {
        // Buscar usuário ativo
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND ativo = 1 LIMIT 1");
        $stmt->execute(['usuario' => $usuario]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verifica senha hash
            if (password_verify($senha, $user['senha'])) {
                // Salvar dados na sessão
                $_SESSION['id'] = $user['id'];
                $_SESSION['nome'] = $user['nome'];
                $_SESSION['nivel_acesso'] = $user['nivel_acesso'];

                // Redirecionar conforme nível de acesso
                if ($user['nivel_acesso'] === 'admin') {
                    header('Location: ../pages/adm.html');
                    exit;
                } else {
                    header('Location: ../index.html');
                    exit;
                }
            } else {
                // Senha incorreta
                echo "<script>alert('Senha incorreta!');window.location.href='../pages/login.html';</script>";
                exit;
            }
        } else {
            // Usuário não encontrado ou inativo
            echo "<script>alert('Usuário não encontrado ou inativo!');window.location.href='../pages/login.html';</script>";
            exit;
        }

    } catch (PDOException $e) {
        echo "Erro no login: " . $e->getMessage();
        exit;
    }
}
?>
