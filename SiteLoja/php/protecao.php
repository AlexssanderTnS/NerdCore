<?php
session_start();

function logado() {
    return isset($_SESSION['usuario_id']);
}

function nivelAcesso() {
    return $_SESSION['usuario_acesso'] ?? 0;
}

function exigeAcesso($nivelMinimo) {
    if (!logado()) {
        echo'<script type="text/javascript">
            alert("Você precisa estar logado para acessar.");
            window.location.href = "login.php";
          </script>';
        
        exit;
    }
    if (nivelAcesso() < $nivelMinimo) {
        echo "Você não tem permissão";
        exit;
    }
}
?>
