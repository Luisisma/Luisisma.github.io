<?php
	include("validarSesion.php");

	// Establece la ubicaciÃ³n de destino del archivo
	$ubicacion = "../img/" .$nickname. "/perfil.jpg";

	// Obtiene el archivo temporal del formulario
	$archivo = $_FILES['archivo']['tmp_name'];

	// Verifica si se movió correctamente el archivo a la ubicación deseada
	if (move_uploaded_file($archivo, $ubicacion)) {
		// Limpia la caché del navegador para asegurar la actualización de la imagen
		header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
		header("Cache-Control: post-check=0, pre-check=0", false);
		header("Pragma: no-cache");

		echo "El archivo ha sido subido con éxito.";
		header('Location: ../fotos.php');
	} else {
		echo "Ha ocurrido un error al subir el archivo. Por favor, inténtelo de nuevo.";
		echo "<a href='../fotos.php'>Volver.</a></div>";
	}
?>