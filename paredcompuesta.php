<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Paredes compuestas</title>
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
		$t1=0.0; $t2=0.0; $RT=0.0; $q=0.0;
		if(isset($_POST["group2"]))
			$numParedes = $_POST["group2"];
		$Material=" ";
		$materialEcontrado = false;
		$DespVar =" ";
?>
		<div id="div_contenido" name="contenido" align="center">
			<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
					<span class="indicador_navegacionegacion">Home</span>&gt;
					<span class="indicador_navegacionegacion">Menú</span>&gt;
					<span class="indicador_navegacionegacion">Conducción</span>&gt;
					<span class="indicador_navegacionegacion">Rectangular</span>&gt;
					<span class="indicador_navegacionegacion">Pared compuesta</span>&gt;
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu201"]))
		{
			if ($_POST["boton_menu201"] == "Despejar variable")
			{
				echo '<span class="indicador_navegacionegacion">'.$_POST["group1"].'</span>';
				menu_variable_seleccionada();
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
		function menu_variable_seleccionada()
		{
?>
			<form action="paredcompuesta.php" method="post">
			<fieldset>
			<legend>Ingrese las variables que se le piden para hacer el cálculo</legend>
<?php
			$DespVar = $_POST["group1"];
			
			switch($DespVar)
			{
				Case "RT"://listo
				$numParedes = $_POST["group2"];
				for($i=0;$i<$numParedes;$i++)
				{
					echo '<label for ="calibre'.$i.'">Ingrese el calibre'.$i.':';
					echo '<input type="text" id = "calibre"'.$i.'" name="calibre'.$i.'" size="10" maxlength="10" />m<br>';
					
					echo '<label for ="Material'.$i.'">Ingrese el nombre del Material'.$i.':';
					echo '<input type="text" id = "Material'.$i.'" name="Material'.$i.'" size="10" maxlength="10" />BTU/M°C<br>';
					
					echo '<label for ="A'.$i.'">Ingrese el area A'.$i.':';
					echo '<input type="text" id = "A'.$i.'" name="A'.$i.'" size="10" maxlength="10" />m2<br>';
					echo '<hr>';
				}
				
				echo '<input type="hidden" id="case" name="case"value="RT">';
				echo '<input type="hidden" id="group2" name="group2"value="'.$numParedes.'">';
					break;
				Case "Tfinal"://listo
?>
					<label for ="RT">Ingrese RT:
					<input type="text" id = "RT"name="RT" size="10" maxlength="10" />W/m°k<br>
					
					<label for ="Tinicial">Ingrese la temperatura Tinicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					<input type="hidden" id="case" name="case"value="Tfinal">
<?php
					break;
				Case "Tinicial"://listo
?>
					<label for ="RT">Ingrese la resistencia RT:
					<input type="text" id = "RT"name="RT" size="10" maxlength="10" />°W/mk<br>
					
					<label for ="Tfinal">Ingrese la temperatura Tfinal:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					<input type="hidden" id="case" name="case"value="Tinicial">
<?php
				break;
				Case "q"://listo
?>
					<label for ="RT">Ingrese RT:
					<input type="text" id = "RT"name="RT" size="10" maxlength="10" />W/m°k<br>
					
					<label for ="Tfinal">Ingrese la temperatura Tfinal:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
					<label for ="Tinicial">Ingrese la temperatura Tinicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					<input type="hidden" id="case" name="case"value="q">
<?php
					break;
			}
?>
				</fieldset>
				<input type="submit" name = "Calcular" value="Calcular" />
			</form>
<?
		}
		
		function buscarMaterial($mat)
		{
			$cadbusca="SELECT conductividad FROM materiales WHERE nombre = '".$mat."'";
			$result=mysql_query($cadbusca);
					
			if($row=mysql_fetch_array($result))
			{
				return $row['conductividad'];
			}
			else
			{
				echo "No se encontro el material: ".$mat;
				return null;
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
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			$K[0]=0;
			if(isset($_POST["group2"]))
			{
				$numParedes = $_POST["group2"];
				for($i=0;$i<$numParedes;$i++)
				{
					If (isset($_POST["Material".$i]))
					{
						$K[$i] = buscarMaterial($_POST["Material".$i]);
					}
				}
			}
			
			switch($_POST["case"])
			{
            	Case "RT"://listo
					if(isset($_POST["group2"]))
					{
						$RT=0;
						$numParedes = $_POST["group2"];
						
						for($i=0;$i<$numParedes;$i++)
						{
							$Calibre[$i] = $_POST["calibre".$i];
							$A[$i] = $_POST["A".$i];
							If ($A[$i] == 0)
							{
								echo "No se permite la división entre cero";
								return;
							}
							
							$RT += $Calibre[$i]/($K[$i]*$A[$i]);
						}
						
						echo "El resultado es".$RT." W/m°k";
						
						if(isset($_SESSION["envio_correo"]) AND isset($_SESSION["email"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($A,"W/m°k");
							}
						}
					}
					else
						echo "Ingrese todos los nombres de materiales";
				break;
				Case "Tinicial"://listo
				
					$RT = $_POST["RT"];
					$t2 = $_POST["Tfinal"];
					$q = $_POST["q"];
					
					$t1 = -(($q * $RT) - $t2);
					echo  "El resultado es ".$t1." °k";
					
					if(isset($_SESSION["envio_correo"]) AND isset($_SESSION["email"]))
					{
						if($_SESSION["envio_correo"] == 1)
						{
							enviarCorreo($t1,"°k");
						}
					}
				break;
				Case "Tfinal"://Listo
				
					$t1 = $_POST["Tinicial"];
					$RT = $_POST["RT"];
					$q = $_POST["q"];
					
					$t2 = ($q * $RT) + $t1;
						
					echo "El resultado es ".$t2." °k";
					
					if(isset($_SESSION["envio_correo"]) AND isset($_SESSION["email"]))
					{
						if($_SESSION["envio_correo"] == 1)
						{
							enviarCorreo($t2,"°k");
						}
					}
				break;
				Case "q"://listo
					$t2 = $_POST["Tfinal"];
					$t1 = $_POST["Tinicial"];
					$RT = $_POST["RT"];
					
					If ($RT == 0)
						echo "No se permite la división entre cero";
					Else
					{
						$q = ($t1 - $t2) / $RT;
						echo "El resultado es ".$q." W";
						
						if(isset($_SESSION["envio_correo"]) AND isset($_SESSION["email"]))
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