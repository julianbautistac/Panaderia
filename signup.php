<?php
  require'database.php'; 
  $message = '';

  if (!empty($_POST['usuario']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO usuarios (usuario, password) VALUES (:usuario, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuario', $_POST['usuario']);
    $stmt->bindParam(':password', $_POST['usuario']);

    if ($stmt->execute()) {
      $message = 'Se a creado un nuevo usuario';
    } else {
      $message = 'No se pudo crear un nuevo usuario';
    }
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>SignUp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>SignUp</h1>
    <span>or <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="usuario" type="text" placeholder="Ingresa un usuario">
      <input name="password" type="text" placeholder="Enter your Password">
      <input name="confirm_password" type="password" placeholder="Confirm Password">
      <input type="submit" value="Submit">
    </form>

  </body>
</html>