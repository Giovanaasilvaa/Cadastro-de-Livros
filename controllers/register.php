<?php
require_once '../models/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = strtolower($_POST['email']);
    $senha = $_POST['senha'];
    $confirma_senha = $_POST['confirma_senha'];

    if ($senha !== $confirma_senha) {
        $erro = "As senhas não coincidem.";
    } else {
        
        $sql = "SELECT id FROM usuarios WHERE email = :email";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $erro = "Este e-mail já está cadastrado.";
        } else {
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha_hash);

            if ($stmt->execute()) {
                header("Location: index.php");
                exit();
            } else {
                $erro = "Erro ao cadastrar. Tente novamente.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Cadastro de Usuário</title>
  <link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
  <div class="container">
    <div class="login-box-cadastro">
      <h2>Cadastro de Usuário</h2>
      <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>
      <form method="POST" action="" onsubmit="return validarConfirmacao()">
        
        <label for="nome">Nome:</label>
        <div class="input-box">
          <input type="text" name="nome" required placeholder="Digite seu nome">
        </div>

        <label for="email">E-mail:</label>
        <div class="input-box">
          <input type="email" name="email" required placeholder="Digite seu e-mail">
        </div>

        <label for="senha">Senha:</label>
        <div class="input-box">
<input type="password" name="senha" id="senha" required placeholder="Crie uma senha" oninput="validarSenha()">
</div>
<ul class="senha-regras" id="senha-regras">
  <li id="regra1">🔴 No mínimo 8 caracteres</li>
  <li id="regra2">🔴 Pelo menos uma letra maiúscula</li>
  <li id="regra3">🔴 Pelo menos uma letra minúscula</li>
  <li id="regra4">🔴 Pelo menos um número</li>
  <li id="regra5">🔴 Um caractere especial (!@#...)</li>
</ul>
<br>
        <label for="confirma_senha">Confirmar Senha:</label>
        <div class="input-box">
          <input type="password" name="confirma_senha" id="confirma_senha" required placeholder="Repita a senha">
        </div>
        <small id="feedback-confirma" style="color: red;"></small>

        <button type="submit">Cadastrar</button>
      </form>

      <p style="margin-top: 10px;">Já tem uma conta? <a class="registro" href="../index.php">Faça login</a></p>
    </div>
  </div>
</body>
<script src="../public/js/registro.js"></script>
</html>
