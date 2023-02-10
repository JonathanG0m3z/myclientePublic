<!DOCTYPE html>
<html lang="es">

<head>
  <link href='images/logo.png' rel='shortcut icon' type='image/png'>
  <title>MyCliente</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
  <?php
  include("menus/menuinformes.php");
  ?>
  <center>
    <form role="form" method="POST" class="form-inline">
      <div class="modal-body">
      <label>Servicio:</label>
        <select required class="js-example-basic-single form-control" name="servicio">
          <option hidden></option>
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
        <label>Fecha inicial:</label>
        <input required name="fecha1" type="date">
        <label>Fecha final:</label>
        <input required name="fecha2" type="date">
        <input type="submit" class="btn btn-primary" value="Ver informe" name="btninf">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </form>
  </center>
  <?php
  if (isset($_POST['btninf'])) {
  ?>
    <div class="table-responsive" style="margin: auto;">
      <table class="table table-bordered table-hover" style="font-size: 17px">
        <thead>
          <tr class="colortabla" bgcolor="#383838" style="color:#fff">
            <th scope="col">
              <center>Número de ventas</center>
            </th>
            <th scope="col">
              <center>Dinero invertido</center>
            </th>
            <th scope="col">
              <center>Ganacias netas</center>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $id_usuario = $_SESSION['cedula'];
          $fech1 = $_POST['fecha1'];
          $date1 = str_replace('/', '-', $fech1);
          $fecha1 = date('Y-m-d', strtotime($date1));
          $fech2 = $_POST['fecha2'];
          $date2 = str_replace('/', '-', $fech2);
          $fecha2 = date('Y-m-d', strtotime($date2));
          $servicio=$_POST['servicio'];
          include('../controller/conexion.php');
          $consulta_mysql = "SELECT * FROM tbl_clientes cli
          INNER JOIN tbl_precios pre ON pre.id_usuario=cli.id_usuario and pre.id_servicio=cli.id_servicio
          where cli.id_usuario='$id_usuario' and cli.fech_venta>='$fecha1' and cli.fech_venta<='$fecha2' 
          and cli.id_servicio='$servicio'";

          $ventas = 0;
          $inversion = 0;
          $dinero_ventas = 0;
          $resultado_consulta_mysql = mysqli_query($con, $consulta_mysql);
          $nr = mysqli_num_rows($resultado_consulta_mysql);
          if ($nr >= 1) {
            while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
              $ventas = $ventas + 1;
              $inversion = $inversion + $fila['precio_proveedor'];
              $dinero_ventas = $dinero_ventas + $fila['precio_venta'];
            }
            $ganancias = $dinero_ventas - $inversion;
          ?>
            <tr>
              <td scope="row">
                <center><?= $ventas  ?></center>
              </td>
              <td scope="row">
                <center><?= $inversion  ?></center>
              </td>
              <td scope="row">
                <center><?= $ganancias ?></center>
              </td>
            <?php
          }
            ?>
        </tbody>
      </table>
    </div>
  <?php
  }
  ?>
</body>

</html>