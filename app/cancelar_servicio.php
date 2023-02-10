<?php
$id = $_REQUEST['idu'];
$id_user = $_REQUEST['user'];
$sql23 = "DELETE FROM `tbl_clientes` WHERE id=$id and id_usuario=$id_user";
include('../controller/conexion.php');
if (!mysqli_query($con, $sql23)) {
  include('../controller/cerrar_conx.php');
  echo "<script type='text/javascript'>";
  echo "alert('¡ERROR DE CONEXIÓN!');";
  echo "</script>";
} else {
  include('../controller/cerrar_conx.php');
  echo "<script type='text/javascript'>";
  echo "window.location.replace('clientes?idu=&user=');";
  echo "</script>";
}
