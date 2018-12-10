<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
		<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
	</head>
	<body>
		<div class="attrcontainer">
<?php
			session_start();
			mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
			
			if(isset($_SESSION['email']))
			{
				//aqui codigo para el menu de usuario
				$user=$_SESSION['email'];
				echo 'Bienvenido seas '.$user.' QUERIDO ADMINISTRADOR';
			}
			else
			{
				echo '<SCRIPT LANGUAGE="javascript">';
				echo '	location.href = "login.php"';
				echo '</SCRIPT>';
			}
?>
		</div>
		
		<div class="navegacion">
			<br>
			<span class="indicador_navegacionegacion">Home</span>&gt;
			<span class="indicador_navegacionegacion">Cuenta de administrador</span>
		</div>
		
		<div id="body_contenido">
			<!--menu superior-->
			<div id="body_menu_sup">
				<!--solo si hay menu superior-->
				<hr>
				<div id="menu_navegacion">
					<map title="Menu de navegacionegacion">
						<div>
							<a href="/transferenciadecalor/estadisticas.php" class="menu_navegacionegacion" title="buscar">Ver estadísticas de uso</a>
							<a href="/transferenciadecalor/logout.php" class="menu_navegacionegacion" title="logout">Salir de mi cuenta</a>
						</div>
						<hr>
					</map>	
				</div>
			</div>
		</div>
		
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