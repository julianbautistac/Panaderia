<html lang="es">
<head>
  <title>Historial de Pedidos</title>
  <meta charset="utf-8">
</head>
<body>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  <?php require 'partials/header.php' ?>
<?php 
session_start();
require 'database.php'; 
$datos = $conn->query("SELECT *From pedidos");
$infopedidos =  $datos->fetchALL(PDO::FETCH_OBJ);

?>
<table align="center">
  <h1 align="center">Registro de Pedidos</h1>
  <tr>
    <td>Id_pedido</td>
    <td>Cantidad_producto</td>
  </tr>
  <?php
  foreach ($infopedidos as $datos ) {
    ?>
    <tr>
      <td><?php echo $datos->id_pedido; ?></td>
      <td><?php echo $datos->cantidad_producto; ?></td>
    </tr>
    <?php 
  }
  ?>
  </table>

  <!-- Insertar Datos -->
<!-- inicio insert -->
    <hr>
    <h3>Pedido</h3>
    <form method="POST" action="insertar.php">
      <table>
        <tr>
          <td>Cantidad de Producto: </td>
          <td><input type="text" name="txtProducto"></td>
        </tr>
        <input type="hidden" name="oculto" value="1">
        <tr>
          <td><input type="reset" name=""></td>
          <td><input type="submit" value="INGRESAR PEDIDO"></td>
        </tr>
      </table>
    </form>






</body>
</html>