<?php
	$user_temp = $_GET["id"];
	?>	
	<html>
	<header>
		<title>
			Activación
		</title>
		<br><h1> <center>GRACIAS POR REGISTRARTE</center></h1>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="formulario.css"/>
	</header>
	<?php
	mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
	mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
	mysql_query("UPDATE usuario SET cuenta_validada = 1 WHERE usuario = '".$user_temp."'");
	$result = mysql_query("SELECT nombre FROM usuario WHERE usuario= '".$user_temp."' AND cuenta_validada = 1");
	if($row = mysql_fetch_array($result))
	{
		echo '<body><div style="text-align:justify">Bienvenido '.$row["nombre"].' por favor cambien su nombre de usuario y contraseña a una que personalmente use accediendo dentro de la pestaña <br><font color="blue">\'mi cuenta\'</font> y luego en la opción <font color="blue">\'editar mis datos\'</font></div>';
		?>
		<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
					<span class="indicador_navegacionegacion">Activación</span>&gt;
				</div>
		</div>
			
		<form action="validar_usuario.php" method="post">
			<fieldset>
			<legend>Login</legend>

			<label for ="email">Email:
			<input type="text" id = "email"name="email" size="60" maxlength="60" />

			<label for ="password">Password:
			<input type="password" id="password" name="password" size="50" maxlength="50" />

			</fieldset>
			<input type="submit" value="Ingresar" />
		</form>
<?php
	}
	else
	{
		echo '<h1><font color="red">no existe la cuenta</font></h1>';
	}
?>
</body>