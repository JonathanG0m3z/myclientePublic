<!DOCTYPE html>
<html lang="es">

<head>
  <link href='images/logo.png' rel='shortcut icon' type='image/png'>
  <title>MyCliente</title>
  <link rel="stylesheet" href="../views/soport.css">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="../app/lib/js/funcionalert.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <?php
  include("menus/menusoporte.php");
  ?>
  <div style="color:white; background-color:rgba(0,0,0,0.5); 
  width: 70%; 
  margin: auto; 
  border: 10px; 
  border-radius:10px;">
  <br>
  <h1 style="text-align: center;">Soporte técnico o  sugerencias</h1>
      <form role="form" method="POST" class="form-inline">
      <div class="modal-body">
        <center>
        <h3>Tipo de ticket</h3>
        <select style="width: 40%;" required class="js-example-basic-single form-control" name="tipo">
          <option hidden></option>
          <option value="Soporte técnico">Soporte técnico</option>
          <option value="Sugerencia">Sugerencia</option>
        </select>
        <br>
        <br>
        <textarea required style="width:55%; resize:none;" name="info" class="form-control" rows="7"></textarea>
        <br>
        <br>
        <input style="background-color: #e78f14;" type="submit" class="btn btn-warning" value="Envíar" name="btni">
        </center>
      </div>
    </form>
  </div>
  <?php
  if (isset($_POST['btni'])) {
    $id_usuario=$_SESSION['cedula'];
    $tipo=$_POST['tipo'];
    $contenido=$_POST['info'];
    $sql="INSERT INTO `tbl_soporte`(`ticket`, `tipo_ticket`, `contenido_ticket`, `usuario_ticket`) 
    VALUES (default,'$tipo','$contenido','$id_usuario')";
    include('../controller/conexion.php');
    if (!mysqli_query($con,$sql)) {
      echo "<script>
      alerta('Erros al enviar el reporte!','error','#');
      </script>";
    }else {
      echo "<script>
      alerta('Reporte enviado correctamente','success','clientes?idu=&user=');
      </script>";
    }
  }
  ?>
</body>

</html>