<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Formulario de registro al sitio</title>
<link rel="stylesheet" type="text/css" href="tiendaspuebla.css"/>
</head>

<body>
<?php
	mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
	mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());
	session_start();
	
	function formRegistro()
	{
?>
		<form action="registrar.php" method="post">
		<fieldset>
		<legend>Registro</legend>
			<label>Los datos marcados con  *  son obligatorios</label>
			<br/>
			<label for ="email">* Email:   
			<input type="text" name="email" size="40"/>
			<br/>
			Asegurece que su correo sea valido, se le enviara información.
			<label for ="nombre">* Nombre(s) (max 60): 
			<input type="text" name="nombre" size="30" maxlength="60" />
			<label for ="apellidos">* Apellidos(s) (max 60): 
			<input type="text" name="apellidos" size="30" maxlength="60" />
		</fieldset>
		<input type="submit" value="Registrar"/>
		</form>
<?php
	}
// verificamos si se han enviado ya las variables necesarias.
if (isset($_POST["email"]))
{
	$email = $_POST["email"];
	$nombre = $_POST["nombre"];
	$apellidos = $_POST["apellidos"];
	// Hay campos en blanco
	if($email==NULL|$nombre==NULL|$apellidos==NULL)
	{
		echo "un campo está vacio.";
		formRegistro();
	}
	else
	{
		// Comprobamos si el nombre de usuario o la cuenta de correo ya existían
		$username = uniqid(); //Genera un id único para identificar la cuenta a traves del correo.
		$password = rand(1001,9999);//Contraseña temporal
		$date = date("Y-m-d");
		
		$checkuser = mysql_query("SELECT usuario FROM usuario WHERE usuario='".$username."'");
		$username_exist = mysql_num_rows($checkuser);
		$checkemail = mysql_query("SELECT email FROM usuario WHERE email='".$email."'");
		$email_exist = mysql_num_rows($checkemail);
		
		if ($email_exist>0|$username_exist>0)
		{
			echo "<label>La cuenta de correo </label>".$email."<label>estan ya en uso</label>";
			formRegistro();
		}
		else
		{
			$query = 'INSERT INTO usuario (usuario, password, email, fecha, nombre, apellidos,cuenta_validada)
			VALUES (\''.$username.'\',\''.$password.'\',\''.$email.'\',\''.$date.'\',\''.$nombre.'\',\''.$apellidos.'\',false)';
			mysql_query($query) or die(mysql_error());
			
			$mensaje = '<html><head><center>Registro en www.zytez.com/transferenciadecalor<center></head><';
			//primer barra
			$mensaje.= 'body><h3><font color="red">no responda a este correo si lo desea hacer envie un correo a:</font> alejandrofernandez@zytez.com </h3><h1>ESTOS SON TUS DATOS DE REGISTRO:</h1><HR align="LEFT" size="4" width="500" color="Black" noshade>';
			$mensaje.= '<h4> <p align="left"><font color="red">Usuario: '.$username.' <br>Correo: '.$email.' <br>Contraseña: '.$password.'</font></p></h4>';
			//segunda barra
			$mensaje.= '<HR align="LEFT" size="4" width="500" color="Black" noshade> <p>Debes activar tu cuenta pulsando este enlace: <a href="www.zytez.com/transferenciadecalor/activacion.php?id='.$username.'"><font color="blue"> CLICK AQUI PARA ACTIVAR TU CUENTA</font></a><p>SI NO PUEDES VISUALIZAR EL LINK ANTERIOR HAZ UN REFRESH A TU NAVEGADOR WEB ó PEGA ESTE LINK DIRECTAMENTE:  <font color="black">www.zytez.com/transferenciadecalor/activacion.php?id='.$username.'</font></p></h2><br><br></body></html>';
			
			$header = "From: alejandrofernandez@zytez.com \nMime-Version: 1.0\nContent-Type: text/html; charset=ISO-8859-1\nContent-Transfer-Encoding: 7bit";

			$asunto = "'Activación de tu cuenta en www.zytez.com/transferenciadecalor'"; 

			if( mail($email,$asunto,$mensaje,$header) )
			{ 
				echo "<br><br><label>Se ha enviado un mensaje a tu correo electrónico con el código de activación</label><br>"; 
			}
			else
			{ 
				echo "<br><br><label>Ha ocurrido un error y no se puede enviar el correo </label><br/>".$mensaje;
			}
			
			echo '<br><label>El correo: </label>'.$email.' <label> ha sido registrado de manera satisfactoria.</label><br />';
			echo '<label><br>Ahora abra su correo electrónico para continuar con el registro ingresando sus datos de usuario y su password que han sido enviados a su correo<br /></label>';
			
			?>
			<FORM ACTION="validar_usuario.php" METHOD="post">
				<fieldset>
				<legend>Login</legend>
				Email : <INPUT TYPE="text" NAME="email" MAXLENGTH=20><br />
				Password: <INPUT TYPE="password" NAME="password" MAXLENGTH=10><br />
				</fieldset>
				<INPUT TYPE="submit" VALUE="Ingresar">
			</FORM>
			<?php
		}
	}
}
else
{
	formRegistro();
}
?>
</body>
</html>