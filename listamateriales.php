<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
		<title>Lista de materiales disponibles</title>
	</head>
	<body>
		<div class="navegacion">
			<br>
			<span class="indicador_navegacionegacion">Home</span>&gt;
			<span class="indicador_navegacionegacion">Mi cuenta</span>&gt;
			<span class="indicador_navegacionegacion">Lista de materiales</span>
		</div>
		<div id="body_contenido">
			<!--menu superior-->
			<div id="body_menu_sup">
				<div id="menu_navegacion">
					<map title="Menu de navegacionegacion">
						<div>
						</div>
					</map>	
				</div>
			</div>
<?php
			session_start();
			mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
			mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
			$fecha = date("Y-m-d");
			$año_Actual_Mes = substr($fecha, 0, 4);
			$mes_Actual_Mes = substr($fecha, 5, 2);
			$dia_Actual_Mes = substr($fecha, -2);
			echo"<table style='width:30%'>";
			echo "<tr>Fecha de hoy: ".$año_Actual_Mes."-".$mes_Actual_Mes."-".$dia_Actual_Mes."</tr>";
			echo"	<tr>";
			echo"		<td>Nombre del material</td>";
			echo"		<td>conductividad térmica W/(K·m)</td>";
			echo"	</tr>";
			$result = mysql_query("SELECT nombre,conductividad FROM materiales");
			
			while($row=mysql_fetch_array($result))
			{
				echo"	<tr>";
				echo"		<td>".$row["nombre"]."</td>";
				echo"		<td>".$row["conductividad"]."</td>";
				echo"	</tr>";
			}
			echo"</table>";
?>
	</div>
	<div id="menu_inferior">
		<map title="Barra de navegacionegación inferior">
			<div id="menu_inferior_links">
				<div>
					<hr>
					<p>
						<h2>
						...............Fin de la lista de materiales disponibles.
						<h2>
					</p>
					<hr>
				</div>
			</div>
		</map>
	</div>
</body>