<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Conducción</title>
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
					<span class="indicador_navegacionegacion">Conducción</span>&gt;
					
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu1"]))
		{
			if ($_POST["boton_menu1"] == "Rectangular")
			{
				echo '<span class="indicador_navegacionegacion">Rectangular</span>';
				echo '<hr>';
				form_conduccion_geometria_rectangular();
			}
			else if ($_POST["boton_menu1"] == "Cilindrica")
			{
				echo '<span class="indicador_navegacionegacion">Cilíndrica</span>';
				echo '<hr>';
				form_conduccion_geometria_cilindrica();
			}
			else if ($_POST["boton_menu1"] == "Esferica")
			{
				echo '<span class="indicador_navegacionegacion">Esférica</span>';
				echo '<hr>';
				form_conduccion_geometria_esferica();
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
		function form_conduccion_geometria_rectangular()
		{
?>
			<form action="pared.php" method="post">
				<input type = "submit" name="boton_menu20" id="Geometria Rectangular" value ="Pared simple"><br/>
				<input type = "submit" name="boton_menu20" id="Geometria Rectangular" value="Pared compuesta" /><br/>
			</form>
<?
		}
		
		function form_conduccion_geometria_cilindrica()
		{
?>
			<form action="tubo.php" method="post">
				<input type = "submit" name="boton_menu21" id="Geometria Cilindrica" value ="Tubo simple"><br/>
				<input type = "submit" name="boton_menu21" id="Geometria Cilindrica" value="Tubo compuesto" /><br/>
			</form>
<?		
		}
		
		function form_conduccion_geometria_esferica()
		{
?>
			<form action="esfera.php" method="post">
				<input type = "submit" name="boton_menu22" id="Geotetria Esferica" value ="Esfera simple"><br/>
				<input type = "submit" name="boton_menu22" id="Geotetria Esferica" value="Esfera compuesta" /><br/>
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