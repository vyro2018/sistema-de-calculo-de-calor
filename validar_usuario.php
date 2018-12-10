<?php
//include(opendb.php);
session_start();
mysql_connect('localhost','pd000040_tesis','Alejandra2012')or die ('Ha fallado la conexión: '.mysql_error());
mysql_select_db('pd000040_zytezDB')or die ('Error al seleccionar la Base de Datos: '.mysql_error());

if(trim($_POST["email"]) != "" && trim($_POST["password"]) != "")
{
	$email = $_POST["email"];
	$password = $_POST["password"];
	
	if($_POST['email'] == "++admin++")
	{
		$result = mysql_query('SELECT email FROM admin WHERE email =\''.$password.'\'');
		
		if($row = mysql_fetch_array($result))
		{
			$_SESSION['email'] =$password;
			echo '<SCRIPT LANGUAGE="javascript">';
			echo '	location.href = "mantenimiento_user_admin.php";';
			echo '</SCRIPT>';
		}
	}
	else
	{
		$result = mysql_query('SELECT email,password, cuenta_validada FROM usuario WHERE email=\''.$email.'\'');
?>
		<div id="menu_contenido">
				<!--Este es el menu de navegacionegacion que indica el nivel donde te encuentras dentro del sitio-->
				<div class="navegacion">
					<br>
					<span class="indicador_navegacionegacion">Home</span>&gt;
					<span class="indicador_navegacionegacion">validando email</span>
				</div>
		</div>
<?php
		if($row = mysql_fetch_array($result))
		{
			if($row["password"] == $password)
			{
				if($row["cuenta_validada"] == 1)
				{
					$_SESSION['email'] = $email;
					echo '<SCRIPT LANGUAGE="javascript">';
					echo '	location.href = "mantenimiento_user.php";';
					echo '</SCRIPT>';
				}
				else
				{
					echo '<br><label>Por motivos de SEGURIDAD la cuenta de correo </label>'.$row["email"].'<label>Aun no ha sido confirmada, porfavor ingrese a su correo y siga los pasos que se le indican ahí. Recuerde que su registro sera eliminado a los 7 dias de no haber validado su cuenta de correo, si existe algún problema con la validación de su cuenta envie un correo a <font color="red">alejandrofernandez@zytez.com </font> indicando el problema y un correo alternativo al cual se le respondera(indiquelo en el mismo mensaje).</label>';
					
					echo '<a href="/transferenciadecalor/index1.php">CLICK AQUI PARA REGRESAR A LA APLICACIÓN</a>--- o de <a href="'.$_SERVER["HTTP_REFERER"].'">CLICK ATRAS EN SU NAVEGADOR</a>';
				}
			}
			else
			{
				echo 'Password ó contraseña incorrecto';
			}
		}
		else
		{
			echo '<br>'.$email;
			echo '<br>'.$password;
			echo '<br>'."Revice la ortografia";
		}
		mysql_free_result($result);
	}
}
else
{
	echo 'Debe especificar un email y password';
}
mysql_close();
?>