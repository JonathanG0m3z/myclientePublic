<!DOCTYPE html>
<html lang="es">

<head>
  <link href='images/logo.png' rel='shortcut icon' type='image/png'>
  <link type='text/css' rel='stylesheet' href="../views/copy.css" />

  <title>MyCliente</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script type="" src="js/prefixfree.min.js"></script>
  <script src="../app/lib/js/copy.js"></script>
  <script src="../app/lib/js/ajax.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="../app/lib/js/funcionalert.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
</head>

<body>
  <?php
  include("menus/menuclientes.php");
  ?>
<!-- Button trigger modal -->
  <center><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Registrar nueva venta
    </button>
<button style="background-color: #0279ff;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
      Cuentas
    </button></center>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Registro de venta</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form role="form" method="POST">
          <div class="modal-body">
            <h4>Datos del cliente:</h4>
            <div class="form-group">
              <input required id="nombrec" placeholder="Nombre del cliente" list="browsers" autocomplete="off" class="form-control" name="nombre_cliente" size="10">
              <option></option>
              <?php
              include("../controller/conexion.php");
              $id_usuario = $_SESSION['cedula'];
              $sqlc = "SELECT DISTINCT nombre_cliente FROM tbl_clientes WHERE id_usuario='$id_usuario' order by nombre_cliente asc";
              $sr = mysqli_query($con, $sqlc);
              while ($reg = mysqli_fetch_array($sr)) {
                echo "<datalist id='browsers'>";
              ?>
                <option value="<?= $reg['nombre_cliente'] ?>">Cliente antigüo</option>
              <?php
              }
              include("../controller/cerrar_conx.php");
              ?>
            </div>
            <div style="display: none;" id="divcliente"></div>
            <h4>Datos de la cuenta:</h4>
            <input id="cuenta" class="form-control" placeholder="Cuenta" name="cuenta" type="text" autofocus autocomplete="off">
            <div style="display: none;" id="divcuenta"></div>
          </div>
        </form>
      </div>
    </div>
