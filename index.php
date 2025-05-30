<?php
session_start();
require_once 'models/conexao.php';

if (isset($_SESSION['id_usuario'])) {
    header("Location: controllers/cadastrar.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, senha FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($senha, $user['senha'])) {
        $_SESSION['id_usuario'] = $user['id'];
        header("Location: controllers/cadastrar.php");
        exit();
    } else {
        $erro = "E-mail ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2>Login</h2>
            <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>
            <form method="POST" action="">
                <label for="email">E-mail:</label>
                <div class="input-box">
                <input type="email" name="email" required placeholder="Digite seu e-mail"></div>

                <label for="senha">Senha:</label>
                <div class="input-box">
                <div class="senha-container"> <input type="password" name="senha" id="senha" required placeholder="Digite sua senha"> <span class="toggle-senha" onclick="mostrarSenha()"> <img src="/livros/assets/olho_aberto.png" id="icone-senha" alt="Mostrar senha" width="24"></span></div></div>

                <p class="esqueceu"><a class="esqueceu" href="controllers/esqueci_senha.php">Esqueceu a senha?</a></p> <br>

                <button type="submit">Log in</button>

            </form>
            <p style="margin-top: 10px;">Não tem uma conta?<a class="registro"href="controllers/register.php">Cadastre-se</a></p>
        </div>
    </div>
</body>
<script src="public/js/olhinho.js"></script>
</html>
