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
      <h2>Inscripción</h2>
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
        <div class="form-group" >
          <label for="exampleInputEmail1">
            <h4>País:</h4>
          </label>
          <br>
          <select style="width: 19%;" name="pais">
            <option>País (Opcional)</option>
            <option value="57">Colombia</option>
            <option value="591">Bolivia</option>
            <option value="59">Ecuador</option>
            <option value="51">Perú</option>
            <option value="58">Venezuela</option>
            <option value="54">Argentina</option>
            <option value="595">Paraguay</option>
            <option value="598">Uruguay</option>
          </select><input style="width: 60%; margin-left:1%;" placeholder="Teléfono ej:3213456978 (Opcional)" type="number" autocomplete="off" name="telefono">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <h4>Correo electrónico:</h4>
          </label>
          <br>
          <input placeholder="(Opcional)" type="email" autocomplete="off" name="correo">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <h4>Nombre de usuario para la plataforma:</h4>
          </label>
          <br>
          <input placeholder="Ejem: carlosdavid123" required type="text" autocomplete="off" name="user">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <h4>Contraseña:</h4>
          </label>
          <br>
          <input required type="password" autocomplete="off" name="pass1">
        </div>
        <div class="form-group">
          <label for="exampleInputEmail1">
            <h4>Repita la contraseña:</h4>
          </label>
          <br>
          <input required type="password" autocomplete="off" name="pass2">
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
    $indicativo = $_POST['pais'];
    $telefono =$indicativo.$_POST['telefono'];
    $correo = $_POST['correo'];
    $user = $_POST['user'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];
    if ($pass1 == $pass2) {
      $realpass=password_hash($pass1,PASSWORD_DEFAULT,['cost'=>5]);

      $crear = "INSERT INTO `tbl_usuarios`(`cedula`, `nombre`, `usuario`, `clave`, `telefono`, 
      `correo_usuario`, `fech_venc`, `permiso`, `estado`) 
      VALUES (default,'$nombre_completo','$user','$realpass','$telefono','$correo',
      '0000-00-00','Usuario','0')";
      if (!mysqli_query($con, $crear)) {
        echo "<script type='text/javascript'>";
        echo "alerta('¡Error! No se ha podido crear el usuario','error','#');";
        echo "</script>";
      } else {
        echo "<script type='text/javascript'>";
        echo "alerta('Usuario creado éxitosamente','success','index');";
        echo "</script>";
      }
      include 'controller/cerrar_conx.php';
    }else {
      echo "<script type='text/javascript'>";
        echo "alerta('¡Error! Las contraseñas no coinciden','error','');";
        echo "</script>";
    }
  }
  ?>
</body>

</html>