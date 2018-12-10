<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>cálculo de la Convección</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="tiendaspuebla.css" />
</head>
<body>
	<div id="body_contenido">
<?php
		//cuando hay usuarios logeados
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
		$m=0.0; $Vp=0.0; $A=0.0; $q=0.0; $t0=0.0;  $t1=0.0; $Cp=0.0;
		$DespVar =" ";
?>
		<div id="div_contenido" name="contenido" align="center">
			<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
						<span class="indicador_navegacionegacion">Home</span>&gt;
						<span class="indicador_navegacionegacion">Menú</span>&gt;
						<span class="indicador_navegacionegacion">Convección</span>&gt;
						<span class="indicador_navegacionegacion">Calcular convección</span>&gt;
				
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
			<form action="conveccioncálculo.php" method="post">
			<fieldset>
			<legend>Ingrese las variables que se le piden para hacer el cálculo</legend>
<?php
			$DespVar = $variable;
			
			
			switch($DespVar)
			{
				Case "A"://listo
?>
					<label for ="m">Ingrese m:
					<input type="text" id = "m"name="m" size="10" maxlength="10" />m3/s<br>
					
					<label for ="Vp">Ingrese Vp:
					<input type="text" id = "Vp"name="Vp" size="10" maxlength="10" />m/s<br>
					
					<input type="hidden" id="case" name="case"value="A">
<?php
				break;
				Case "Vp"://listo
?>
					<label for ="m">Ingrese m:
					<input type="text" id = "m"name="m" size="10" maxlength="10" />m3/s<br>
					
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<input type="hidden" id="case" name="case"value="Vp">
<?php
				break;
				Case "m"://listo
?>
					<label for ="Vp">Ingrese Vp:
					<input type="text" id = "Vp"name="Vp" size="10" maxlength="10" />m/s2<br>
					
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<input type="hidden" id="case" name="case"value="m">
<?php
				break;
				Case "Tinicial"://listo
?>
					<label for ="Cp">Ingrese Cp:
					<input type="text" id = "Cp"name="Cp" size="10" maxlength="10" />m/s<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese la cantidad de flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<label for ="m">Ingrese m:
					<input type="text" id = "m"name="m" size="20" maxlength="10" />m3/s<br>
					
					<input type="hidden" id="case" name="case"value="Tinicial">
<?php
					break;
				Case "Tfinal"://
?>
					<label for ="Cp">Ingrese Cp:
					<input type="text" id = "Cp"name="Cp" size="10" maxlength="10" />m/s<br>
					
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese la cantidad de flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<label for ="m">Ingrese m:
					<input type="text" id = "m"name="m" size="20" maxlength="10" />m3/s<br>
					
					<input type="hidden" id="case" name="case"value="Tfinal">
<?php
				break;
				Case "q"://listo
?>
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
					<label for ="Cp">Ingrese Cp:
					<input type="text" id = "Cp"name="Cp" size="10" maxlength="10" />m/s<br>
					
					<label for ="m">Ingrese m:
					<input type="text" id = "m"name="m" size="20" maxlength="10" />m3/s<br>
					
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
			$Pi = 3.1419265;
			
			switch($_POST["case"])
			{
				Case "Tinicial"://listo
					
					$Cp = $_POST["Cp"];
					$m = $_POST["m"];
					$tfinal = $_POST["Tfinal"];
					$q = $_POST["q"];
					
					If ($m == 0 Or $Cp == 0 )
						echo "No se permite la división por cero";
					Else
					{
						$tinicial = -($q / $m * $Cp) + $tfinal;
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
					
					$tinicial = $_POST["Tinicial"];
					$Cp = $_POST["Cp"];
					$m = $_POST["m"];
					$q = $_POST["q"];
					
					If ($m == 0 Or $Cp == 0 )
						echo "No se permite la división por cero";
					Else
					{
						$tfinal = ($q / $m * $Cp) + $tinicial;
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
				Case "q"://listo
					
					$tinicial = $_POST["Tinicial"];
					$tfinal = $_POST["Tfinal"];
					$m = $_POST["m"];
					$Cp = $_POST["Cp"];
					
					$q = $m * $Cp * ($tfinal - $tinicial);
					echo "El resultado es ".$q." W";
					if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($q,"W");
							}
						}
				break;
				Case "A"://listo
					
					$m = $_POST["m"];
					$Vp = $_POST["Vp"];
					
					if($Vp==0)
						echo "No se permite la división por cero";
					else
					{
						$A = $m / $Vp;
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
				Case "m"://listo
					$Vp = $_POST["Vp"];
					$A = $_POST["A"];
					
					$m = $Vp * $A;
					echo "El resultado es ".$m." m3/s";
					if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($m,"m3/s");
							}
						}
				break;
				Case "Vp"://listo
					
					$m = $_POST["m"];
					$A = $_POST["A"];
					if($A==0)
						echo "No se permite la división por cero";
					else
					{
						$Vp = $m / $A;
						echo "El resultado es ".$Vp." m/s";	
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($Vp,"m/s");
							}
						}
					}
				break;
				default:
					echo "Error inesperado al elegir la opción";
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