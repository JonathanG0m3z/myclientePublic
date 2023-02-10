<!DOCTYPE html>
<html lang="es">

<head>
  <link href='images/logo.png' rel='shortcut icon' type='image/png'>
  <title>MyCliente</title>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
  <?php
  include("menus/menuadmin.php");
  ?>
  <br>
  <div class="table-responsive" style="width: 98%; margin: auto;">
    <table class="table table-bordered table-hover" style="font-size: 12px">
      <thead>
        <tr class="colortabla" bgcolor="#383838" style="color:#fff; ">
          <td colspan="6">
            <center>
              <h4>Informe inscripciones</h4>
            </center>
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
            <center>Usuario</center>
          </th>
          <th scope='col'>
            <center>Correo electrónico</center>
          </th>
          <th scope="col">
            <center>Teléfono</center>
          </th>
          <th scope="col">
            <center>Verificar</center>
          </th>
        </tr>
      </thead>
      <tbody>
        <?php
        $id_usuario = $_SESSION['cedula'];
        $i = 0;
        include('../controller/conexion.php');
        $consulta_mysql = "SELECT * FROM tbl_inscripciones
          where estado='Por crear'";
        $resultado_consulta_mysql = mysqli_query($con, $consulta_mysql);
        while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
          $i = $i + 1;
        ?>
          <tr>
            <!--carga datos de la base de datos-->
            <td scope="row">
              <center><?= $i ?></center>
            </td>
            <td scope="row">
              <center><?= $fila['nombre'] ?></center>
            </td>
            <td scope="row">
              <center><?= $fila['usuario'] ?></center>
            </td>
            <td scope="row">
              <center> <?= $fila['correo'] ?></center>
            </td>
            <td scope="row">
              <center><?= $fila['numero'] ?></center>
            </td>
            <td scope="row">
              <center><a href="#" class="btn btn-success"><img src="../app/images/renovar.png" height="25" width="25"/></a></center>
            </td>
          </tr>
        <?php
        }
        ?>


      </tbody>
    </table>
  </div>
</body>

</html>