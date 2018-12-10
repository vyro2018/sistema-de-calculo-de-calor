<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<meta name="description" content="Editor de datos de cuenta." />
		<meta name="Keywords" content="servicios,mi cuenta, count" />
		
		<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
		<title>Mi cuenta</title>
	</head>
	<body>
		<div class="attrcontainer">
<?php
			session_start();
			mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
			
			$email = $_SESSION['email'];
			$row=null;
			if(isset($email))
			{//aqui codigo para el menu de usuario
				echo 'Bienvenido seas '.$email;
			}
			else
			{
				echo'Inicie sesión porfavor';
				echo '<SCRIPT LANGUAGE="javascript">';
				echo '	location.href = "login.php"';
				echo '</SCRIPT>';
			}
?>
		</div>
		<!--Desde el menu superior-->
		<div id="body_contenido">
			<!--menu superior-->
			<div id="body_menu_sup">
				<div id="menu_navegacion">
					<map title="Menu de navegacionegacion">
						<div>
							<hr>
							<a href="/transferenciadecalor/index1.php" class="menu_navegacionegacion" title="index">Ir a menú de cálculos</a>
							<a href="/transferenciadecalor/configurarcorreo.php" class="menu_navegacionegacion" title="buscar">Configurar envio de correo e-mail</a>
							<a href="/transferenciadecalor/listamateriales.php" class="menu_navegacionegacion" title="materiales" target="_new">Mostrarme la lista de materiales disponibles</a>
							<a href="/transferenciadecalor/logout.php" class="menu_navegacionegacion" title="logout">Salir de mi cuenta</a>
							<hr>
						</div>
						
					</map>	
				</div>
			</div>
		</div>
		
		<div class="navegacion">
			<br>
			<span class="indicador_navegacionegacion">Home</span>&gt;
			<span class="indicador_navegacionegacion">Mi cuenta</span>
		</div>
		
		<h1>DATOS DE MI CUENTA</h1>
		
		<h2 class="title">
			<a id="tagattributes" name="tagattributes">Editar mis datos</a>
		</h2>
				
		<div class="attrcontainer">
			<h3 class="smalltitle">
				Editando mis datos personales
			</h3>
<?php
			$cadbusca="SELECT id,nombre,apellidos,password,usuario FROM usuario WHERE email = '".$email."' AND cuenta_validada = 1";
			$result=mysql_query($cadbusca);
			
			if($row=mysql_fetch_array($result))
			{
?>
				<form action="usuario_datos_personales.php" method="post">
					<fieldset>
						<legend>Datos personales</legend>
						<label for ="usuario">Usuario
						<input type="text" id = "usuario"name="usuario" size="20" maxlength="20" value=<?echo '"'.$row["usuario"].'"'?>/>
						<label for ="password">Password
						<input type="text" id="password" name="password" size="20" maxlength="20" value=<?echo '"'.$row['password'].'"'?>/>
						<label for ="nombre">Nombre(s)
						<input type="text" id="nombre" name="nombre" size="20" maxlength="40" value=<?echo '"'.$row['nombre'].'"'?>/>
						<label for ="apellidos">Apellido(s)
						<input type="text" id="apellidos" name="apellidos" size="20" maxlength="40" value=<?echo '"'.$row['apellidos'].'"'?>/>
					</fieldset>
					<input type="submit" value="actualizar mis datos, ahora" />
				</form>
<?php
			}
			else
				echo 'problemas con el correo';
?>
		</div>
			<!--Menu inferior cte-->
			<div id="menu_inferior">
			<map title="Barra de navegacionegación inferior">
				<div id="menu_inferior_links">
				<a href="/transferenciadecalor/ayuda.php" class="foot" accesskey="Y">MANUAL DE USO(AYUDA)</a>|
				<a href="/transferenciadecalor/libro/index.php" class="foot" accesskey="M"> MURO DE MENSAJES </a>
				</div>
			</map>
		</div>
	</body>
</html>