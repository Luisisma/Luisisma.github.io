<?php
	include("php/conexion.php");
	include("php/validarSesion.php");
	
	$nicknameA=$_GET['nickname'];
	$consulta = "SELECT * FROM persona WHERE Nickname = '$nicknameA'";
    $result = mysqli_query($conexion, $consulta);
	
	include("php/datosAmigo.php");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Perfil</title>
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
			<img src="<?php echo "$fotoPerfilA"?>" alt="Foto de perfil">
			<h1> <?php echo "$nombreA $apellidosA" ?> </h1>
			<p> <?php echo "$descripcionA" ?> </p>
	</section>		

	<section id="recuadros">
		<h2>Amigos</h2>
		<?php
			$consulta= "Select * From Persona P 
						Where P.Nickname in (Select A.Nickname2 from amistad A 
											Where A.Nickname1='$nicknameA')
						Limit 3";
			$datos = mysqli_query($conexion, $consulta);
			while($fila=mysqli_fetch_array($datos)){
		?>		
		<section class="recuadro">
				<img src="<?php echo $fila['FotoPerfil'] ?>" height="150">
				<h2><?php echo $fila['Nombre'] . " " .$fila['Apellidos'] ?></h2>
				<p class="parrafo">
					<?php echo $fila['Descripcion'] ?>
				</p>
				<a href="<?php echo "perfil.php?nickname=".$fila['Nickname'] ?>" class="boton">Ver Perfil</a><br><br>
			</section>
		<?php
			}
		?>
	</section>
	
    <section id="recuadros">
        <h2>Fotos</h2>
		<?php 
			$consulta= "Select * From fotos F 
						Where F.Nickname='$nicknameA'";
			$datos = mysqli_query($conexion, $consulta);
			while($fila=mysqli_fetch_array($datos)){
		?>		
        <section class="recuadrofotos">
            <img src="<?php echo $fila['NombreFoto'] ?>" height="200" width="280" alt="Foto">
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


