<?php include("partials/header.php");?>

<?php
require 'database.php';


$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtUsuario=(isset($_POST['txtUsuario']))?$_POST['txtUsuario']:"";
$txtPassword=(isset($_POST['txtPassword']))?$_POST['txtPassword']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtApellido_paterno=(isset($_POST['txtAppat']))?$_POST['txtAppat']:"";
$txtApellido_materno=(isset($_POST['txtApmat']))?$_POST['txtApmat']:"";
//$txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";




switch($accion){

    case "Modificar":
        $sentenciaSQL=$conn->prepare("UPDATE usuarios SET usuario=:usuario, password=:password,nombre=:nombre,apellido_pat=:appat,apellido_mat=:apmat WHERE id_usuario=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':usuario',$txtUsuario);
        $sentenciaSQL->bindParam(':password',$txtPassword);
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':appat',$txtApellido_paterno);
        $sentenciaSQL->bindParam(':apmat',$txtApellido_materno);
        $sentenciaSQL->execute(); 
        //echo "Presionado boton modificar";
        break;
    case "Cancelar":
        header("Location: eliminar_actualizar.php");
        //echo "Presionado boton cancelar";
        break;
    case "Seleccionar":

        $sentenciaSQL=$conn->prepare("SELECT * FROM usuarios WHERE id_usuario=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $users=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $txtUsuario=$users['usuario'];
        $txtPassword=$users['password'];
        $txtNombre=$users['nombre'];
        $txtApellido_paterno=$users['apellido_pat'];
        $txtApellido_materno=$users['apellido_mat'];

           // echo "Presionado boton seleccionar";
        break;
    case "Borrar":
        $sentenciaSQL=$conn->prepare("DELETE FROM usuarios WHERE id_usuario=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
            //echo "Presionado boton borrar";
        break;
}


$sentenciaSQL=$conn->prepare("SELECT * FROM usuarios");
$sentenciaSQL->execute();
$listausuarios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC)

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Eliminar y actualizar usuarios</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="col-md-5">
    
    <div class="card">
        <div class="card-header">
            Datos del usuario
        </div>

    <div class="card-body">
 <!--Formulario de agregar libros-->

    <form method="POST" enctype="multipart/form-data">

    <div class = "form-group">
    <label for="txtID">ID:</label>
    <input type="text" class="form-control" value="<?php echo $txtID;?>" name="txtID" id="txtID"  placeholder="ID">
    </div>

    <div class="form-group">
    <label for="txtNombre">Usuario:</label>
    <input type="text" class="form-control" value="<?php echo $txtUsuario;?>" name="txtUsuario" id="txtUsuario"  placeholder="Usuario">
    </div>

    <div class="form-group">
    <label for="txtNombre">Nombre:</label>
    <input type="text" class="form-control" value="<?php echo $txtNombre;?>" name="txtNombre" id="txtNombre"  placeholder="Nombre">
    </div>
    <div class="form-group">
    <label for="txtNombre">Password:</label>
    <input type="text" class="form-control" value="<?php echo $txtPassword;?>" name="txtPassword" id="txtPassword"  placeholder="Password">
    </div>

    <div class="form-group">
    <label for="txtNombre">Apellido paterno:</label>
    <input type="text" class="form-control" value="<?php echo $txtApellido_paterno;?>" name="txtAppat" id="txtAppat"  placeholder="Apellido paterno">
    </div>

    <div class="form-group">
    <label for="txtNombre">Apellido materno:</label>
    <input type="text" class="form-control" value="<?php echo $txtApellido_materno;?>" name="txtApmat" id="txtApmat"  placeholder="Apellido materno">
    </div>

      <!--  <div class="form-group">
        <label for="txtNombre">Imagen:</label>

        <?php //echo $txtImagen;?>"

        <input type="file" class="form-control"  name="txtImagen" id="txtImagen"  placeholder="Nombre del libro">
        </div>-->

            <div class="btn-group" role="group" aria-label="">
               <!-- <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>-->
                <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" value="Cancelar" class="btn btn-info">Cancelar</button>
            </div>

</form>

    </div>

</div>



</div>

<!--tabla-->
<div class="col-md-7">

    <table class="table table-bordered" >
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Password</th>
                <th>Nombre</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Acciones</th>
                
            </tr>
        </thead>
        <tbody>

        <?php foreach($listausuarios as $users) {//aqui creamos un ciclo 
            
         ?>
            <tr>
                <td ><?php echo $users['id_usuario'];?></td>
                <td><?php echo $users['usuario'];?></td>
                <td><?php echo $users['password'];?></td>
                <td><?php echo $users['nombre'];?></td>
                <td><?php echo $users['apellido_pat'];?></td>
                <td><?php echo $users['apellido_mat'];?></td>
                <td>
                 

                <form method="post">
                <input type="hidden" name="txtID" id="txtID" value="<?php echo $users['id_usuario'];?>"/><!--el hidden esconde el contenido-->
                <input type="submit" name="accion"   value="Seleccionar" class="btn btn-primary"/>
                <input type="submit" name="accion"   value="Borrar" class="btn btn-danger"/>

                </form>

                </td>

            </tr>

            <?php }?>
        </tbody>
    </table>

</div>
</body>
</html>