<?php
include("conexion.php");

$nickname     = $_POST["nickname"];
$nombre       = $_POST["nombre"];
$apellidos    = $_POST["apellidos"];
$edad         = $_POST["edad"];
$descripcion  = $_POST["descripcion"];
$email        = $_POST["correo"];
$password     = $_POST["contraseña"];
$passwordHash = password_hash($password, PASSWORD_BCRYPT);
$fotoPerfil   = "img/$nickname/perfil.jpg";

// Evaluamos si el nickname ingresado ya existe
$consultaId = "SELECT Nickname FROM persona WHERE Nickname = ?";
$statementId = mysqli_prepare($conexion, $consultaId);
mysqli_stmt_bind_param($statementId, "s", $nickname);
mysqli_stmt_execute($statementId);
mysqli_stmt_store_result($statementId);

if (mysqli_stmt_num_rows($statementId) == 0) {
    $sql = "INSERT INTO persona VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($statement, "ssisssss", $nickname, $nombre, $apellidos, $edad, $descripcion, $fotoPerfil, $email, $passwordHash);

    if (mysqli_stmt_execute($statement)) {
        // Comprobamos si el directorio ya existe antes de intentar crearlo
        if (!is_dir("../img/$nickname")) {
            mkdir("../img/$nickname"); // Crear una carpeta en imágenes para el usuario
            copy("../img/default.jpg", "../img/$nickname/perfil.jpg");
        }

        echo "Tu cuenta ha sido creada.";
        echo "<br> <a href='../index.html'>Iniciar Sesión</a></div>";
    } else {
        echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
    }

    mysqli_stmt_close($statement);
} else {
    echo "El Nickname ya existe. ";
    echo "<a href='../index.html'>Inténtalo de nuevo. </a></div>";
}

// Cerrando la conexión
mysqli_close($conexion);
?>
