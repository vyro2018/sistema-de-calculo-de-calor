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
					<span class="indicador_navegacionegacion">Pared simple</span>&gt;
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
				<br>
				<br>
				<br>
				</div>
			</div>
		</div>
<?php		
    
    
    
		function menu_variable_seleccionada($variable)
		{
?>
			<form action="paredsimple.php" method="post">
			<fieldset>
			<legend>Ingrese las variables que se le piden para hacer el cálculo</legend>
<?php
			$DespVar = $variable;
			
			switch($DespVar)
			{
				Case "dT":
?>
					<label for ="T1">Ingrese la temperatura T1:
					<input type="text" id = "T1"name="T1" size="10" maxlength="10" />°K<br>
					
					<label for ="T0">Ingrese la temperatura T0:
					<input type="text" id = "T0"name="T0" size="10" maxlength="10" />°K<br>
					<input type="hidden" id="case" name="case"value="dT">
<?php
				break;
				
				Case "calibre":
?>
					<label for ="dT">Ingrese la temperatura dT:
					<input type="text" id = "dT"name="dT" size="10" maxlength="10" />°K<br>
					
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m°K<br>
					<input type="hidden" id="case" name="case"value="calibre">
<?php
					break;
				Case "A":
?>
					<label for ="dT">Ingrese la temperatura dT:
					<input type="text" id = "dT"name="dT" size="10" maxlength="10" />°K<br>
					
					<label for ="calibre">Ingrese el calibre:
					<input type="text" id = "calibre"name="calibre" size="10" maxlength="10" />m<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					<input type="hidden" id="case" name="case"value="A">
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m°K<br>
					<input type="hidden" id="case" name="case"value="A">
<?php
					break;
				Case "R":
?>
					<label for ="calibre">Ingrese el calibre:
					<input type="text" id = "calibre"name="calibre" size="10" maxlength="10" />m<br>
					
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="Material">Ingrese el nombre del material:
					<input type="text" id = "Material"name="Material" size="20" maxlength="10" />W/m°K<br>
					<input type="hidden" id="case" name="case"value="R">
<?php
				break;
				Case "q":
?>
					<label for ="A">Ingrese el area A:
					<input type="text" id = "A"name="A" size="10" maxlength="10" />m2<br>
					
					<label for ="T0">Ingrese el diferencial de temperatura dT:
					<input type="text" id = "dT"name="dT" size="10" maxlength="10" />°k<br>
					
					<label for ="calibre">Ingrese el calibre:
					<input type="text" id = "calibre"name="calibre" size="10" maxlength="10" />m<br>
					
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
			$K=0.0;
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<br>";
    		switch($_POST["case"])
			{
				Case "A":
				
					$dT = $_POST["dT"];
					$calibre = $_POST["calibre"];
					$q = $_POST["q"];
					
					If (isset($_POST["Material"]))
					{
						$K = buscarMaterial();
					}
					
					If( $dT == 0)
						echo "No se permite la división entre cero";
					Else
					{
						$A = ($calibre * $q) / ($dT * $K);
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
						$K = buscarMaterial();
					}
					
					$A = $_POST["A"];
					$calibre = $_POST["calibre"];
					
					If ($A == 0 )
						echo "No se permite la división entre cero";
					Else
					{
						$r = $calibre / ($K * $A);
						echo "El resultado es ".$r." m";
						
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($r,"m");
							}
						}
					}
				break;
				Case "q":
					If (isset($_POST["Material"]))
					{
						$K = buscarMaterial();
					}
					
					$A = $_POST["A"];
					$dT = $_POST["dT"];
					$calibre = $_POST["calibre"];
					
					If ($A*$K == 0)
					{
						echo "No se permite la división entre cero, cambie A ó el material";
					}
					Else
					{
						$r = $calibre / ($A*$K);
						if($r==0)
						{
							echo "No se permite la división entre cero, cambie el Calibre";
							return;
						}
						$q = $dT / $r;
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
				Case "dT":
					$t1 = $_POST["T1"];
					$t0 = $_POST["T0"];
					
					$dT = $t1 - $t0;
					
					echo "El resultado es".$dT." °k";
					if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($dT,"°k");
							}
						}
				break;
				Case "calibre":
					
					$dT = $_POST["dT"];
					$A = $_POST["A"];
					$q = $_POST["q"];
					
					If (isset($_POST["Material"]))
					{
						$K = buscarMaterial();
					}
					
					If ($q == 0)
						echo "No se permite la division por cero";
					Else
					{
						$Calibre = ($dT * $K * $A) / $q;
						
						echo "El resultado es ".$Calibre." w/m°k";
						
						if(isset($_SESSION["envio_correo"]))
						{
							if($_SESSION["envio_correo"] == 1)
							{
								enviarCorreo($Calibre,"w/m°k");
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
			
			$cadbusca="SELECT numero_usos FROM estadisticas WHERE dia = ".$dia." AND mes = ".$mes." AND año = ".$año;
			$result=mysql_query($cadbusca);
			
			if($row=mysql_fetch_array($result))
			{
				$cadbusca="UPDATE estadisticas SET numero_usos = numero_usos+ 1 WHERE dia = ".$dia." AND mes = ".$mes." AND año = ".$año;
				mysql_query($cadbusca);
			}
			else
			{
				$cadbusca="INSERT INTO estadisticas VALUES('".$dia."','".$mes."','".$año."','1')";
				mysql_query($cadbusca);
			}
		}
		
		function errorSeleccion()
		{
?>
			<h1>Regresa a la ventana de inicio y selecciona una opcion valida</h1><br/>
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