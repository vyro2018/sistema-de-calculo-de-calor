<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Esfera compuesta</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
</head>
<body>
	<div id="body_contenido">
<?php
		session_start();
		//conexión a la bd
		mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
		mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
		
		if(isset($_SESSION["email"]))
		{
			$cadbusca="SELECT envio_correo FROM usuario WHERE email = '".$_SESSION["email"]."'";
			$result=mysql_query($cadbusca);
			
			if($row=mysql_fetch_array($result))
			{
				$_SESSION["envio_correo"]=$row["envio_correo"];
			}
		}
		
		//variables
		$q=0.0; $qTemp=0; $tfinal=0.0; $tinicial=0.0; $K=51.1; $R0=0.0; $R1=0.0; $h=0.0; $Material=" ";
		$materialEcontrado = false;
		$DespVar =" ";
		$Pi = 0.0;
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
						<span class="indicador_navegacionegacion">Esferica compuesta</span>&gt;
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu201"]))
		{
			if ($_POST["boton_menu201"] == "Despejar variable")
			{
				echo '<span class="indicador_navegacionegacion">'.$_POST["group1"].'</span>';
				echo '<hr>';
				menu_variable_seleccionada($_POST["group1"]);
			}
			else
			{
				errorSeleccion();
			}
		}
		else if(isset($_POST["group2"]))
		{
			if ($_POST["group1"])
			{
				menu_variable_seleccionada($_POST["group1"]);
			}
			else
			{
				errorSeleccion();
			}
		}
		else if(isset($_POST["Calcular"]))
		{
			echo '<span class="indicador_navegacionegacion">'.$_POST["case"].'</span>&gt;';
			echo '<span class="indicador_navegacionegacion">Resultado</span>';
			calcularDatos($_POST["case"]);
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
		function menu_variable_seleccionada($variable)
		{
?>
			<form action="esferacompuesta.php" method="post">
			<fieldset>
			<legend>Ingrese las variables que se le piden para hacer el cálculo</legend>
			
			<label for ="Material">Ingrese el nombre del material:
			<input type="text" id = "Material"name="Material" size="10" maxlength="20" />W/m°k<br>
<?php
			$DespVar = $variable;
			
			switch($DespVar)
			{
				Case "qr"://listo
?>
					<label for ="h">Ingrese la h:
					<input type="text" id = "h"name="h" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>

					<input type="hidden" id="case" name="case" value="qr">
<?php
					break;
				Case "h"://listo
?>
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial" name="Tinicial" size="10" maxlength="10" />m2<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />m2<br>
					
					<label for ="qr">Ingrese la cantidad de flujo de calor q:
					<input type="text" id = "qr"name="qr" size="10" maxlength="10" />W<br>					

					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
						
					<input type="hidden" id="case" name="case"value="h">
<?php
				break;
				Case "Tinicial"://listo
?>
					<label for ="qr">Ingrese la cantidad de flujo de calor q:
					<input type="text" id = "qr"name="qr" size="10" maxlength="10" />W<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="h">Ingrese h:
					<input type="text" id = "h"name="h" size="10" maxlength="10" />m<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
					<input type="hidden" id="case" name="case"value="Tinicial">
<?php
				break;
				Case "Tfinal"://listo
?>
					<label for ="qr">Ingrese la cantidad de flujo de calor q:
					<input type="text" id = "qr"name="qr" size="10" maxlength="10" />W<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="h">Ingrese h:
					<input type="text" id = "h"name="h" size="10" maxlength="10" />m<br>

					<input type="hidden" id="case" name="case"value="Tfinal">
<?php
				break;
			}
?>
				</fieldset>
				<input type="submit" name = "Calcular" value="Calcular" />
			</form>
<?
		}
		
		function buscarMaterial()
		{
			$materialEcontrado = False;
			$cadbusca="SELECT conductividad FROM materiales WHERE nombre = '".$_POST["Material"]."'";
			$result=mysql_query($cadbusca);
					
			if($row=mysql_fetch_array($result))
			{
				return $row['conductividad'];
			}
			else
			{
				return 0;
				echo "No se encontro el material";
			}
		}
		
		function enviarCorreo($datoAEnviar,$medida)
		{
			$mensaje = '<html><head><center>Mensaje automático de www.zytez.com/transferenciadecalor<center></head>';
			//primer barra
			$mensaje.= '<body><h3>alejandrofernandez@zytez.com </h3><h1>ESTOS SON LOS DATOS DE UN CÁLCULO HECHO POR USTED:</h1>';
			//segunda barra
			$mensaje.= '<HR align="LEFT" size="4" width="500" color="Black" noshade> <p>Su cálculo de la variable:'.$_POST["group1"].' es: '.$datoAEnviar.' '.$medida.'</p></HR></body></html>';
			
			$header = "From: transferenciadecalor@zytez.com \nMime-Version: 1.0\nContent-Type: text/html; charset=ISO-8859-1\nContent-Transfer-Encoding: 7bit";

			$asunto = "'Envio automatico de cálculos en www.zytez.com/transferenciadecalor'"; 

			if(mail($_SESSION["email"],$asunto,$mensaje,$header))
			{
				echo 'Se ha enviado el resultado a su correo electrónico';
			}
			else
			{
				echo '<br>';
				echo '<br>';
				echo '<br>';
				echo '<hr>';
				echo 'Error al enviar correo electrónico';
			}
		}
		
		function calcularDatos()
		{
		    $K = 100000;
			$Pi = 3.1416;
			
			If (isset($_POST["Material"]))
			{
				$K = buscarMaterial();
			}
	
			switch($_POST["case"])
			{
				Case "h"://listo
					
					$q = $_POST["qr"];
					$tfinal = $_POST["Tfinal"];
					$tinicial = $_POST["Tinicial"];
					$R1 = $_POST["r1"];
					
					If ($R1 == 0 )
						echo "No se permite la división por cero";
					Else
					{
						$h = (((2 * $K) * (-($tfinal - $tinicial))) / (($q / (4 * $Pi * $K)))) - (1 / $R1);
						echo "El resultado es".$h." m";
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($h,"m");
							}
						}
					}
				break;
				Case "Tinicial"://listo
					
					$q = $_POST["qr"];
					$tfinal = $_POST["Tfinal"];
					$h = $_POST["h"];
					$R1 = $_POST["r1"];
					
					
					If ($R1 == 0 )
						echo "No se permite la división por cero";
					Else
					{
						$tinicial = ((-$q) * ((1 / 4) * $Pi * $K) * ((1 / $R1) - ($h / (2 * $K)))) + $tfinal;
						echo  "El resultado es ".$tinicial." °k";
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($tinicial,"°k");
							}
						}
					}
				break;
				Case "Tfinal"://listo
					
					$R1 = $_POST["r1"];
					$h = $_POST["h"];
					$tinicial = $_POST["Tinicial"];
					$q = $_POST["qr"];
					
					If ($R1 == 0 Or $K == 0 )
						echo "No se permite la división por cero";
					Else
					{
						$tfinal = ($q * ((1 / 4) * $Pi * $K) * ((1 / $R1) - ($h / (2 * $K)))) + $tinicial;
						echo "El resultado es ".$tfinal." °k";
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($tfinal,"°k");
							}
						}
					}
				break;
				Case "qr"://listo
					
					$tinicial = $_POST["Tinicial"];
					$tfinal = $_POST["Tfinal"];
					$R1 = $_POST["r1"];
					$h = $_POST["h"];
					
					If ($R1 == 0 )
						echo "No se permite la división por cero";
					Else
					{
						$q = ($tfinal - $tinicial) / (((1 / (4 * $Pi * $K)) * ((1 / $R1) - ($h / (2 * $K)))));
						echo "El resultado es ".$q." W";
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($q,"W");
							}
						}
					}
					
				break;
			}
			
			echo "<br>";
			echo "<br>";
			$fecha = date("Y-m-d");
			$año = substr($fecha, 0, 4);
			$mes = substr($fecha, 5, 2);
			$dia = substr($fecha, -2);
			
			$cadbusca="SELECT * FROM estadisticas WHERE dia = ".$dia." AND mes = ".$mes." AND año = ".$año;
			$result=mysql_query($cadbusca);
			
			if($row=mysql_fetch_array($result))
			{
				$cadbusca="UPDATE estadisticas SET numero_usos = numero_usos+ 1 WHERE dia = ".$dia." AND mes = ".$mes." AND año = ".$año;
				mysql_query($cadbusca);
			}
			else
			{
				$cadbusca="INSERT INTO estadisticas(dia,mes,año,numero_usos) VALUES('".$dia."','".$mes."','".$año."','1')";
				mysql_query($cadbusca);
			}
		}
		
		function errorSeleccion()
		{
?>
			<h1>Regresa a la ventana de inicio y selecciona una opción valida</h1><br/>
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