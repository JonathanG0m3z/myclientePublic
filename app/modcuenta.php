<?php
session_start();
include('../controller/seguridad.php');
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>

<head>
  <link href='images/logo.png' rel='shortcut icon' type='image/png'>
  <title>MyCliente</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="../views/renov.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <script src="../app/lib/js/funcionalert.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <?php
  include '../controller/conexion.php';
  if (isset($_REQUEST['idu']) and isset($_REQUEST['user']) and isset($_REQUEST['email'])) {
    $id = $_REQUEST['idu'];
    $id_usuario = $_REQUEST['user'];
    $email = $_REQUEST['email'];
    $sqlc = "SELECT * FROM tbl_cuentas WHERE id_cuenta='$id'";
    $rs = mysqli_query($con, $sqlc);
    while ($reg = mysqli_fetch_array($rs)) {
  ?>

      <div style="background-color:rgba(0,0,0,0.9); width: 70%; margin: auto; border: 10px; border-radius:10px;">
        <center>
          <br><br>
          <h2>Modificar cuenta</h2>
        </center>
        <form action="" method="post">
          <div class="form-group">
            <div class="form-group" id="campo11">
              <label for="exampleInputEmail1">
                <h4>Correo electrónico:</h4>
              </label>
              <br>
              <input type="email" autocomplete="off" name="correo_cuenta" value="<?= $reg['correo_cuenta'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <h4>Contraseña:</h4>
              </label>
              <br>
              <input type="text" autocomplete="off" name="clave" value="<?= $reg['contraseña_cuenta'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <h4>Cantidad de perfiles:</h4>
              </label>
              <br>
              <input type="number" autocomplete="off" name="perfiles" value="<?= $reg['perfiles'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <h4>Siguiente fecha de renovación:</h4>
              </label>
              <br>
              <input type="date" autocomplete="off" name="fecha_vencimiento" value="<?= $reg['fecha_vencimiento'] ?>">
            </div>
            <center>
              <button style="background-color:#4458ff ; color:white;" class="btn " name="btnmod" type="submit">Modificar</button>
              <a style="background-color:#e61062 ; color:white;" href="clientes?idu=&user=" class="btn ">Cancelar</a>
            </center>
        </form>
      </div>
  <?php
    }
  }
  include '../controller/cerrar_conx.php';
  ?>
  <br />
  </div>
  </div>
  <?php
  if (isset($_POST['btnmod'])) {
    include '../controller/conexion.php';
    $correo = $_POST['correo_cuenta'];
    $contraseña = $_POST['clave'];
    $perfiles = $_POST['perfiles'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $mod = "UPDATE `tbl_cuentas` SET `correo_cuenta`='$correo',`contraseña_cuenta`='$contraseña',
    `perfiles`='$perfiles',`fecha_vencimiento`='$fecha_vencimiento' WHERE id_cuenta='$id' and id_usuario='$id_usuario'";
    if (!mysqli_query($con, $mod)) {
      echo "<script type='text/javascript'>";
      echo "alerta('¡ERROR! NO SE PUEDE RENOVAR LA CUENTA','error','clientes?idu=&user=');";
      echo "</script>";
    } else {
      $mod2 = "UPDATE `tbl_clientes` SET `cuenta`='$correo',`clave_cuenta`='$contraseña' WHERE cuenta='$email' and id_usuario='$id_usuario'";
      if (!mysqli_query($con, $mod2)) {
        echo "<script type='text/javascript'>";
        echo "alerta('¡ERROR! NO SE PUEDE RENOVAR LA CUENTA','error','clientes?idu=&user=');";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alerta('Modificación éxitosa','success','clientes?idu=&user=');";
        echo "</script>";
      }
    }
    include '../controller/cerrar_conx.php';
  }
  ?>
</body>

</html>