<?php
include("conexion.php"); // Asegúrate de incluir tu archivo de conexión

session_start();
$nickname = $_SESSION['nickname'];
$nicknameAmigo = $_GET['nicknameAmigo'];

// Verificar que la amistad existe antes de intentar eliminarla
$consultaVerificar = "SELECT * FROM amistad WHERE (Nickname1 = '$nickname' AND Nickname2 = '$nicknameAmigo') OR (Nickname1 = '$nicknameAmigo' AND Nickname2 = '$nickname')";
$resultado = mysqli_query($conexion, $consultaVerificar);

if (mysqli_num_rows($resultado) > 0) {
    // Eliminar la amistad
    $consultaEliminar = "DELETE FROM amistad WHERE (Nickname1 = '$nickname' AND Nickname2 = '$nicknameAmigo') OR (Nickname1 = '$nicknameAmigo' AND Nickname2 = '$nickname')";
    mysqli_query($conexion, $consultaEliminar);

    // Redirigir a la página de amigos (o a donde desees)
    header('Location: ../amigos.php');
    exit();
} else {
    // La amistad no existe, puedes mostrar un mensaje o redirigir a algún lugar
    echo "La amistad no existe o ya ha sido eliminada.";
}
?>

