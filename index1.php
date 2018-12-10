<html>
	<head>
		<title>Transferencia de calor</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="description" content="Programa que resuelve la transferencia de calor mediante las 3 fases en las que se puede encontrar, conducción, convección y radiación." />
		<meta name="Keywords" content="conducción, transferencia de calor, convección, radiación, ingenieria quimica, resolver problemas" />
		
		<!--<link rel="shortcut icon" href="../calor.ico" type="image/x-icon">-->
		<link rel="stylesheet" href="tiendaspuebla.css" type="text/css" media="screen">
	</head>
	<body>
		<!--menu superior-->
		<div id="div_superior" name="menu_superior" align="right">
			<?
				session_start();
				if(isset($_SESSION['email']))
				{
					//esto va si esta logeado
					echo '<a href="mantenimiento_user.php">';
					echo '<img src="imagenes/botones/welcome.png">';
					echo '</a>';
					echo $_SESSION['email'];
					echo '<a href="logout.php">';
					echo '<img src="imagenes/botones/btn_logout.png">';
					echo '</a>';
				}
				else
				{
					//esto va sino esta logeado
					echo '</a>';
					echo '<a href="login.php">';
					echo '<img src="imagenes/botones/btn_login.png">';
					echo '</a>';
					echo '<a href="registrar.php">';
					echo '<img src="imagenes/botones/btn_registro.png">';
					echo '</a>';
				}
			?>
		</div>
		<div id="div_contenido" name="contenido" align="center">
			<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
					<span class="indicador_navegacionegacion">Home</span>&gt;
					<span class="indicador_navegacionegacion">Menú</span>
				</div>
				<hr>
			</div>
		</div>
		<!--contenido del cuerpo-->
		<div id="div_contenido" class="oe_wrapper" name="contenido" align="center">
			<H1>SELECCIONE UNA OPCIÓN DEL MENÚ</H1>
			<form method="post" action="menu.php" name="menu">
				<input name="boton_menu" id="conduccion" value ="conduccion"type = "submit"><br/>
				<input name="boton_menu" id="conveccion" value ="conveccion"type = "submit"><br/>
				<input name="boton_menu" id="radiacion" value ="radiacion"type = "submit">
			</form>
		</div>
		<!--pie de pagina-->
		<div id="menu_inferior">
			<map title="Barra de navegacionegación inferior">
				<div id="menu_inferior_links">
				<a href="/transferenciadecalor/ayuda.php" class="foot" accesskey="Y">MANUAL DE USO(AYUDA)</a>|
				<a href="/transferenciadecalor/libro/index.php" class="foot" accesskey="M"> MURO DE MENSAJES </a>
				</div>
			</map>
			<map title="Barra de navegacionegación inferior">
			<div>
				Sistema realizado por Ing. Alejandra Mendez Ruiz y ing. Guillermo Alejandro Romero Fernández
			</div>
			</map>
		</div>
	</body>
</html>