<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Tubo simple</title>
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
		$L=0.0; $R0=0.0; $R1=0.0; $t0=0.0; $t1=0.0; $Calibre=0.0; $A=0.0; $K=0.0; $r=0.0; $dT=0.0; $q=0.0;
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
					<span class="indicador_navegacionegacion">Menú</span>&gt;
					<span class="indicador_navegacionegacion">Conducción</span>&gt;
					<span class="indicador_navegacionegacion">Cilíndrica</span>&gt;
					<span class="indicador_navegacionegacion">Tubo simple</span>&gt;
				
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu200"]))
		{
			if ($_POST["boton_menu200"] == "Despejar variable")
			{
				echo '<span class="indicador_navegacionegacion">'.$_POST["group1"].'</span>';
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
			<form action="tubosimple.php" method="post">
			<fieldset>
			<legend>Ingrese las variables que se le piden para hacer el cálculo</legend>
<?php
			$DespVar = $variable;
			
			switch($DespVar)
			{
				Case "L":
?>
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					<input type="hidden" id="case" name="case"value="L">
<?php
					break;
				Case "T0":
?>
					<label for ="L">Ingrese la longitud L:
					<input type="text" id = "L"name="L" size="10" maxlength="10" />m<br>
					
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="T1">Ingrese la temperatura T1:
					<input type="text" id = "T1"name="T1" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese la cantidad de flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m°K<br>
					<input type="hidden" id="case" name="case"value="T0">
<?php
					break;
				Case "T1":
?>
					<label for ="L">Ingrese la longitud L:
					<input type="text" id = "L"name="L" size="10" maxlength="10" />m<br>
					
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="T0">Ingrese la temperatura T0:
					<input type="text" id = "T0"name="T0" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m°K<br>
					<input type="hidden" id="case" name="case"value="T1">
<?php
					break;
				Case "A":
?>
					<label for ="L">Ingrese la longitud L:
					<input type="text" id = "L"name="L" size="10" maxlength="10" />m<br>
					
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					<input type="hidden" id="case" name="case"value="A">
<?php
					break;
				Case "R":
?>
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m°K<br>
					<input type="hidden" id="case" name="case"value="R">
<?php
					break;
				Case "dTinterface":
?>
					<label for ="T0">Ingrese la temperatura T0:
					<input type="text" id = "T0"name="T0" size="10" maxlength="10" />°k<br>
					
					<label for ="T1">Ingrese la temperatura T1:
					<input type="text" id = "T1"name="T1" size="10" maxlength="10" />°k<br>
					<input type="hidden" id="case" name="case"value="dTinterface">
<?php
				break;
				Case "q":
?>
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="T0">Ingrese la temperatura T0:
					<input type="text" id = "T0"name="T0" size="10" maxlength="10" />°k<br>
					
					<label for ="T1">Ingrese la temperatura T1:
					<input type="text" id = "T1"name="T1" size="10" maxlength="10" />°k<br>
					
					<label for ="r0">Ingrese el radio r0:
					<input type="text" id = "r0"name="r0" size="10" maxlength="10" />m<br>
					
					<label for ="r1">Ingrese el radio r1:
					<input type="text" id = "r1"name="r1" size="10" maxlength="10" />m<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m°K<br>
					<input type="hidden" id="case" name="case" value="q">
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
				return null;
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
			
			switch($_POST["case"])
			{
				Case "L":
					$A = $_POST["A"];
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					
					If ($R0 == 0 Or $R1 == 0)
						echo "No se permite la división entre cero";
					Else
					{
						$L = ($A * log($R0 / $R1)) / (2 * $Pi * ($R0 - $R1));
						
						echo "El resultado es".$L." m";
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($L,"m");
							}
						}
					}
				break;
				Case "T0":
					
					If (isset($_POST["Material"]))
					{
						buscarMaterial();
					}
					
					$L = $_POST["L"];
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					$t1 = $_POST["T1"];
					$q = $_POST["q"];
					
					If ($R0 == 0 Or $R1 == 0 )
						echo "No se permite la división entre cero";
					Else
					{
						$A = 2 * $Pi * $L * ($R0 - $R1) / log($R0 / $R1);
						If ($A == 0)
							echo "No se permite la división entre cero, R0/R1 no puede ser 1, ni tampoco R1 puede ser 0";
						Else
						{
							$t0 = $t1 - (($q * log($R0 / $R1)) / ($K * $A));
							echo  "El resultado es ".$t0." °k";
							if(isset($_SESSION["envio_correo"]))
							{
								if($_SESSION["envio_correo"] == 1)
								{
									enviarCorreo($t0,"°k");
								}
							}
						}
					}
				break;
				Case "T1":

					If (isset($_POST["Material"]))
					{
						buscarMaterial();
					}
					
					$L = $_POST["L"];
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					$t0 = $_POST["T0"];
					$q = $_POST["q"];
					
					If ($R0 == 0 Or $R1 == 0 )
						echo "No se permite la división entre cero";
					Else
					{
						$A = 2 * $Pi * $L * ($R0 - $R1) / log($R0 / $R1);
						$t1 = $t0 + (($q * log($R0 / $R1)) / ($K * $A));
						
						echo "El resultado es ".$t1." °k";
						
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($t1,"°k");
							}
						}
					}
				break;
				Case "A":
					$L = $_POST["L"];
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					
					If( $R0 == 0 Or $R1 == 0 Or $R0 / $R1 == 1)
						echo "No se permite la división entre cero";
					Else
					{
						$A = (2 * $Pi * $L * ($R0 - $R1)) / (log($R0 / $R1));
						echo "El resultado es ".$A." m2";
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($A,"m2");
							}
						}
					}
				break;
				Case "R":
					If (isset($_POST["Material"]))
					{
						buscarMaterial();
					}
					
					$A = $_POST["A"];
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					
					If (($R1 - $R0) == 0 )
						echo "No se permite la división entre cero, R1-R0 no puede ser cero";
					Else
					{
						$r = ($R1 - $R0) / ($K * $A);
						
						echo "El resultado es ".$r." W/m°K";
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($r,"W/m°k");
							}
						}
					}
				break;
				Case "dTinterface":
					
					$t0 = $_POST["T0"];
					$t1 = $_POST["T1"];
					
					$dT = $t0 - $t1;
					
					echo "El resultado es ". $dT." °k";
					if(isset($_SESSION["envio_correo"]))
					{
						if($_SESSION["envio_correo"] == 1)
						{
							enviarCorreo($dT,"°k");
						}
					}
				break;
				Case "q":
				
					If (isset($_POST["Material"]))
					{
						buscarMaterial();
					}
					
					$A = $_POST["A"];
					$t0 = $_POST["T0"];
					$t1 = $_POST["T1"];
					$R0 = $_POST["r0"];
					$R1 = $_POST["r1"];
					
					
					If ($R0 == 0 Or $R1 == 0 Or $R0 / $R1 == 1 )
						echo "No se permite la división entre cero";
					Else
					{
						$q = ($K * $A * ($t1 - $t0)) / (log($R0 / $R1));
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