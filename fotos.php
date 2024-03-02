<?php
	include("php/conexion.php");
	include("php/validarSesion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Fotos</title>
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
		
		<section id="perfil">
			<img src="<?php echo "$_SESSION[fotoPerfil]" ?>" alt="Foto de perfil">
			<h1> <?php echo "$_SESSION[nombre] $_SESSION[apellidos]" ?> </h1>
			
			<form action="php/cambiarFoto.php" method="POST" enctype="multipart/form-data"/> <!-- enctype="multipart/form-data es necesario para subir archivos,crea la forma que -->
			Cambiar Foto de Perfil: <input name="archivo" type="file" accept= " .jpg, .jpeg, .png" required />
			<input type="submit" name="subir" value="Subir"/>
			</form>
		</section>	
		
			
		<section id="recuadros">
			<h2>Mis Fotos</h2>
			<h3><form action="php/subirFoto.php" method="POST" enctype="multipart/form-data"/>
			Añadir imagen: <input name="archivo" type="file" accept=".jpg, .jpeg, .png" required />
			<input type="submit" name="subir" value="Subir"/>
			</form></h3>
			<?php 
				$consulta= "Select * From fotos F 
						Where F.Nickname='$nickname' ";
				$datos = mysqli_query($conexion, $consulta);
				while($fila=mysqli_fetch_array($datos)){
			?>
			<section class="recuadrofotos">
			<img src="<?php echo $fila['NombreFoto']; ?>" height="200" width="280" alt="Foto">
			<form action="php/eliminarFoto.php" method="POST">
            <input type="hidden" name="idFoto" value="<?php echo $fila['idFotos']; ?>">
            <input type="submit" name="eliminar" value="Eliminar">
			</form>
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