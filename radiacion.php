<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Radiaciones</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
</head>
<body>
	<div id="body_contenido">
<?php
		session_start();
?>
		<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
					<span class="indicador_navegacionegacion">Home</span>&gt;
					<span class="indicador_navegacionegacion">Menú</span>&gt;
					<span class="indicador_navegacionegacion">Radiación</span>&gt;
					<span class="indicador_navegacionegacion">Calcular radiación</span>
				</div>
				<hr>
		</div>
		<div id="div_contenido" name="contenido" align="center">
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu1"]))
		{
			if ($_POST["boton_menu1"] == "Radiacion")
			{
				form_conduccion_geometria_rectangular_simple();
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
<?php		
		function form_conduccion_geometria_rectangular_simple()
		{
?>
			<form action="radiacioncálculo.php" method="POST">
				<fieldset>
				<legend>Seleccione una variable que desee hacer el cálculo</legend>
				<div align="center">
				<br>
					<input type="radio" name="group1" value="q" checked> q/A<br>
					<input type="radio" name="group1" value="A"> A<br>
					<input type="radio" name="group1" value="Tinicial"> T inicial<br>
					<input type="radio" name="group1" value="Tfinal"> T final<br>
				<hr>
					<input type="submit" name= "boton_menu200" value="Despejar variable">
				</div>
				</fieldset>
			</form>
<?
		}
		
		function errorSeleccion()
		{
?>
			<h1>Regresa a la ventana de inicio y selecciona una opcion valida</h1>
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