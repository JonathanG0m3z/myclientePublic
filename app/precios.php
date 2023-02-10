<!DOCTYPE html>

<head>
  <link href='images/logo.png' rel='shortcut icon' type='image/png'>
  <title>MyCliente</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="../app/lib/js/funcionalert.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <?php
  include("menus/menuinformes.php");
  ?>
  <center>
    <form role="form" method="POST" class="form-inline">
      <div class="modal-body">
        <select required class="js-example-basic-single form-control" name="servicio">
          <option value="0" selected hidden>Servicio</option>
          <?php
          include '../controller/conexion.php';
          $consulta_mysql = "SELECT * FROM tbl_servicio order by nombre_servicio asc";
          $resultado_consulta_mysql = mysqli_query($con, $consulta_mysql);
          while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
            echo "<option value='" . $fila['id_servicio'] . "'>" . $fila['nombre_servicio'] . "</option>";
          }
          include '../controller/cerrar_conx.php';
          ?>
        </select>
        <input type="submit" class="btn btn-primary" value="Revisar precio" name="btnreg">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </center>

  <?php
  if (isset($_POST['btnreg']) and $_POST['servicio'] <> 0) {
  ?>
    <div class="table-responsive" style="width: 50%; margin: auto;">
      <table class="table table-bordered table-hover" style="font-size: 17px">
        <thead>
          <tr class="colortabla" bgcolor="#383838" style="color:#fff">
            <th scope="col">
              <center>Nombre servicio</center>
            </th>
            <th scope="col">
              <center>Precio de proveedor</center>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $id_usuario = $_SESSION['cedula'];
          $id_servicio = $_POST['servicio'];
          include('../controller/conexion.php');
          $consulta_mysql = "SELECT * FROM tbl_precios pre
          INNER JOIN tbl_servicio ser ON pre.id_servicio=ser.id_servicio
          where pre.id_usuario=$id_usuario and pre.id_servicio=$id_servicio";

          $resultado_consulta_mysql = mysqli_query($con, $consulta_mysql);
          $nr = mysqli_num_rows($resultado_consulta_mysql);
          if ($nr >= 1) {
            while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
          ?>
              <tr>
                <td scope="row">
                  <center><?= $fila['nombre_servicio']  ?></center>
                </td>
                <td scope="row">
                  <center><?= $fila['precio_proveedor'] ?></center>
                </td>
              <?php
            }
          } else { ?>
              <tr>
                <td scope="row">
                  <center>1</center>
                </td>
                <td scope="row">
                  <center>Precio de servicio no registrado</center>
                </td>
              <?php
            }
              ?>
        </tbody>
      </table>
    </div>
    <center>
      <form role="form" method="POST" class="form-inline">
        <div class="modal-body">
          <input hidden class="form" value="<?= $id_servicio ?>" name="servicio2" type="number" autofocus>
          <input required class="form" placeholder="Precio de proveedor" name="precio_proo" type="number" autofocus>
          <input type="submit" class="btn btn-primary" value="Registrar precio" name="btnsubir">
          <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        </div>
      </form>
    </center>
  <?php
    include("../controller/cerrar_conx.php");
  }
  if (isset($_POST['btnsubir'])) {
    $id_usuario = $_SESSION['cedula'];
    $id_servicio = $_POST['servicio2'];
    $precio_pro = $_POST['precio_proo'];
    include('../controller/conexion.php');
    $consulta_mysql = "SELECT * FROM tbl_precios pre
          INNER JOIN tbl_servicio ser ON pre.id_servicio=ser.id_servicio
          where pre.id_usuario=$id_usuario and pre.id_servicio=$id_servicio";

    $resultado_consulta_mysql = mysqli_query($con, $consulta_mysql);
    $nr = mysqli_num_rows($resultado_consulta_mysql);
    if ($nr >= 1) {
      $subir_precio = "UPDATE `tbl_precios` SET `precio_proveedor`='$precio_pro' 
      WHERE id_usuario='$id_usuario' and id_servicio='$id_servicio'";
    } else {
      $subir_precio = "INSERT INTO `tbl_precios`(`id`, `id_servicio`, `precio_proveedor`, `id_usuario`) 
  VALUES (default,'$id_servicio','$precio_pro','$id_usuario')";
    }
    if (!mysqli_query($con, $subir_precio)) {
      echo "<script type='text/javascript'>";
      echo "alerta('¡ERROR DE CONEXIÓN!','error','precios');";
      echo "</script>";
    } else {
      echo "<script type='text/javascript'>";
      echo "alerta('Datos ingresados correctamente','success','precios');";
      echo "</script>";
    }
    include("../controller/cerrar_conx.php");
  }
  ?>
</body>

</html>