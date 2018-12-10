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
			
			$user = $_SESSION['email'];
			$row=null;
			if(isset($user))
			{//aqui codigo para el menu de usuario
				echo 'Bienvenido seas '.$user;
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
			<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
					<span class="indicador_navegacionegacion">Home</span>&gt;
					<span class="indicador_navegacionegacion">Mi cuenta</span>
				</div>
			</div>
			<!--menu superior-->
			<div id="body_menu_sup">
				<!--solo si hay menu superior-->
				<div id="menu_navegacion">
					<map title="Menu de navegacionegacion">
							<div>
								<a href="/transferenciadecalor/index1.php" class="menu_navegacionegacion" title="index1">Ir a Inicio</a>
								<a href="/transferenciadecalor/configurarcorreo.php" class="menu_navegacionegacion" title="buscar">Configurar e-mail</a>
								<a href="/transferenciadecalor/logout.php" class="menu_navegacionegacion" title="logout">Salir de mi cuenta</a>
							</div>
					</map>	
				</div>
			</div>
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