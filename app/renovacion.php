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
    $sqlc = "SELECT * FROM tbl_clientes WHERE id = $id and id_usuario=$id_usuario";
    $rs = mysqli_query($con, $sqlc);
    while ($reg = mysqli_fetch_array($rs)) {
  ?>

      <div style="background-color:rgba(0,0,0,0.9); width: 70%; margin: auto; border: 10px; border-radius:10px;">
        <center>
          <br><br>
          <h2>Renovación</h2>
        </center>
        <form action="" method="post">
          <div class="form-group">

            <div class="form-group" id="campo9">
              <label for="exampleInputEmail1">
                <h4>Nombre del cliente:</h4>
              </label>
              <br>
              <input disabled type="text" autocomplete="off" name="nombre_cliente" value="<?= $reg['nombre_cliente'] ?>">
            </div>
            <div style="display: none;" class="form-group" id="campo9">
              <label for="exampleInputEmail1">
                <h4>Teléfono:</h4>
              </label>
              <br>
              <input type="number" autocomplete="off" name="telefono" value="<?= $reg['telefono'] ?>">
            </div>
            <div style="display: none;" class="form-group" id="campo11">
              <label for="exampleInputEmail1">
                <h4>Correo electrónico del cliente:</h4>
              </label>
              <br>
              <input type="email" autocomplete="off" name="correo_cliente" value="<?= $reg['correo_cliente'] ?>">
            </div>
            <div class="form-group" id="campo12">
              <label for="exampleInputEmail1">
                <h4>Días pagos:</h4>
              </label>
              <br>
              <input required type="number" autocomplete="off" name="dias">
            </div>
            <div style="display: none;" class="form-group" id="campo13">
              <label for="exampleInputEmail1">
                <h4>Cuenta:</h4>
              </label>
              <br>
              <input required type="email" autocomplete="off" name="cuenta" value="<?= $reg['cuenta'] ?>">
            </div>
            <div style="display: none;" class="form-group" id="campo14">
              <label for="exampleInputEmail1">
                <h4>Contraseña cuenta:</h4>
              </label>
              <br>
              <input required type="text" autocomplete="off" name="clave_cuenta" value="<?= $reg['clave_cuenta'] ?>">
            </div>
            <div class="form-group" id="campo16">
              <label for="exampleInputEmail1">
                <h4>Perfil:</h4>
              </label>
              <br>
              <input type="text" autocomplete="off" name="perfil" value="<?= $reg['perfil'] ?>">
            </div>
            <div class="form-group" id="campo17">
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
              <input required type="number" autocomplete="off" name="precio_venta">
            </div>
            <div hidden class="form-group" id="campo17">
              <label for="exampleInputEmail1">
                <h4>Fecha de vencimiento suscripción:</h4>
              </label>
              <br>
              <input type="text" autocomplete="off" name="fech_venc" value="<?= $reg['fech_venc'] ?>">
            </div>
            <div hidden class="form-group" id="campo17">
              <label for="exampleInputEmail1">
                <h4>id servicio:</h4>
              </label>
              <br>
              <input type="number" autocomplete="off" name="id_servicio" value="<?= $reg['id_servicio'] ?>">
            </div>
            <center>
              <button style="background-color:#4458ff ; color:white;" class="btn " name="btnrenov" type="submit">Actualizar</button>
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
  if (isset($_POST['btnrenov'])) {
    include '../controller/conexion.php';
    $id = $_POST['id_servicio'];
    $id_usuario = $_SESSION['cedula'];
    $nombre_cliente = $_REQUEST['name'];
    $telefono = $_POST['telefono'];
    $correo_cliente = $_POST['correo_cliente'];
    $dias = $_POST['dias'];
    $cuenta = $_POST['cuenta'];
    $precio = $_POST['precio_venta'];
    $clave = $_POST['clave_cuenta'];
    $fecha_actual = date("Y-m-d");
    $perfil = $_POST['perfil'];
    $pin = $_POST['pin'];
    $vencimiento = $_POST['fech_venc'];
    $mod_date = strtotime($vencimiento . "+ " . $dias . " days");
    $fech_venc = date("Y-m-d", $mod_date) . "\n";
    $idu = $_REQUEST['idu'];
    $renovada = "UPDATE `tbl_clientes` SET `estado_venta`='Renovada' WHERE id=$idu";
    if (!mysqli_query($con, $renovada)) {
      echo "<script type='text/javascript'>";
      echo "alerta('¡ERROR! NO SE PUEDE RENOVAR LA CUENTA','error','clientes?idu=&user=');";
      echo "</script>";
    } else {
      $sqli = "INSERT INTO `tbl_clientes`(`nombre_cliente`, `correo_cliente`, `fech_venc`, `cuenta`, `clave_cuenta`, `perfil`, `pin`, `id_servicio`, `telefono`, `id_usuario`, `precio_venta`, `fech_venta`, `estado_venta`) 
    VALUES ('$nombre_cliente','$correo_cliente','$fech_venc','$cuenta','$clave','$perfil','$pin','$id','$telefono','$id_usuario','$precio','$fecha_actual','')";
      if (!mysqli_query($con, $sqli)) {
        echo "<script type='text/javascript'>";
        echo "alerta('¡ERROR! NO SE PUEDE RENOVAR LA CUENTA','error','clientes?idu=&user=');";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alerta('Renovación éxitosa','success','clientes?idu=&user=');";
        echo "</script>";
      }
    }
    include '../controller/cerrar_conx.php';
  }
  ?>
</body>

</html>