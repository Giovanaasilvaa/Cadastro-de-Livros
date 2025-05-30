<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_unset();
    session_destroy();
    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sair da Conta</title>
 <link rel="stylesheet" href="../public/css/style.css"/>
</head>
<body>

<div class="container">
<div class="confirmar">

    <h2>Sair da Conta</h2>
    <p>Você tem certeza que deseja sair da conta?</p>

    <form method="POST">
        <button type="submit" style="background-color: #e74c3c;">SIM</button>
      </form> <br>

      <p style="margin-top: 10px;"><a class="registro" href="cadastrar.php"> Cancelar e voltar</a></p>
      </div>
  </div>
</body>
</html>