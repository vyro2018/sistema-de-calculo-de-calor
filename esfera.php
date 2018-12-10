<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Esferas</title>
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
						<span class="indicador_navegacionegacion">menú</span>&gt;
						<span class="indicador_navegacionegacion">Conducción</span>&gt;
						<span class="indicador_navegacionegacion">Esferica</span>&gt;
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu22"]))
		{
			if ($_POST["boton_menu22"] == "Esfera simple")
			{
				echo'<span class="indicador_navegacionegacion">Esfera simple</span>';
				echo '<hr>';
				form_conduccion_geometria_esferica_simple();
			}
			else if ($_POST["boton_menu22"] == "Esfera compuesta")
			{
				echo'<span class="indicador_navegacionegacion">Esfera compuesta</span>';
				echo '<hr>';
				form_conduccion_geometria_esferica_compuesta();
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
		function form_conduccion_geometria_esferica_simple()
		{
?>
			<form action="esferasimple.php" method="POST">
				<fieldset>
				<legend>Seleccione una variable que desee hacer el cálculo</legend>
				<div align="center">
				<br>
					<input type="radio" name="group1" value="qr"> qr<br>
					<input type="radio" name="group1" value="Tinicial"> T inicial<br>
					<input type="radio" name="group1" value="Tfinal"> T final<br>
				<hr>
					<input type="submit" name= "boton_menu200" value="Despejar variable">
				</div>
				</fieldset>
			</form>
<?
		}
		
		function form_conduccion_geometria_esferica_compuesta()
		{
?>
			<form action="esferacompuesta.php" method="POST">
				<fieldset>
				<legend>Seleccione una variable que desee hacer el cálculo</legend>
				<div align="center">
				<br>
					<input type="radio" name="group1" value="qr"> q<br>
					<input type="radio" name="group1" value="Tinicial"> T inicial<br>
					<input type="radio" name="group1" value="Tfinal"> T final<br>
					<input type="radio" name="group1" value="h" checked> h<br>
				<hr>
					<label for ="group2">Ingrese el número de capas que desea usar:
					<input type="input" name="group2" maxlength="5" value="2"/>
				<hr>
					<input type="submit" name= "boton_menu201" value="Despejar variable">
				</div>
				</fieldset>
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