</div><br>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">Cuentas activas</h2>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="table-responsive" style="width: 98%; margin: auto;">
    <table class="table table-bordered table-hover" style="font-size: 12px">
      <thead>
        <tr class="colortabla" bgcolor="#383838" style="color:#fff; ">
          <td colspan="6">
            <center>
              <h4>Informe de cuentas activas</h4>
            </center>
          </td>
        </tr>
        <tr class="colortabla" bgcolor="#383838" style="color:#fff">
          <th scope="col">
            <center>Servicio</center>
          </th>
          <th scope="col">
            <center>Perfiles disponibles</center>
          </th>
          <th scope="col">
            <center>Cuenta</center>
          </th>
          <th scope="col">
            <center>Contraseña</center>
          </th>
          <th scope="col">
            <center>Días para renovación</center>
          </th>
          <th scope="col">
            <center>Acciones</center>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        function verificarEnvio($correo){
          $hoy = date("Y-m-d");
          $archivo=fopen("lib/phpmailer/logfile.txt", "r") or die("problemas al abrir archivo.txt") ;
          while (!feof($archivo))
          {     
            $traer = fgets($archivo);
          }
            $cadena_buscada   =$correo." ".$hoy;
            $posicion_coincidencia = strpos($traer, $cadena_buscada);
            if ($posicion_coincidencia == false) {
              return(false);
            }else {
              return(true);
            }
        }
        $id_usuario = $_SESSION['cedula'];
        $hoy = date("Y-m-d");
        $mod_date = strtotime($hoy . "- 3 days");
        $hoy2 = date("Y-m-d", $mod_date) . "\n";
        include('../controller/conexion.php');
        $consulta_mysql = "SELECT * FROM tbl_cuentas cu
          INNER JOIN tbl_servicio ser ON cu.id_servicio=ser.id_servicio
          where cu.id_usuario=$id_usuario and cu.fecha_vencimiento>='$hoy2'
          order by fecha_vencimiento ASC";
        $resultado_consulta_mysql = mysqli_query($con, $consulta_mysql);
        while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
          $date1 = new DateTime($hoy);
          $vencimiento_cuenta = new DateTime($fila['fecha_vencimiento']);
          $diff = $date1->diff($vencimiento_cuenta);
          // will output 2 days
          if ($date1 > $vencimiento_cuenta) {
            $dias_restantes = "-".$diff->days;
          }else {
            $dias_restantes = $diff->days;
          }
          
        ?>
          <tr>
            <td scope="row">
              <center> <?= $fila['nombre_servicio'] ?></center>
            </td>
            <?php
            $hoy = date("Y-m-d");
            $correo= $fila['correo_cuenta'];
            $id_usuario=$_SESSION['cedula'];
            $consulta="SELECT * FROM tbl_clientes where cuenta='$correo' and estado_venta<>'Renovada' 
            and id_usuario='$id_usuario' and fech_venc>='$hoy'";
            $resultado_consulta = mysqli_query($con, $consulta);
            $nr = mysqli_num_rows($resultado_consulta);
            $perf_disponibles=$fila['perfiles']-$nr;
            ?>
            <td scope="row">
              <center><?= $perf_disponibles ?></center>
            </td>
            <td scope="row">
              <center><?= $fila['correo_cuenta'] ?></center>
            </td>
            <td scope="row">
              <center> <?= $fila['contraseña_cuenta'] ?></center>
            </td>
            <td scope="row">
              <center> <?= $dias_restantes ?></center>
            </td>
            <td scope="row">
              <center>
                <a title="Modificar cuenta" href="modcuenta?idu=<?= $fila['id_cuenta'] ?>&user=<?= $id_usuario ?>&email=<?= $fila['correo_cuenta'] ?>" class="btn btn-warning"><img src="../app/images/modcuenta.png" height="25" width="25" /></a>
              </center>
            </td>
          </tr>
        <?php
        }
        ?>


      </tbody>
    </table>
  </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">OK</button>
          </div>
      </div>
    </div>
  </div>

  <br>
  <div class="table-responsive" style="width: 98%; margin: auto;">
    <table class="table table-bordered table-hover" style="font-size: 12px">
      <thead>
        <tr class="colortabla" bgcolor="#383838" style="color:#fff; ">
          <td colspan="11">
            <center>
              <h4>Informe de clientes activos</h4>
            </center>
          </td>
          <td colspan='1'>
            <center><a href="#" style="background-color: #c90016;" class='btn btn-danger disabled'>Exportar excel</a></center>
          </td>
        </tr>
        <tr class="colortabla" bgcolor="#383838" style="color:#fff">
          <th scope="col">
            <center>#</center>
          </th>
          <th scope="col">
            <center>Nombre</center>
          </th>
          <th scope="col">
            <center>Fecha de finalización</center>
          </th>
          <th scope='col'>
            <center>Días restantes</center>
          </th>
          <th scope="col">
            <center>Servicio</center>
          </th>
          <th scope="col">
            <center>Cuenta</center>
          </th>
          <th scope="col">
            <center>Contraseña</center>
          </th>
          <th scope="col">
            <center>Perfil</center>
          </th>
          <th scope="col">
            <center>PIN</center>
          </th>
          <th scope='col'>
            <center>Correo del cliente</center>
          </th>
          <th scope="col">
            <center>Teléfono</center>
          </th>
          <th scope="col">
            <center>Acciones</center>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $id_usuario = $_SESSION['cedula'];
        $i = 0;
        $hoy = date("Y-m-d");
        $mod_date = strtotime($hoy . "- 3 days");
        $hoy2 = date("Y-m-d", $mod_date) . "\n";
        include('../controller/conexion.php');
        $consulta_mysql = "SELECT * FROM tbl_clientes cli
          INNER JOIN tbl_servicio ser ON cli.id_servicio=ser.id_servicio
          where cli.id_usuario=$id_usuario and cli.fech_venc>='$hoy2' and estado_venta<>'Renovada'
          order by fech_venc ASC";
        $resultado_consulta_mysql = mysqli_query($con, $consulta_mysql);
        while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
          $i = $i + 1;
          $date1 = new DateTime($hoy);
          $date2 = new DateTime($fila['fech_venc']);
          $diff = $date1->diff($date2);
          // will output 2 days
          if ($date1 > $date2) {
            $dias_restantes = "-".$diff->days;
          }else {
            $dias_restantes = $diff->days;
          }
        ?>
          <tr>
            <!--carga datos de la base de datos-->
            <td scope="row">
              <center><?= $i ?></center>
            </td>
            <td scope="row">
              <center><?= $fila['nombre_cliente'] ?></center>
            </td>
            <td scope="row">
              <center><?= $fila['fech_venc'] ?></center>
            </td>
            <td scope="row">
              <center><?= $dias_restantes ?></center>
            </td>
            <td scope="row">
              <center> <?= $fila['nombre_servicio'] ?></center>
            </td>
            <td scope="row">
              <center><?= $fila['cuenta'] ?></center>
            </td>
            <td scope="row">
              <center> <?= $fila['clave_cuenta'] ?></center>
            </td>
            <td scope="row">
              <center><?= $fila['perfil'] ?></center>
            </td>
            <td scope="row">
              <center> <?= $fila['pin'] ?></center>
            </td>
            <td scope="row">
              <center> <?= $fila['correo_cliente'] ?></center>
            </td>
            <td scope="row">
              <center> <?= $fila['telefono'] ?></center>
            </td>
            <td scope="row">
              <center>
                <?php
                if ($fila['id_servicio'] == 1) {
                ?>
                  <div hidden id="url<?= $i ?>">Cuenta netflix: <?= $fila['cuenta'] ?> .
Contraseña: <?= $fila['clave_cuenta'] ?> .
Perfil: <?= $fila['perfil'] ?> .
PIN: <?= $fila['pin'] ?> .
Próxima fecha de renovación: <?= $fila['fech_venc'] ?></div>
<a title="Copiar" onclick="Copiar(url<?= $i ?>)"  class="btn btn-info"><img src="../app/images/copy.png" height="25" width="25" /></a>
                  <span class="mensaje"></span>
                <?php
                }elseif ($fila['id_servicio'] >= 22 and $fila['id_servicio'] <= 25) {
                  ?>
                  <div hidden id="url<?= $i ?>">Ya se efectuó el proceso! .
Revisa el correo electrónico <?= $fila['correo_cliente'] ?> y acepta la invitación a nuestro grupo familiar .
Cinco días antes de la renovación te llegará un recordatorio por correo electrónico y whatsapp, allí encontrarás métodos de pago, planes y contacto .
Próxima fecha de renovación: <?= $fila['fech_venc'] ?></div>
                <a title="Copiar" onclick="Copiar(url<?= $i ?>)"  class="btn btn-info"><img src="../app/images/copy.png" height="25" width="25" /></a>
                  <span class="mensaje"></span>
                <?php
                }elseif ($fila['id_servicio'] == 17) {
                  ?>
                    <div hidden id="url<?= $i ?>">Cuenta HBO Max: <?= $fila['cuenta'] ?> .
  Contraseña: <?= $fila['clave_cuenta'] ?> .
  Perfil: <?= $fila['perfil'] ?> .
  Próxima fecha de renovación: <?= $fila['fech_venc'] ?></div>
  <a title="Copiar" onclick="Copiar(url<?= $i ?>)"  class="btn btn-info"><img src="../app/images/copy.png" height="25" width="25" /></a>
                    <span class="mensaje"></span>
                  <?php
                  }
                ?>

                <a title="Renovar" href="renovacion?idu=<?= $fila['id'] ?>&user=<?= $id_usuario ?>&name=<?= $fila['nombre_cliente'] ?>" class="btn btn-success"><img src="../app/images/renovar.png" height="25" width="25" /></a>
                <?php 
                if($fila['id_servicio'] ==22){
                  if($dias_restantes <= 3 and $dias_restantes >=0 and $dias_restantes <>2 and $fila['telefono']<>0){ ?>

                <a title="Notificación a WhatsApp" href="https://api.whatsapp.com/send?phone=<?= $fila['telefono'] 
                ?>&text=*Notificación de pronta finalización de suscripción*%0AAtención tu suscripción a Youtube Premium , Correo electónico: <?=$fila['correo_cliente']?> finaliza en <?= $dias_restantes?> días. Los precios de renovación son los siguientes:
 1 mes por $8.900,
 2 meses por $15.900,
 3 meses por $20.900,
 Nequi: 3213411415
 Elige el que más te convenga y no te quedes sin tu activación." target="_blank" class="btn btn-success"><img src="../app/images/whatsapp.png" height="25" width="25" /></a><?php }elseif ($dias_restantes < 0 and $fila['telefono']<>0) {
                   ?>
                   <a title="Notificación a WhatsApp" href="https://api.whatsapp.com/send?phone=<?= $fila['telefono'] ?>&text=*Suscripción vencida*%0AAtención tu suscripción a Youtube Premium , Correo electónico: <?=$fila['correo_cliente']?> Acaba de vencerse así que serás expulsado de nuestro grupo. Los precios de renovación son los siguientes:
 1 mes por $8.900,
 2 meses por $15.900,
 3 meses por $20.900,
 Nequi: 3213411415
 Elige el que más te convenga y no te quedes sin tu activación." target="_blank" class="btn btn-success"><img src="../app/images/whatsapp.png" height="25" width="25" /></a><?php } 

                }elseif($dias_restantes <= 5 and $fila['telefono']<>0 and $dias_restantes >=0){ ?>

                <a title="Notificación a WhatsApp" href="https://api.whatsapp.com/send?phone=<?= $fila['telefono'] 
                ?>&text=*Notificación%20de%20pronta%20finalización%20de%20suscripción*%0AAtención%20tu%20suscripción%20a%20<?= $fila['nombre_servicio'] ?><?php if($fila['perfil']<>""){ ?> ,%20perfil:%20<?=$fila['perfil']?> <?php } ?>%20finaliza%20en%20<?= $dias_restantes ?> días.%20Por%20favor%20hacer%20el%20pago%20correspondiente%20para%20poder%20seguir%20disfrutando%20de%20nuestros%20servicios." target="_blank" class="btn btn-success"><img src="../app/images/whatsapp.png" height="25" width="25" /></a><?php }elseif ($dias_restantes < 0 and $fila['telefono']<>0) {
                   ?>
                   <a title="Notificación a WhatsApp" href="https://api.whatsapp.com/send?phone=<?= $fila['telefono'] ?>&text=*Suscripción vencida*%0AAtención%20suscripción%20vencida%20a%20<?= $fila['nombre_servicio'] ?><?php if($fila['perfil']<>""){ ?> ,%20perfil:%20<?=$fila['perfil']?> <?php } ?>.%20Por%20favor%20hacer%20el%20pago%20correspondiente%20para%20poder%20seguir%20disfrutando%20de%20nuestros%20servicios." target="_blank" class="btn btn-success"><img src="../app/images/whatsapp.png" height="25" width="25" /></a><?php } ?><br>
                <a title="Modificar" href="modcliente?idu=<?= $fila['id'] ?>&user=<?= $id_usuario ?>&name=<?= $fila['nombre_cliente'] ?>" class="btn btn-warning"><img src="../app/images/modificar.png" height="25" width="25" /></a>
                <a title="Cancelar venta" href="clientes?idu=<?= $fila['id'] ?>&user=<?= $id_usuario ?>" class="btn btn-danger"><img src="../app/images/cancelar.png" height="25" width="25" /></a>
                <br>
                <?php
                if ($fila['id_servicio'] == 22 and $fila['correo_cliente'] <> "") {
                  if($dias_restantes == 5){
                    $verificar=verificarEnvio($fila['correo_cliente']);
                    if ($verificar==false) {
                      $destinatario=$fila['correo_cliente'];
                      $tipo=5;
                      include('enviocorreo.php');
                    }else {
                      echo"Correo enviado";
                    }
                  }elseif($dias_restantes == 0){
                    $verificar=verificarEnvio($fila['correo_cliente']);
                    if ($verificar==false) {
                      $destinatario=$fila['correo_cliente'];
                      $tipo=0;
                      include('enviocorreo.php');
                    }else {
                      echo"Correo enviado";
                    }
                  }
                }
                ?>
              </center>
            </td>
          </tr>
        <?php
        }
        ?>


      </tbody>
    </table>
  </div>

  <?php
  $id = $_REQUEST['idu'];
  $id_user = $_REQUEST['user'];
  if ($id != "" and $id_user != "") {
    echo "
    <script>
      Swal.fire({
        title: '¿Deseas cancelar esta venta?',
        icon: 'question',
        confirmButtonText: 'Si',
        padding: '1rem',
        backdrop: true,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        stopKeydownPropagation: true,
        confirmButtonColor: '#dc3741',
        showDenyButton: true,
        denyButtonText: 'No',
        denyButtonColor: '#7066e0',
      }).then((result) => {
        if (result.isConfirmed) {
          setTimeout(() => { window.location.replace('cancelar_servicio?idu=$id&user=$id_user');
           }, 2000);
          Swal.fire({
            title: 'Venta eliminada',
            icon: 'success',
            timer: '2000',
            timerProgressBar: 'true',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            stopKeydownPropagation: true,
            showConfirmButton: false,
          });
        } else if (result.isDenied) {
          setTimeout(() => { window.location.replace('clientes?idu=&user=');
          }, 2000);
          Swal.fire({
            title: 'No se hicieron cambios',
            icon: 'info',
            timer: '2000',
            timerProgressBar: 'true',
            allowOutsideClick: false,
            allowEscapeKey: false,
            allowEnterKey: false,
            stopKeydownPropagation: true,
            showConfirmButton: false,
          });
        }
      });
    </script>";
    include('../controller/cerrar_conx.php');
  }
  if (isset($_POST['btnreg'])) {
    $cuenta = $_POST['cuenta'];
    $clave = $_POST['clave_cuenta'];
    $servicio = $_POST['servicio'];
    $id_usuario = $_SESSION['cedula'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $indicativo = $_POST['pais'];
    $telefono =$indicativo.$_POST['telefono'];
    $correo_cliente = $_POST['correo_cliente'];
    $dias = $_POST['dias'];
    $perfil = $_POST['perfil'];
    $pin = $_POST['pin'];
    $precio = $_POST['precio'];
    $fecha_actual = date("Y-m-d");
    $mod_date = strtotime($fecha_actual . "+ " . $dias . " days");
    $fech_venc = date("Y-m-d", $mod_date) . "\n";
    include("../controller/conexion.php");
    if ($_POST['estadocuenta']=="No existente") {
      $cantidad_perfiles = $_POST['perfiles'];
      $diascuenta = $_POST['diascuenta'];
      $mod_date2 = strtotime($fecha_actual . "+ " . $diascuenta . " days");
    $fecha_venc_cuenta = date("Y-m-d", $mod_date2) . "\n";
      $sql_cuentas="INSERT INTO `tbl_cuentas`(`id_cuenta`, `correo_cuenta`, 
      `contraseña_cuenta`, `fecha_vencimiento`, `perfiles`, `id_servicio`, `id_usuario`) 
      VALUES (default,'$cuenta','$clave','$fecha_venc_cuenta','$cantidad_perfiles','$servicio','$id_usuario')";
      mysqli_query($con,$sql_cuentas);
    }

    $insert_venta = "INSERT INTO `tbl_clientes`(`nombre_cliente`, `correo_cliente`, `fech_venc`, `cuenta`, `clave_cuenta`, `perfil`, `pin`, `id_servicio`, `telefono`, `id_usuario`, `precio_venta`, `fech_venta`, `estado_venta`) 
    VALUES ('$nombre_cliente','$correo_cliente','$fech_venc','$cuenta','$clave','$perfil','$pin','$servicio','$telefono','$id_usuario','$precio','$fecha_actual','')";
    if (!mysqli_query($con, $insert_venta)) {
      echo "<script type='text/javascript'>";
      echo "alerta('¡ERROR DE CONEXIÓN!','error','clientes?idu=&user=');";
      echo "</script>";
    } else {
      echo "<script type='text/javascript'>";
      echo "alerta('Datos ingresados correctamente','success','clientes?idu=&user=');";
      echo "</script>";
    }
  }
  ?>

</body>

</html