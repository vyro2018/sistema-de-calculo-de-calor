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
		$q=0.0; $qTemp=0; $t0=0.0; $T3=0.0; $K0=0.0; $K1=0.0; $L=0.0;
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
					<span class="indicador_navegacionegacion">Tubo compuesto</span>&gt;
<?php		
		// verificamos si se han enviado ya las variables necesarias.
		if(isset($_POST["boton_menu201"]))
		{
			if ($_POST["boton_menu201"] == "Despejar variable")
			{
				echo '<span class="indicador_navegacionegacion">'.$_POST["group1"].'</span>';
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
			<form action="tubocompuesto.php" method="post">
			<fieldset>
			<legend>Ingrese las variables que se le piden para hacer el cálculo</legend>
<?php
			$DespVar = $variable;
			
			switch($DespVar)
			{
				Case "L"://listo
?>
					<label for ="Tinicial">Ingrese la temperatura Tinicial:
					<input type="text" id = "Tinicial" name="Tinicial" size="10" maxlength="10" />m2<br>
					
					<label for ="Tfinal">Ingrese la temperatura Tfinal:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />m2<br>
					
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>					
<?php					
					for($i=0;$i<$_POST["group2"];$i++)
					{
						echo '<hr>';
						echo '<label for ="r'.$i.'">Ingrese el radio r'.$i.':';
						echo '<input type="text" id = "r'.$i.'"name="r'.$i.'" size="10" maxlength="10" />m<br>';
					}
					
					for($i=0;$i<$_POST["group2"]-1;$i++)
					{
						echo '<hr>';
						echo '<label for ="Material'.$i.'">Ingrese nombre del Material'.$i.':';
						echo '<input type="text" id = "Material'.$i.'"name="Material'.$i.'" size="10" maxlength="10" />m<br>';
					}
?>
					<input type="hidden" id="case" name="case"value="L">
<?php
					break;
				Case "Tinicial"://listo
?>
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<label for ="L">Ingrese la longitud L:
					<input type="text" id = "L"name="L" size="10" maxlength="10" />m<br>
					
					<label for ="Tfinal">Ingrese la temperatura Tfinal:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
					
<?php					
					for($i=0;$i<$_POST["group2"];$i++)
					{
						echo '<hr>';
						echo '<label for ="r'.$i.'">Ingrese el radio r'.$i.':';
						echo '<input type="text" id = "r'.$i.'"name="r'.$i.'" size="10" maxlength="10" />m<br>';
					}
					
					for($i=0;$i<$_POST["group2"]-1;$i++)
					{
						echo '<hr>';
						echo '<label for ="Material'.$i.'">Ingrese nombre del Material'.$i.':';
						echo '<input type="text" id = "Material'.$i.'"name="Material'.$i.'" size="10" maxlength="10" />m<br>';
					}
?>
					<input type="hidden" id="case" name="case"value="Tinicial">
<?php
					break;
				Case "Tfinal"://listo
?>
					<label for ="q">Ingrese el flujo de calor q:
					<input type="text" id = "q"name="q" size="10" maxlength="10" />W<br>
					
					<label for ="L">Ingrese la longitud L:
					<input type="text" id = "L"name="L" size="10" maxlength="10" />m<br>
					
					<label for ="Tinicial">Ingrese la temperatura Tinicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
<?php					
					for($i=0;$i<$_POST["group2"];$i++)
					{
						echo '<hr>';
						echo '<label for ="r'.$i.'">Ingrese el radio r'.$i.':';
						echo '<input type="text" id = "r'.$i.'"name="r'.$i.'" size="10" maxlength="10" />m<br>';
					}
					
					for($i=0;$i<$_POST["group2"]-1;$i++)
					{
						echo '<hr>';
						echo '<label for ="Material'.$i.'">Ingrese nombre del Material'.$i.':';
						echo '<input type="text" id = "Material'.$i.'"name="Material'.$i.'" size="10" maxlength="10" />m<br>';
					}
?>
					<input type="hidden" id="case" name="case"value="Tfinal">
<?php
				break;
				Case "q"://listo
?>
					<label for ="L">Ingrese la longitud L:
					<input type="text" id = "L"name="L" size="10" maxlength="10" />m2<br>
					
					<label for ="Tinicial">Ingrese la temperatura T inicial:
					<input type="text" id = "Tinicial"name="Tinicial" size="10" maxlength="10" />°k<br>
					
					<label for ="Tfinal">Ingrese la temperatura T final:
					<input type="text" id = "Tfinal"name="Tfinal" size="10" maxlength="10" />°k<br>
<?php
					for($i=0;$i<$_POST["group2"];$i++)
					{
						echo '<hr>';
						echo '<label for ="r'.$i.'">Ingrese el radio r'.$i.':';
						echo '<input type="text" id = "r'.$i.'"name="r'.$i.'" size="10" maxlength="10" />m<br>';
					}
					
					for($i=0;$i<$_POST["group2"]-1;$i++)
					{
						echo '<hr>';
						echo '<label for ="Material'.$i.'">Ingrese el Material'.$i.':';
						echo '<input type="text" id = "Material'.$i.'"name="Material'.$i.'" size="10" maxlength="10" />m<br>';
					}
?>					
					<input type="hidden" id="case" name="case" value="q">
<?php
					break;
			}
			echo '<input type="hidden" id="group2" name="group2" value="'.$_POST["group2"].'?>">';
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
			$Pi = 3.1416;
			if(isset($_POST["group2"]))
			{
				for($i=0;$i<$_POST["group2"]-1;$i++)
				{
					$K[$i] = buscarMaterial($_POST["Material".$i]);
				}
			}
			echo"<br>";
			echo"<br>";
			echo"<br>";
			echo"<br>";

			switch($_POST["case"])
			{
				Case "L"://listo
					
					$q = $_POST["q"];
					$tfinal = $_POST["Tfinal"];
					$tinicial = $_POST["Tinicial"];
					
					for($i=0;$i<$_POST["group2"];$i++)
						$R[$i] = $_POST["r".$i];
						
					for($i=0;$i<$_POST["group2"];$i++)
					{
						$R[$i] = $_POST["r".$i];
						
						If ($i+1 < $_POST["group2"])
						{
							if($R[$i+1] - $R[$i] == 0 or $R[$i+1] == 0 or $R[$i]==0)
							{
								echo "No se permite la división entre cero";
								return;
							}
							else
							{
								$qTemp+=log($R[$i+1] / $R[$i]) / (2 * $Pi * $K[$i]);
								$L = ($q / ($tinicial - $tfinal)) * $qTemp;
								echo "El resultado es".$L." m";
								
								if(isset($_SESSION["envio_correo"]) AND isset($_SESSION["email"]))
								{
									if($_SESSION["envio_correo"] == 1)
									{
										enviarCorreo($L,"m");
									}
								}
					
								break;
							}
						}
					}
				break;
				Case "Tinicial"://listo
					
					
					$q = $_POST["q"];
					$Tfinal = $_POST["Tfinal"];
					$L = $_POST["L"];
					for($i=0;$i<$_POST["group2"];$i++)
						$R[$i] = $_POST["r".$i];
					
					for($i=0;$i<$_POST["group2"];$i++)
					{
						If ($i+1 < $_POST["group2"])
						{
							if($R[$i+1] - $R[$i] == 0 or $R[$i+1] == 0 or $R[$i]==0)
							{
								echo "No se permite la división entre cero";
								return;
							}
							else
							{
								$qTemp+=(log($R[$i+1] / $R[$i]) / (2 * $Pi * $K[$i] * $L));
								
							}
						}
					}
					
					$tinicial = $q * $qTemp + $Tfinal;
					echo  "El resultado es ".$tinicial." °k";
					
					if(isset($_SESSION["envio_correo"]) AND isset($_SESSION["email"]))
					{
						if($_SESSION["envio_correo"] == 1)
						{
							enviarCorreo($tinicial,"°k");
						}
					}
				break;
				Case "Tfinal":
					
					
					$L = $_POST["L"];
					$t0 = $_POST["T0"];
					$q = $_POST["q"];
					
					for($i=0;$i<$_POST["group2"];$i++)
						$R[$i] = $_POST["r".$i];
						
					for($i=0;$i<$_POST["group2"];$i++)
					{
						$R[$i] = $_POST["r".$i];
						
						If ($i+1 < $_POST["group2"])
						{
							if($R[$i+1] - $R[$i] == 0 or $R[$i+1] == 0 or $R[$i]==0)
							{
								echo "No se permite la división entre cero";
								return;
							}
							else
							{
								$qTemp+=(log($R[$i+1] / $R[$i]) / (2 * $Pi * $K[$i] * $L));
								
							}
						}
					}
					
					$tfinal = $tinicial - $q * $qTemp;
					echo "El resultado es ".$tfinal." °k";
					if(isset($_SESSION["envio_correo"]) AND isset($_SESSION["email"]))
					{
						if($_SESSION["envio_correo"] == 1)
						{
							enviarCorreo($tfinal,"°k");
						}
					}
				break;
				Case "q"://listo
					
					$L = $_POST["L"];
					$tinicial = $_POST["Tinicial"];
					$tfinal = $_POST["Tfinal"];
					
					for($i=0;$i<$_POST["group2"];$i++)
						$R[$i] = $_POST["r".$i];
						
					$qTemp=0;
					
					for($i=0;$i+1<$_POST["group2"];$i++)
					{
						if(($R[$i+1] - $R[$i] == 0) or ($R[$i+1] == 0) or ($R[$i]==0))
							echo "No se permite la división entre cero";
						else
						{
							$qTemp+=(log($R[$i+1] / $R[$i]) / (2 * $Pi * $K[$i] * $L));
						}
					}
					
					$q = $tinicial - $tfinal;
					$q /= $qTemp;
					
					echo "El resultado es ".$q." W";
					
					if(isset($_SESSION["envio_correo"]) AND isset($_SESSION["email"]))
					{
						if($_SESSION["envio_correo"] == 1)
						{
							enviarCorreo($q,"W");
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