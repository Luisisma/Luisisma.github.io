<?php
	include("Conexion.php");
	include("validarSesion.php");
	
	$nicknameA = $_GET['nickname'];
	
	if ($nickname == $nicknameA) {
        header('Location: miPerfil.php');
        exit;
    }
	$consulta = "SELECT * FROM persona WHERE Nickname = '$nicknameA'";
    $result = mysqli_query($conexion, $consulta);
	
	if (!$result) {
        echo "Error en la consulta: " . mysqli_error($conexion);
    } else {
        $consulta = mysqli_fetch_array($result);

        $nombreA       = $consulta['Nombre'];
        $apellidosA    = $consulta['Apellidos'];
        $edadA         = $consulta['Edad'];
        $descripcionA  = $consulta['Descripcion'];
        $fotoPerfilA   = $consulta['FotoPerfil'];

        include("Conexion.php");
        include("validarSesion.php");

        $consulta = "INSERT INTO amistad (Nickname1, Nickname2) VALUES ('$nickname', '$nicknameA')";

        if (mysqli_query($conexion, $consulta)) {
            $consulta = "INSERT INTO amistad (Nickname1, Nickname2) VALUES ('$nicknameA', '$nickname')";
            if (mysqli_query($conexion, $consulta)) {
                echo "Ahora tienes un nuevo amigo";
                header('Location: ../buscar.php');
                exit;
            } else {
                echo "Error al agregar amigo";
            }
        } else {
            echo "Error al agregar amigo";
        }
    }
	
?>

