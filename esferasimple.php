<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Esfera simple</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
</head>
<body>
	<div id="body_contenido">
<?php
		session_start();
		//conexi�n a la bd
		mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexi�n: '.mysql_error());
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
		$q=0.0; $t0=0.0; $t1=0.0; $R0=0.0; $R1=0.0;  $K=0.0;
		$Material=" ";
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
						<span class="indicador_navegacionegacion">men�</span>&gt;
						<span class="indicador_navegacionegacion">Conducci�n</span>&gt;
						<span class="indicador_navegacionegacion">Esferica</span>&gt;
						<span class="indicador_navegacionegacion">Esferica simple</span>&gt;
					
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu200"]))
		{
			if ($_POST["boton_menu200"] == "Despejar variable")
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
		else if(isset($_POST["case"]))
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
			<form action="esferasimple.php" method="post">
			<fieldset>
			<legend>Ingrese las variables que se le piden para hacer el c�lculo</legend>
<?php
			$DespVar = $variable;
			
			
			switch($DespVar)
			{
				Case "Tinicial"://listo
?>
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />�k<br>
					
					<label for ="qr">Ingrese la cantidad de flujo de calor q:
					<input type="text" id = "qr"name="qr" size="10" maxlength="10" />W<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m�K<br>
					
					<input type="hidden" id="case" name="case"value="Tinicial">
<?php
					break;
				Case "Tfinal"://listo
?>
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />�k<br>
					
					<label for ="qr">Ingrese la cantidad de flujo de calor q:
					<input type="text" id = "qr"name="qr" size="10" maxlength="10" />W<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m�K<br>
					
					<input type="hidden" id="case" name="case"value="Tfinal">
<?php
				break;
				Case "qr"://listo
?>
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />�k<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />�k<br>
					
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m�K<br>
					
					<input type="hidden" id="case" name="case" value="qr">
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
			$mensaje = '<html><head><center>Mensaje autom�tico de www.zytez.com/transferenciadecalor<center></head>';
			//primer barra
			$mensaje.= '<body><h3>alejandrofernandez@zytez.com </h3><h1>ESTOS SON LOS DATOS DE UN c�lculo HECHO POR USTED:</h1>';
			//segunda barra
			$mensaje.= '<HR align="LEFT" size="4" width="500" color="Black" noshade> <p>Su c�lculo de la variable:'.$_POST["group1"].' es: '.$datoAEnviar.' '.$medida.'</p></HR></body></html>';
			
			$header = "From: transferenciadecalor@zytez.com \nMime-Version: 1.0\nContent-Type: text/html; charset=ISO-8859-1\nContent-Transfer-Encoding: 7bit";

			$asunto = "'Envio automatico de c�lculos en www.zytez.com/transferenciadecalor'"; 

			if(mail($_SESSION["email"],$asunto,$mensaje,$header))
			{
				echo 'Se ha enviado el resultado a su correo electr�nico';
			}
			else
			{
				echo '<br>';
				echo '<br>';
				echo '<br>';
				echo '<hr>';
				echo 'Error al enviar correo electr�nico';
			}
		}
		
		function calcularDatos()
		{
		    $K = 1;
			$Pi = 3.1419265;
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			switch($_POST["case"])
			{
				Case "Tinicial":
				
					If (isset($_POST["Material"]))
					{
						$K=buscarMaterial();
					}
					
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					$t1 = $_POST["Tfinal"];
					$q = $_POST["qr"];
					
					If ($R0 == 0 Or $R1 == 0 And ($R1 - $R0) == 0)
						echo "No se permite la divisi�n entre cero";
					Else
					{
						$t0 = round($t1 - ($q * ((1 / (4 * $Pi * $K)) * ((1 / $R1) - (1 / $R0)))), 4);
						echo  "El resultado es ".$t0." �k";
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($t0,"�k");
							}
						}
					}
				break;
				Case "Tfinal"://listo
					If (isset($_POST["Material"]))
					{
						$K=buscarMaterial();
					}
					
					
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					$t0 = $_POST["Tinicial"];
					$q = $_POST["qr"];
					
					
					If ($R0 == 0 and $R1 == 0 And (R1 - R0) == 0)
						echo "No se permite la divisi�n entre cero";
					Else
					{
						$t1 = round($t0 + ($q * ((1 / (4 * $Pi * $K)) * ((1 / $R1) - (1 / $R0)))), 4);
						
						echo "El resultado es ".$t1." �k";
						
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($t1,"�k");
							}
						}
					}
				break;
				Case "qr":
					If (isset($_POST["Material"]))
					{
						$K=buscarMaterial();
					}
					
					$t0 = $_POST["Tinicial"];
					$t1 = $_POST["Tfinal"];
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					
					If ($R0 == 0 and $R1 == 0 And ($R1 - $R0) == 0)
						echo "No se permite la divisi�n entre cero";
					Else
					{
						$q = round((($t1 - $t0) / ((1 / (4 * $Pi * $K)) * ((1 / $R1) - (1 / $R0)))), 4);
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
			$a�o = substr($fecha, 0, 4);
			$mes = substr($fecha, 5, 2);
			$dia = substr($fecha, -2);
			
			$cadbusca="SELECT * FROM estadisticas WHERE dia = ".$dia." AND mes = ".$mes." AND a�o = ".$a�o;
			$result=mysql_query($cadbusca);
			
			if($row=mysql_fetch_array($result))
			{
				$cadbusca="UPDATE estadisticas SET numero_usos = numero_usos+ 1 WHERE dia = ".$dia." AND mes = ".$mes." AND a�o = ".$a�o;
				mysql_query($cadbusca);
			}
			else
			{
				$cadbusca="INSERT INTO estadisticas(dia,mes,a�o,numero_usos) VALUES('".$dia."','".$mes."','".$a�o."','1')";
				mysql_query($cadbusca);
			}
		}
		
		function errorSeleccion()
		{
?>
			<h1>Regresa a la ventana de inicio y selecciona una opci�n valida</h1><br/>
			<h3><a href="index.php">Ventana Inicio</a></h3>
<?php
		}
?>
	</div>
	<div id="menu_inferior">
		<map title="Barra de navegacionegaci�n inferior">
			<div id="menu_inferior_links">
			<a href="/transferenciadecalor/ayuda.php" class="foot" accesskey="Y">MANUAL DE USO(AYUDA)</a>|
			<a href="/transferenciadecalor/libro/index.php" class="foot" accesskey="M"> MURO DE MENSAJES </a>
			</div>
		</map>
	</div>
	</body>
</html>