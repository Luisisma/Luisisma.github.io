<?php
	include("php/conexion.php");
	include("php/validarSesion.php");
	// Proceso para eliminar un amigo
	if (isset($_GET['eliminarAmigo'])) {
		$nicknameAmigoEliminar = $_GET['eliminarAmigo'];
		$consultaEliminarAmigo = "DELETE FROM amistad WHERE (Nickname1 = '$nickname' AND Nickname2 = '$nicknameAmigoEliminar') OR (Nickname1 = '$nicknameAmigoEliminar' AND Nickname2 = '$nickname')";
		mysqli_query($conexion, $consultaEliminarAmigo);
		header('Location: amigos.php'); // Redirige a la página de amigos después de eliminar
		exit();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Amigos</title>
		<meta charset="UTF-8"/>
	    <link href="css/estilo.css" rel="stylesheet">
	</head>
	<body>
		<header>
			<div id="logo">
				<img src="img/logo.jpg" alt="logo"> 
			</div>
	
			<nav class="menu">
				<ul>
					<li> <a href="miPerfil.php">Mi Perfil</a> </li>
					<li> <a href="amigos.php">Mis Amigos</a> </li>
					<li> <a href="fotos.php">Mis Fotos</a> </li>
					<li> <a href="buscar.php">Buscar Amigos</a> </li>
					<li> <a href="php/CerrarSesion.php">Cerrar sesión</a> </li>
				</ul>
			</nav>
		</header>
		
		<section id="recuadros">
			<h2>Mis Amigos</h2>
			<?php
			$consulta= "Select* from Persona P 
					where P.Nickname in (Select A.Nickname2 from amistad A 
										where A.Nickname1='$nickname')";
			$datos = mysqli_query($conexion, $consulta);
			while($fila=mysqli_fetch_array($datos)){
			?>

			<section class="recuadro">
				<img src="<?php echo $fila['FotoPerfil'] ?>" height="150">
				<h2> <?php echo $fila['Nombre'] . " " .$fila['Apellidos'] ?> </h2>
				<p class="parrafo">
					<?php echo $fila['Descripcion'] ?>
				</p>
				<br>
				<a href="<?php echo "perfil.php?nickname=".$fila['Nickname'] ?>" class="boton">Ver Perfil</a>
				<!-- Agregar enlace para eliminar amigo -->
				<a href="<?php echo "amigos.php?eliminarAmigo=".$fila['Nickname'] ?>" class="boton">Eliminar Amigo</a><br><br>
				
			</section>
			<?php
			}
			?>	
		</section>
	<footer>
		<p>Copyright &copy; 2024, Luis Morales</p>
	</footer>
	</body>

</html>