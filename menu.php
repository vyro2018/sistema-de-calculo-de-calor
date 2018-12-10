<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Menú principal</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
</head>
<body>
	<div id="body_contenido">
<?php
		session_start();
?>
		<div id="div_contenido" name="contenido" align="center">
			<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
					<span class="indicador_navegacionegacion">Home</span>&gt;
					<span class="indicador_navegacionegacion">Menú</span>&gt;
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu"]))
		{
			if ($_POST["boton_menu"] == "conduccion")
			{
				echo '<span class="indicador_navegacionegacion">Conducción</span>';
				echo '<hr>';
				form_conduccion();
			}
			else if ($_POST["boton_menu"] == "conveccion")
			{
				echo '<span class="indicador_navegacionegacion">Convección</span>';
				echo '<hr>';
				form_conveccion();
			}
			else if ($_POST["boton_menu"] == "radiacion")
			{
				echo '<span class="indicador_navegacionegacion">Radiación</span>';
				echo '<hr>';
				form_radiacion();
			}
			else
			{
				errorSeleccion();
			}
		}
		else
		{
			errorSeleccion();
		}
?>
				</div>
			</div>
		</div>
<?php		
		function form_conduccion()
		{
?>
			<form action="conduccion.php" method="post">
				<input type = "submit" name="boton_menu1" id="Geotetria Rectangular" value ="Rectangular"><br/>
				<input type = "submit" name="boton_menu1" id="Geotetria Cilindrica" value="Cilindrica" /><br/>
				<input type = "submit" name="boton_menu1" id="Geotetria Esferica" value="Esferica" />
			</form>
<?
		}
		
		function form_conveccion()
		{
?>
			<form action="conveccion.php" method="post">
				<input type = "submit" name="boton_menu1" id="Conveccion" value ="Conveccion"><br/>
			</form>
<?		
		}
		
		function form_radiacion()
		{
?>
			<form action="radiacion.php" method="post">
				<input type = "submit" name="boton_menu1" id="Radiacion" value ="Radiacion"><br/>
			</form>
<?		
		}
		
		function errorSeleccion()
		{
?>
			<h1>Regresa a la ventana anterior y selecciona una opción valida</h1>
			<br/>
			<h3><a href="index.php">Ventana Inicio</a></h3>
<?php
		}
?>
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