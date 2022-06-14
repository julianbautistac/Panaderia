<?php

session_start();

if (isset($_SESSION['usuario_id'])) {
  header('Location: index.php');
}
require 'database.php';



if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
  $records = $conn->prepare('SELECT id_usuario, usuario, password FROM usuarios WHERE usuario = :usuario');
  $records->bindParam(':usuario', $_POST['usuario']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);

  $message = ''; 

  if (count($results) > 0 && ($_POST['password'] == $results['password']) ) {
    $_SESSION['usuario_id'] = $results['id_usuario'];
    header("Location: index.php");
  }
  else {
    $message = 'No coinciden contraseña y password';
  }

}

?>




<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Iniciar Sesion</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>or <a href="signup.php">Registrarse</a></span>

    <form action="login.php" method="POST">
      <input name="usuario" type="text" placeholder="Ingresa tu usuario">
      <input name="password" type="password" placeholder="ingresa tu contraseña">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>