<?php
include("Conexion.php");

session_start();
$_SESSION['login'] = false;

$nickname = $_POST["nickname"];
$password = $_POST["contraseña"];  

// Configuración de codificación en la conexión a la base de datos
//mysqli_set_charset($conexion, "utf8");

// Evaluamos el nickname ingresado
$consulta = "SELECT * FROM persona WHERE Nickname = '$nickname'";
$consulta = mysqli_query($conexion, $consulta);
$consulta = mysqli_fetch_array($consulta);

if ($consulta) {
    if (password_verify($password, $consulta['Password'])) {
        $_SESSION['login']      = true;
		$_SESSION['nickname']   = $consulta['Nickname'];
		$_SESSION['nombre']     = $consulta['Nombre'];
		$_SESSION['apellidos']  = $consulta['Apellidos'];
		$_SESSION['edad']       = $consulta['Edad'];
		$_SESSION['descripcion'] = $consulta['Descripcion'];
		$_SESSION['fotoPerfil'] = $consulta['FotoPerfil'];

        header('Location: ../miPerfil.php');
    } else {
        echo "Contraseña incorrecta";
        echo "<br> <a href='../index.html'> Inténtalo de nuevo. </a></div>";
    }
} else {
    echo "Usuario no existe";
    echo "<br> <a href='../index.html'> Inténtalo de nuevo. </a></div>";
}

// Cerrando la conexión
mysqli_close($conexion);
?>


