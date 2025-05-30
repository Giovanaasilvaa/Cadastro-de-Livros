<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   require_once '../models/conexao.php';

    $email = $_POST['email'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        header("Location: enviar_email_redefinir.php?email=" . urlencode($email));
        exit();
    } else {
        $erro = "E-mail não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Esqueci minha senha</title>
  <link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <h2>Recuperar Senha</h2>
      <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>
      <form method="POST" action="">
        <label for="email">Digite seu e-mail cadastrado:</label>
        <div class="input-box">
          <input type="email" name="email" required placeholder="Seu e-mail">
        </div>
        <button type="submit">Enviar link de redefinição</button>
      </form>
      <p style="margin-top: 10px;"><a href="../index.php" class="registro">Voltar ao login</a></p>
    </div>
  </div>
</body>
</html>
