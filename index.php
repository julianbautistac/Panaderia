<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['usuario_id'])) {
    $records = $conn->prepare('SELECT id_usuario, usuario, password FROM usuarios WHERE id_usuario = :id');
    $records->bindParam(':id', $_SESSION['usuario_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
    else {
      $message = 'Algo pasa';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenido. <?= $user['usuario']; ?>
      <br>Has iniciado sesion
      <a href="produccion.php">Produccion</a>
      <a href="pedidos.php">Pedidos</a>
      <a href="exedente.php">Exedente</a>
        <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Inicia Sesion o Registrate</h1>

      <a href="login.php">Iniciar Sesion</a> or
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>
