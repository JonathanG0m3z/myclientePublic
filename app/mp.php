<!DOCTYPE html>
<html lang="es">
<head>
<link href='images/logo.png' rel='shortcut icon' type='image/png'>
  <title>MyCliente</title>

</head>
<body>
<?php
include("menus/menuhome.php");
?>
<section style='font: arial;color:#000;'>
  <br>
<center>
    <img src="images/mp.png" width="35%";>
    <h1 style="font-size: 200%;">Bienvenido</h1>
    <h2 style="font-size: 200%;"><?php echo $_SESSION['nombre']; ?></h2>
    <h2 style="font-size: 200%;"><?php echo date("Y-m-d"); ?></h2>
  <p style="font-size: 200%;">Sistema MyCliente 
  </center>
</section>
</body>
</html>