
<?php
require'database.php'; 
$message = '';


if (!empty($_POST['nombre']) && !empty($_POST['appat'])&& !empty($_POST['apmat']) && !empty($_POST['usuario']) && !empty($_POST['password'])) {
  $sql = "INSERT INTO usuarios (usuario, password,nombre, apellido_pat,apellido_mat,tipo_usuario) VALUES (:usuario, :password,:nombre,:appat,:apmat,:tipo)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':usuario', $_POST['usuario']);
  $stmt->bindParam(':password', $_POST['password']);
  $stmt->bindParam(':nombre', $_POST['nombre']);
  $stmt->bindParam(':appat', $_POST['appat']);
  $stmt->bindParam(':apmat', $_POST['apmat']);
  $stmt->bindParam(':tipo', $_POST['tipo']);



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



    <input name="nombre" type="text" placeholder="nombre">
    <input name="appat" type="text" placeholder="Apellido paterno">
    <input name="apmat" type="text" placeholder="Apellido materno">
    <input name="usuario" type="text" placeholder="Usuario">
    <input name="password" type="text" placeholder="Enter your Password">
    <input name="confirm_password" type="password" placeholder="Confirm Password">


  
  <select name="tipo" id="tipo">
  <optgroup label="tipo de usuario">
        <option value="1">Administrador</option>
        <option value="2">Auxiliar</option>
      </optgroup>
      </select>
    
    <input type="submit" value="Registrar">
  </form>

</body>
</html>