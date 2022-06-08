<?php  
	if (!isset($_POST['oculto'])) {
		exit();
	}

	require'database.php'; 
	$cant = $_POST['txtProducto'];


	$sentencia = $conn->prepare("INSERT INTO pedidos(cantidad_producto) VALUES (?);");
	$resultado = $sentencia->execute([$cant]);

	if ($resultado === TRUE) {
		//echo "Insertado correctamente";
		header('Location: partials/header.php');
	}else{
		echo "Error";
	}
?>