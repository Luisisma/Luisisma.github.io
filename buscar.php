<?php
	include("php/conexion.php");
	include("php/validarSesion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Buscar</title>
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
			<h2>Encuentra Nuevos Amigos</h2>
			<?php
				$consulta= "SELECT * FROM persona P 
							where P.Nickname!='$nickname' and P.nickname not in( Select A.Nickname2 from amistad A 
										where A.Nickname1='$nickname')";
				$datos = mysqli_query($conexion, $consulta);
				if (!$datos) {
                    echo "Error en la consulta: " . mysqli_error($conexion);
                } else {
				while($fila=mysqli_fetch_array($datos)){
			?>
			<section class="recuadro">
				<img src="<?php echo $fila['FotoPerfil'] ?>" height="150">
				<h2> <?php echo $fila['Nombre'] . " " .$fila['Apellidos'] ?> </h2>
				<p class="parrafo">
					<?php echo $fila['Descripcion'] ?>
				</p>
				<br>
				<a href="<?php echo "perfil.php?nickname=".$fila['Nickname'] ?> " class="boton">Ver Perfil</a>
				<a href="<?php echo "php/agregarAmigo.php?nickname=".$fila['Nickname'] ?> " class="boton">Agregar</a><br><br>
			</section>
			<?php
				}
			}	
			?>
		</section>
	<footer>
		<p>Copyright &copy; 2024, Luis Morales</p>
	</footer>
	</body>

</html>