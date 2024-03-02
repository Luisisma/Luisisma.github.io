<?php
	if($nickname == $nicknameA){
		header('Location: miPerfil.php');
		exit; // Importante incluir exit después de la redirección
	}
 
	$consulta= "SELECT * FROM persona 
				WHERE Nickname = '$nicknameA'";
	$resultado = mysqli_query($conexion, $consulta);

	if (!$resultado) {
		// Manejar el error adecuadamente, por ejemplo:
		die("Error en la consulta: " . mysqli_error($conexion));
	}

	$consulta = mysqli_fetch_array($resultado);

	$nombreA       = $consulta['Nombre'];
	$apellidosA    = $consulta['Apellidos'];
	$edadA         = $consulta['Edad'];
	$descripcionA  = $consulta['Descripcion'];
	$fotoPerfilA   = $consulta['FotoPerfil'];
?>


