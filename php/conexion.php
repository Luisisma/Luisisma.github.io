<?php
// Declarando variables para la conexión
$servidor    = "localhost";  // Puerto 8080 para XAMPP
$usuario     = "root";  // El usuario de la base de datos
$contrasenha = "";  // Contraseña del usuario
$BD          = "bd_aplicacion";  // Nombre de la base de datos

// Creando la conexión
$conexion = mysqli_connect($servidor, $usuario, $contrasenha, $BD);

if (!$conexion) {
    echo "Falló la conexión <br>";
    die("Connection failed: " . mysqli_connect_error());
} else {
   //echo "Conexión exitosa";
}
//link de prueba de conexion http://localhost:8080/P%C3%A1gina%20Web/Red%20Social/php/conexion.php
// prueba2 // http://localhost:8080/Pagina%20Web/Red%20Social/php/conexion.php
?>
