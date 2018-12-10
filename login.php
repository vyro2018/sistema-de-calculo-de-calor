<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" type="text/css" href="tiendaspuebla.css"/>
</head>

<body>
<form action="validar_usuario.php" method="post">
<fieldset>
<legend>Login</legend>

<label for ="email">email:
<input type="text" id = "email"name="email" size="60" maxlength="60" />

<label for ="password">Password:
<input type="password" id="password" name="password" size="50" maxlength="50" />

</fieldset>
<input type="submit" value="Ingresar" />
</form>
</body>
</html>