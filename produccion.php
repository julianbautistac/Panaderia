<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Produccion</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	
	<?php require 'partials/header.php' ?>
	<br>Produccion </br>
	<table>
        <tr>
          <td>Pronostico del Tiempo: </td>
          <td><p>

             <select name="clima" >

             <option>Soleado</option>
             <option>Nublado</option>
             <option>Poca Lluvia</option>
             <option>Lluvioso</option>
             <option>Caluroso</option>
             </select>

            </p></td>
          
        </tr>
        <tr>
          <td>Cantidad de Produccion </td>
          <td><input type="text" name="txtPedidos"></td>
        </tr>
        <tr>
          <td>Fecha </td>
          <td><input type="date" name="fecha"></td>
        </tr>
        <input type="hidden" name="oculto" value="1">
        <tr>
          <td><input type="reset" name=""></td>
          <td><input type="submit" value="INGRESAR DATOS"></td>
        </tr>
      </table>


</body>
</html>