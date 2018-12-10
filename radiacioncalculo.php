<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>cálculo de la Radiación</title>
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
		$q=0.0; $A=0.0; $t0=0.0; $t1=0.0; $r=0.0;
		$DespVar =" ";
		
?>
		<div id="div_contenido" name="contenido" align="center">
		<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
					<span class="indicador_navegacionegacion">Home</span>&gt;
					<span class="indicador_navegacionegacion">Menú</span>&gt;
					<span class="indicador_navegacionegacion">Radiación</span>&gt;
					<span class="indicador_navegacionegacion">Calcular radiación</span>&gt;
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
			<form action="radiacioncálculo.php" method="post">
			<fieldset>
			<legend>Ingrese las variables que se le piden para hacer el cálculo</legend>
<?php
			$DespVar = $variable;
			
			
			switch($DespVar)
			{
				Case "Tinicial"://listo
?>
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<input type="hidden" id="case" name="case"value="Tinicial">
<?php
					break;
				Case "Tfinal"://listo
?>
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<input type="hidden" id="case" name="case"value="Tfinal">
<?php
				break;
				Case "q"://listo
?>
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
					<input type="hidden" id="case" name="case" value="q">
<?php
					break;
					
					Case "A"://listo
?>
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<input type="hidden" id="case" name="case" value="A">
<?php
					break;
			}
?>
				</fieldset>
				<input type="submit" name = "Calcular" value="Calcular" />
			</form>
<?
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
		    $r = 0.00000005669;
			
			switch($_POST["case"])
			{
				Case "Tinicial":
				
					$A = $_POST["A"];
					$q = $_POST["q"];
					$tfinal = $_POST["Tfinal"];
					If( $A == 0 Or $r == 0)
						echo "No se permite la división por cero";
					Else
					{
						$qTemp = ($q / $A * $r) - $tfinal;
						if($qTemp <0)
							$qTemp = -$qTemp;
						$tinicial = sqrt(sqrt($qTemp));
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
					$A = $_POST["A"];
					$q = $_POST["q"];
					$tinicial = $_POST["Tinicial"];
					If ($A == 0 Or $r == 0)
						echo "No se permite la división por cero";
					Else
					{
						$tfinal = sqrt(sqrt(-($q / $A * $r) + $tinicial));
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
				Case "q":
					$A = $_POST["A"];
					$tfinal = $_POST["Tfinal"];
					$tinicial = $_POST["Tinicial"];
					
					$q = $A * $r * (exponente($tinicial, 4) - exponente($tfinal, 4));
					
					echo "El resultado es ".$q." W";
					if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($q,"W");
							}
						}
				break;
				Case "A":
				
				$q = $_POST["q"];
				$tinicial = $_POST["Tinicial"];
				$tfinal = $_POST["Tfinal"];
				If ($q == 0)
					echo "No se permite la división por cero";
				Else
				{
					$A = $q / ($r * (exponente($tinicial, 4) - exponente($tfinal, 4)));
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
		
		function exponente($valor, $exp)
		{
			$resultado = $valor;
			For($i = 2;$i<$exp;$i++)
			{
				$resultado = $resultado * $valor;
			}
			return $resultado;
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