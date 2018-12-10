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
			<span class="indicador_navegacionegacion">Cuenta de administrador</span>&gt;
			<span class="indicador_navegacionegacion">Estadistícas de uso</span>
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
			
			<form action="estadisticas.php" method="post">
				<label>Seleccione el tiempo en el que se quiere ver:</label>
				<br>
				<br>
				<select name="tiempo">
					<option value="mes" selected>El ultimo mes(Desde inicio de este mes hasta la hoy)</option>
					<option value="año">El ultimo año(Desde inicio de este año hasta este mes)</option>
					<option value="todo">Todo(Desde el inicio de su uso)</option>
				</select>
				
				<input type="submit" name="Mostrar" value="Mostrar"/>
		</form>
		</div>
<?php
		if(isset($_POST["Mostrar"]))
		{
			if(($_POST["Mostrar"] == "Mostrar"))
			{
				//codigo para mes
				$fecha = date("Y-m-d");
				$año_Actual_Mes = substr($fecha, 0, 4);
				$mes_Actual_Mes = substr($fecha, 5, 2);
				$dia_Actual_Mes = substr($fecha, -2);
				
				echo"<table style='width:30%'>";
				echo "<tr>Fecha de hoy: ".$año_Actual_Mes."-".$mes_Actual_Mes."-".$dia_Actual_Mes."</tr>";
				
				if($_POST["tiempo"] == "mes")/////////////dias
				{
					echo"	<tr>";
					echo"		<td>Dias del mes</td>";
					echo"		<td>Uso diario</td>";
					echo"	</tr>";
					
					$cadbusca="SELECT * FROM estadisticas WHERE dia BETWEEN 1 AND ".$dia_Actual_Mes." AND mes = ".$mes_Actual_Mes." AND año = ".$año_Actual_Mes;
					$result=mysql_query($cadbusca);
					
					while($row=mysql_fetch_array($result))
					{
						echo"	<tr>";
						echo"		<td>".$row["dia"]."</td>";
						echo"		<td>".$row["numero_usos"]."</td>";
						echo"	</tr>";
					}
				}
				else if($_POST["tiempo"] == "año")/////////////meses
				{
					echo"	<tr>";
					echo"		<td>Meses del año</td>";
					echo"		<td>Uso mensual</td>";
					echo"	</tr>";
					
					$cadbusca="SELECT * FROM estadisticas WHERE (dia BETWEEN 1 AND 32) AND (mes BETWEEN 1 AND ".$mes_Actual_Mes.") AND año = ".$año_Actual_Mes." ORDER BY mes, dia ASC";
					$result=mysql_query($cadbusca);
					
					$i=1;
					
					//inicio los meses
					while($i<=$mes_Actual_Mes)
					{
						$datos[$i]=0;
						$i++;
					}
					
					//vaciamos los datos por mes
					while($row=mysql_fetch_array($result))
					{
						$datos[$row["mes"]]+=$row["numero_usos"];
					}
					
					//mostramos datos
					$i=1;
					while($i<=$mes_Actual_Mes)
					{
						echo"	<tr>";
						echo"		<td>".$i."</td>";
						echo"		<td>".$datos[$i]."</td>";
						echo"	</tr>";
						$i++;
					}
				}
				else if($_POST["tiempo"] == "todo")///////////////todo
				{
					echo"	<tr>";
					echo"		<td>Dia-Mes del año</td>";
					echo"		<td>Uso diario</td>";
					echo"	</tr>";
					
					$cadbusca="SELECT * FROM estadisticas ORDER BY mes,dia ASC";
					$result=mysql_query($cadbusca);
					
					while($row=mysql_fetch_array($result))
					{
						echo"	<tr>";
						echo"		<td>".$row["dia"]."-".$row["mes"]."-".$row["año"]."</td>";
						echo"		<td>".$row["numero_usos"]."</td>";
						echo"	</tr>";
						$i++;
					}
				}
				echo"</table>";
			}
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
</html>