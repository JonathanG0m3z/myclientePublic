<?php
//inicializa la session
session_start();
//carga los datos de la base de datos
unset($_SESSION['cedula']);
unset($_SESSION['nombre']);
unset($_SESSION['permiso']);
//se destruye la session
session_destroy();
//redirecciona al index
echo "<script type='text/javascript'>
	window.location.replace('../')
</script>";
?>