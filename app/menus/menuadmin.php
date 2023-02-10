<?php
session_start();
include("../controller/seguridad.php");
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <link href='images/logo.png' rel='shortcut icon' type='image/png'>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>
<style>
  
  header{
    width: 100%;
    margin: 0 auto;
  }
  ul{
    list-style: none;
  }
  #menu li>a{
    display: block;
    text-decoration: none;
  }
  #menu>li>ul{
    display: none;
  }
  #menu>li:hover>ul {
    display:block;
  }
  #menu>li{
    float: left;
  }
</style>
<header>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <?php 
      if ($_SESSION['permiso']=='Administrador') {?>
        <a class="navbar-brand" href="admin">Usuario: <?php echo $_SESSION['nombre']; ?></a><?php
      }else {?>
        <a class="navbar-brand" href="#">Usuario: <?php echo $_SESSION['nombre']; ?></a><?php
      }
      ?>
    </div>
    <ul class="nav navbar-nav" id="menu">
      <li><a href="mp">Inicio</a></li>
      <li><a href="clientes?idu=&user=">Clientes</a></li>
      <li><a href="#">Informes</a>
          <ul class="nav navbar-nav" id="menu">
            <li><a href="precios">Precios</a></li>
            <br>
            <li><a href="informe_general">Informe general</a></li>
            <br>
            <li><a href="informe_servicio">Informe por servicios</a></li>
          </ul>
      </li>
      <li><a href="soporte">Soporte técnico</a></li>
        <li><a href="#">Funciones futuras</a>
          <ul class="nav navbar-nav" id="menu">
          <li><a href="enviosms1">Notificaciones SMS</a></li>
            <br>
            <li><a href="enviowhatsapp">Notificaciones WhatsApp</a></li>
          </ul>
        </li>
    <a href="../controller/cerrars">
          <button class="btn btn-danger navbar-btn">Salir</button>
        </a>
  </div>
</nav>
</header>
</html>