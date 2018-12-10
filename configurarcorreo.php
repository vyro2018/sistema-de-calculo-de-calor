<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
		<title>Configurar envio de correo</title>
	</head>
	<body>
		<div class="navegacion">
			<br>
			<span class="indicador_navegacionegacion">Home</span>&gt;
			<span class="indicador_navegacionegacion">Mi cuenta</span>&gt;
			<span class="indicador_navegacionegacion">Configurar envio de correo</span>
		</div>
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
<?php
	session_start();
	mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
	mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
	
	
	$result = mysql_query("SELECT envio_correo FROM usuario WHERE email= '".$_SESSION["email"]."' AND cuenta_validada = 1");
	
	if($row = mysql_fetch_array($result))
	{
		$activo="Activo";
		if($row["envio_correo"] == 1)
		{
			mysql_query("UPDATE usuario SET envio_correo = 0 WHERE email = '".$_SESSION["email"]."'");
			$activo="Inactivo";
		}
		else
		{
			mysql_query("UPDATE usuario SET envio_correo = 1 WHERE email = '".$_SESSION["email"]."'");
			$activo="Activo";
		}
		echo '<div style="text-align:justify">Ha cabiado el estado de envio de correo a: '.$activo.'</div>';
	}
	else
	{
		echo '<h1><font color="red">NO existe el usuario ó NO ha ACTUALIZADO sus datos, le recomendamos que por seguridad actualice sus datos en la pagina anterior</font></h1>';
	}
?>
	<div id="menu_inferior">
		<map title="Barra de navegacionegación inferior">
			<div id="menu_inferior_links">
			<a href="/transferenciadecalor/ayuda.php" class="foot" accesskey="Y">MANUAL DE USO(AYUDA)</a>|
			<a href="/transferenciadecalor/libro/index.php" class="foot" accesskey="M"> MURO DE MENSAJES </a>
			</div>
		</map>
	</div>
</body>