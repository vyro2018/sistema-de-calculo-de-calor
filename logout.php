<?php
session_start();
// Borramos toda la sesion
session_destroy();
echo "Sesión finalizada";
?>
<SCRIPT LANGUAGE="javascript">
location.href = "index1.php";
</SCRIPT>