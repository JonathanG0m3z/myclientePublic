<?php
date_default_timezone_set('America/Bogota');
?>
<!DOCTYPE html>

<head>
  <link href='app/images/logo.png' rel='shortcut icon' type='image/png'>
  <title>MyCliente</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="views/renov.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <script src="app/lib/js/funcionalert.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
  <div style="background-color:rgba(0,0,0,0.9); width: 70%; margin: auto; border: 10px; border-radius:10px;">
    <center>
      <br><br>
      <h2>Inscripción usuarios MyPantalla</h2>
    </center>
    <form action="" method="post">
      <div class="form-group">

        <div class="form-group">
          <label for="exampleInputEmail1">
            <h4>Nombre completo:</h4>
          </label>
          <br>
          <input required type="text" autocomplete="off" name="nombre_completo">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <h4>Teléfono:</h4>
          </label>
          <br>
          <input placeholder="+573213456978" required type="number" autocomplete="off" name="telefono">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <h4>Correo electrónico:</h4>
          </label>
          <br>
          <input required type="email" autocomplete="off" name="correo">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <h4>Nombre de usuario para la plataforma:</h4>
          </label>
          <br>
          <input placeholder="Ejem: carlosdavid123" required type="text" autocomplete="off" name="user">
        </div>
        <center>
          <button style="background-color:#4458ff ; color:white;" class="btn " name="btni" type="submit">Crear</button>
          <a style="background-color:#e61062 ; color:white;" href="index" class="btn ">Cancelar</a>
        </center>
    </form>
  </div>
  <?php
  ?>
  <br />
  </div>
  </div>
  <?php
  if (isset($_POST['btni'])) {
    include 'controller/conexion.php';
    $nombre_completo = $_POST['nombre_completo'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $user = $_POST['user'];
      $generar = "INSERT INTO `tbl_inscripciones`(`id_inscripcion`, `nombre`, `usuario`, `correo`, `numero`, `estado`) 
      VALUES (default,'$nombre_completo','$user','$correo','$telefono','Por crear')";
      if (!mysqli_query($con, $generar)) {
        echo "<script type='text/javascript'>";
        echo "alerta('¡Error! No se ha podido crear el usuario','error','#');";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alerta('Usuario creado éxitosamente','success','index');";
        echo "</script>";
      }
      include 'controller/cerrar_conx.php';
  }
  ?>
</body>

</html>