<?php
    include("conexion.php");
    include("validarSesion.php");

    if (isset($_POST['eliminar'])) {
        $idFoto = $_POST['idFoto'];

        // Verifica si la foto pertenece al usuario antes de eliminarla
        $consulta = "SELECT * FROM fotos WHERE idFotos = $idFoto AND Nickname = '$nickname'";
        $resultado = mysqli_query($conexion, $consulta);

        if ($fila = mysqli_fetch_array($resultado)) {
            $rutaFoto = "../" . $fila['NombreFoto'];

            // Elimina la entrada de la base de datos
            $consultaEliminar = "DELETE FROM fotos WHERE idFotos = $idFoto";
            mysqli_query($conexion, $consultaEliminar);

            // Elimina el archivo físico
            if (file_exists($rutaFoto)) {
                unlink($rutaFoto);
            }

            echo "La foto ha sido eliminada correctamente.";
        } else {
            echo "No tienes permisos para eliminar esta foto.";
        }
    }

    header('Location: ../fotos.php'); // Redirige a la página de fotos después de la eliminación
?>

