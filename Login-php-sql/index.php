<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="login.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
	<div align="center">
		<form method="POST">
		<table>
		<tr>
			<td colspan="2" style="background-color:#33A8DB;padding-bottom:10px;">
			<label>Iniciar sesión</label>
			</td>
		</tr>

		<tr>
			<td rowspan="6"><img src="logo.png" style="width: 90px; height: 100px;">
			</td>
			<td>
				<label>Usuario</label>
			</td>
		</tr>

		<tr>
			<td>
				<input type="text" name="txtusuario" placeholder="Ingresar usuario" required /> 
			</td>
		</tr>

		<tr>
			<td>
				<label>Contraseña</label>
			</td>
		</tr>

		<tr>
			<td>
				<input type="password" name="txtpassword" placeholder="Ingresar password" required /> 
			</td>
		</tr>

		<tr>
			<td>
				<input type="submit" name="btningresar" value="Ingresar"/>
			</td>
		</tr>

		<tr>
			<td>
				<a href="#">¿Olvidaste tu contraseña?</a>
				<br><br>
				<a href="#">Crear una nueva cuenta </a>
			</td>
		</tr>
		</table>
		</form>
	</div>
</body>

</html>

<?php

session_start();
if(isset($_SESSION['nombredelusuario']))
{
	header('location: pagina.php');
}

if(isset($_POST['btningresar']))
{
	
	$dbhost="localhost";
	$dbuser="root";
	$dbpass="";
	$dbname="bdtest";
	
	$conn=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
	if(!$conn)
	{
		die("No hay conexión: ".mysqli_connect_error());
	}
	
	$nombre=$_POST['txtusuario'];
	$pass=$_POST['txtpassword'];
	
	$query=mysqli_query($conn,"Select * from login where usuario = '".$nombre."' and password = '".$pass."'");
	$nr=mysqli_num_rows($query);
	
	if(!isset($_SESSION['nombredelusuario']))
	{
	if($nr == 1)
	{
		$_SESSION['nombredelusuario']=$nombre;
		header("location: pagina.php");
	}
	else if ($nr == 0)
	{
		echo "<script>
				swal({
					title: 'Error!',
					text: 'El usuario y/o la contraseña son incorrectos!',
					icon: 'error',
				});
			</script>";
	}
	}
}
?>





































