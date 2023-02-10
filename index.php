<?php
session_start();
?>
<!DOCTYPE html>

<head>
  <title>MyCliente  </title>
  <meta charset="utf-8" />
  <link rel="stylesheet" href="views/login.css">
  <link href='app/images/logo.png' rel='shortcut icon' type='image/png'>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <script src='//cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>


<body class="align">
  <div class="grid">

    <form method="POST" class="form login">
      <center><img src="app/images/icono.png" width="225" height="225"></center>
      <div class="form__field">
        <label for="login__username"><svg class="icon">
            <use xlink:href="#icon-user"></use>
          </svg><span class="hidden">Username</span></label>
        <input autocomplete="username" id="login__username" type="text" name="usu" class="form__input" placeholder="Usuario" required>
      </div>

      <div class="form__field">
        <label for="login__password"><svg class="icon">
            <use xlink:href="#icon-lock"></use>
          </svg><span class="hidden">Password</span></label>
        <input id="login__password" type="password" name="pas" class="form__input" placeholder="Contraseña" required>
      </div>

      <div class="form__field">
        <input type="submit" value="Ingresar" name="btni">
      </div>

    </form>

    <!--<p class="text--center">¿No tienes usuario? <a href="inscripcion">¡Crea uno!</a> <svg class="icon">
        <use xlink:href="#icon-arrow-right"></use>
      </svg></p>
    <p class="text--center">¡Soporte técnico! <a href="suport">Solicitar</a> <svg class="icon">
        <use xlink:href="#icon-arrow-right"></use>
      </svg></p>-->
      <p class="text--center"> <a href="#">Acceso temporalmente limitado</a></p>

  </div>

  <svg xmlns="http://www.w3.org/2000/svg" class="icons">
    <symbol id="icon-arrow-right" viewBox="0 0 1792 1792">
      <path d="M1600 960q0 54-37 91l-651 651q-39 37-91 37-51 0-90-37l-75-75q-38-38-38-91t38-91l293-293H245q-52 0-84.5-37.5T128 1024V896q0-53 32.5-90.5T245 768h704L656 474q-38-36-38-90t38-90l75-75q38-38 90-38 53 0 91 38l651 651q37 35 37 90z" />
    </symbol>
    <symbol id="icon-lock" viewBox="0 0 1792 1792">
      <path d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z" />
    </symbol>
    <symbol id="icon-user" viewBox="0 0 1792 1792">
      <path d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z" />
    </symbol>
  </svg>

  <?php
  if (isset($_POST['btni'])) {
    $usuario = $_POST['usu'];
    $pass = $_POST['pas'];
    include 'controller/conexion.php';

    $consulta_mysql = "SELECT * FROM  tbl_usuarios WHERE usuario='$usuario' and estado<'3' and permiso='Administrador' LIMIT 1 ";
    $resultado_consulta_mysql = mysqli_query($con, $consulta_mysql);
    $nr = mysqli_num_rows($resultado_consulta_mysql);
    if ($nr < 1) {
      $consulta_usu = "SELECT * FROM  tbl_usuarios WHERE usuario='$usuario' LIMIT 1 ";
      $resultado_usu = mysqli_query($con, $consulta_usu);
      while ($fila = mysqli_fetch_array($resultado_usu)) {
        $intentos = $fila['estado'];
      }
      $intentos_restantes = 3 - $intentos;
      $intentos1 = $intentos + 1;
      $consulta_mysql = "UPDATE `tbl_usuarios` SET `estado`='$intentos1' WHERE usuario='$usuario'";
      mysqli_query($con, $consulta_mysql);
      echo "<script type='text/javascript'>";
      echo "Swal.fire({
        title:'Usuario inexistente o bloqueado',
        icon:'error',
        position:'top',
        showConfirmButton:true,
     });";
      echo "</script>";
    } else {
      while ($fila = mysqli_fetch_array($resultado_consulta_mysql)) {
        $hashpass = $fila['clave'];
        if (password_verify($pass, $hashpass)) {
          $_SESSION['cedula'] = $fila['cedula'];
          $_SESSION['nombre'] = $fila['nombre'];
          $_SESSION['permiso'] = $fila['permiso'];
          echo "<script type='text/javascript'>";
          echo "window.location.replace('app/mp');";
          echo "</script>";
          $consulta_mysql = "UPDATE `tbl_usuarios` SET `estado`='0' WHERE usuario='$usuario'";
          mysqli_query($con, $consulta_mysql);
        } else {
          echo "<script type='text/javascript'>";
          echo "Swal.fire({
        title:'Contraseña incorrecta',
        icon:'error',
        position:'top',
        showConfirmButton:true,
     });";
          echo "</script>";
        }
      }
    }
    include 'controller/cerrar_conx.php';
  } else {
    echo "<script type='text/javascript'>";
    echo "window.location.replace('#');";
    echo "</script>";
  }



  ?>

</body>

</html>