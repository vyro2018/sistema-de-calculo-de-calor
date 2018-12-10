<?php
	mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
	mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
	session_start();
	
	function quitar($mensaje)
	{
		$nopermitidos = array("'",'\\','<','>',"\"");
		$mensaje = str_replace($nopermitidos, "", $mensaje);
		return $mensaje;
	}
	
	// verificamos si se han enviado ya las variables necesarias.
	if(trim($_POST["usuario"]) != "" && trim($_POST["password"]) != "" && trim($_POST["nombre"]) != "" && trim($_POST["apellidos"]) != "")
	{
		$query=NULL;
		
		$usuario = $_POST["usuario"];
		$usuario1 = quitar($_POST["usuario"]);
		
		$password = $_POST["password"];
		$nombre = $_POST["nombre"];
		$apellidos = $_POST["apellidos"];
		
		$query = "UPDATE usuario SET usuario ='".$usuario."',nombre = '".$nombre."',apellidos='".$apellidos."', password = '".$password."' WHERE email='".$_SESSION['email']."'";
		mysql_query($query) or die(mysql_error());
		mysql_free_result($query);
		$_SESSION['usuario']=$usuario;
		echo 'Cambios realizados correctamente';
		echo '<SCRIPT LANGUAGE="javascript">';
		echo '	location.href = "mantenimiento_user.php";';
		echo '</SCRIPT>';
	}
	else
	{
		echo '<SCRIPT LANGUAGE="javascript">';
		echo '	location.href = "mantenimiento_user.php";';
		echo '</SCRIPT>';
		echo '<font color="red">';
		echo "Los siguientes campos no pueden quedar vacios: ";
		if($usuario==NULL)
			echo "-usuario-";
		if($usuario != $usuario1)
			echo '-No puedes usar caracteres extraños que no sean letras o numeros solamente con excepcion de "_" ó "-".-';
		if($nombre==NULL)
			echo "-nombre-";
		if($apellidos==NULL)
			echo "-apellidos-";
		if($password == NULL)
			echo"-password-";
		echo'</font>';
	}
?>