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
  if (isset($_REQUEST['idu']) and isset($_REQUEST['user'])) {
    $id = $_REQUEST['idu'];
    $id_usuario = $_REQUEST['user'];
    $sqlc = "SELECT * FROM tbl_clientes, tbl_servicio WHERE tbl_clientes.id = $id and tbl_clientes.id_usuario=$id_usuario
    and tbl_clientes.id_servicio=tbl_servicio.id_servicio";
    $rs = mysqli_query($con, $sqlc);
    while ($reg = mysqli_fetch_array($rs)) {
  ?>

      <div style="background-color:rgba(0,0,0,0.9); width: 70%; margin: auto; border: 10px; border-radius:10px;">
        <center>
          <br><br>
          <h2>Modificar venta</h2>
        </center>
        <form action="" method="post">
          <div class="form-group">

            <div class="form-group" id="campo9">
              <label for="exampleInputEmail1">
                <h4>Nombre del cliente:</h4>
              </label>
              <br>
              <input required type="text" autocomplete="off" name="nombre_cliente" value="<?= $reg['nombre_cliente'] ?>">
            </div>
            <div class="form-group" id="campo9">
              <label for="exampleInputEmail1">
                <h4>Teléfono:</h4>
              </label>
              <br>
              <input type="number" autocomplete="off" name="telefono" value="<?= $reg['telefono'] ?>">
            </div>
            <div class="form-group" id="campo11">
              <label for="exampleInputEmail1">
                <h4>Correo electrónico del cliente:</h4>
              </label>
              <br>
              <input type="email" autocomplete="off" name="correo_cliente" value="<?= $reg['correo_cliente'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <h4>Perfil:</h4>
              </label>
              <br>
              <input type="text" autocomplete="off" name="perfil" value="<?= $reg['perfil'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <h4>PIN:</h4>
              </label>
              <br>
              <input type="number" autocomplete="off" name="pin" value="<?= $reg['pin'] ?>">
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                <h4>Precio de venta:</h4>
              </label>
              <br>
              <input required type="number" autocomplete="off" name="precio_venta" value="<?= $reg['precio_venta'] ?>">
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
    $nombre_cliente = $_POST['nombre_cliente'];
    $telefono = $_POST['telefono'];
    $correo_cliente = $_POST['correo_cliente'];
    $precio = $_POST['precio_venta'];
    $perfil = $_POST['perfil'];
    $pin = $_POST['pin'];
    $idu = $_REQUEST['idu'];
    $renovada = "UPDATE `tbl_clientes` SET `nombre_cliente`='$nombre_cliente',`correo_cliente`='$correo_cliente',
    `perfil`='$perfil',`pin`='$pin',
    `telefono`='$telefono',`precio_venta`='$precio' WHERE id=$idu";
    if (!mysqli_query($con, $renovada)) {
      echo "<script type='text/javascript'>";
      echo "alerta('¡ERROR! NO SE PUEDE RENOVAR LA CUENTA','error','clientes?idu=&user=');";
      echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alerta('Modificación éxitosa','success','clientes?idu=&user=');";
        echo "</script>";
    }
    include '../controller/cerrar_conx.php';
  }
  ?>
</body>

</html>