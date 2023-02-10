<?php
session_start();
include('../../controller/seguridad3.php');
?>
<!DOCTYPE html>

<head>
  <title>Evolución paciente</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta charset="utf-8" />
  <!-- vinculo a bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Temas-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!-- se vincula al hoja de estilo para definir el aspecto del formulario de login-->
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link href='../model/images/logo.png' rel='shortcut icon' type='image/png'>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script src="../model/js/min.js"></script>
  <script type="text/javascript" charset="utf-8">
    function eliminar(validu) {
      if (confirm("Registro actualizado")) {
        url = "../model/module/citapaciente?idu=" + validu;
        window.location.replace(url);
      } else {
        url = "iexamenes";
        window.location.replace(url);
      }
      //
    }
  </script>
  <style type="text/css">
    p{
      margin-top: 25px;
    }
  </style>
<?php function calcular_edad($fecha)
{
    $fecha_nac = new DateTime(date('Y/m/d', strtotime($fecha))); // Creo un objeto DateTime de la fecha ingresada
    $fecha_hoy = new DateTime(date('Y/m/d', time())); // Creo un objeto DateTime de la fecha de hoy
    $edad      = date_diff($fecha_hoy, $fecha_nac); // La funcion ayuda a calcular la diferencia, esto seria un objeto
    return $edad;
}?>
  
  
</head>
<!-- onload="window.print()" -->

<body>
  <div class="container">
    <div class="table-responsive">
      
      <table class="table table-bordered table-hover" style="font-size: 12px">
        <thead>
          <tr>
            <td><b><p style="margin-top: 25px;">Fecha y hora de impresión:</b> <?php
                                        date_default_timezone_set('America/Bogota');
                                        $fecha = date("d/m/Y g:i a");
                                        echo $fecha;
                                        ?></p></td>
            <td><center><b><p style="margin-top: 25px;">Meintegral S.A.S</p></b></center></td>
            <td><img src="../images/logo.png" class="img-rounded" width=200px align="right" /></td>
          </tr>
          <tr>
            <td><center><b>Dirección: Cr. 23 # 39-28</center></td>
            <td><center><b>Formato de historia clínica</b></center></td>
            <td><center><b>Teléfono: 3187692804</b></center></td>
          </tr>
          <tr class="colortabla">
            <th scope="col" colspan="10">
              <center>Información paciente</center>
            </th>
          </tr>
          <tr>
            <?php
            $ident_paciente = $_REQUEST['idu'];
            ?>
            <td><b>Identificación paciente:</b> <?= $ident_paciente ?></td>
            <td>
              <b>Nombre:</b>
              <?php
              //llama el abrir conexion
              include('../../controller/conexion.php');
              //hace la consulta a la tabla
              $consulta_mysql2 = "SELECT * FROM  tbl_pacientes WHERE ident_paciente='$ident_paciente'";
              //se llama  la consulata a la base de datos y la conexion
              $resultado_consulta_mysql2 = mysqli_query($con, $consulta_mysql2);
              //condicion
              while ($fila2 = mysqli_fetch_array($resultado_consulta_mysql2)) {
                echo $fila2['primernomb_paciente'] . "</td><td>" . $fila2['segundonomb_paciente'] . " " . $fila2['primerape_paciente'] . " " . $fila2['segundoape_paciente'] . " ";
                if ($fila2['fechanacimiento_paciente'] != "0000-00-00") {
                  $edad = calcular_edad($fila2['fechanacimiento_paciente']);
                  if ($edad->format('%Y') >= 1) {
                    echo " <b>Edad:</b> ". $edad->format('%Y') ." años";
                  } elseif ($edad->format('%m') >= 1 and $edad->format('%Y') <= 0) {
                    echo " <b>Edad:</b> ". $edad->format('%m') ." meses";
                  } elseif ($edad->format('%d') >= 1 and $edad->format('%m') <= 0 and $edad->format('%Y') <= 0) {
                    echo " <b>Edad:</b> ". $edad->format('%d') ." días";
                  } 
              } elseif ($fila['fechanacimiento_paciente'] == "0000-00-00") {
                echo " <b>Edad:</b> ";
              }
                echo "</td></tr><tr><td> <b>Tipo afiliado:</b> " . $fila2['tipoafiliado_paciente'];
                echo "</td><td> <b>Régimen:</b> " . $fila2['regimen_paciente'];
                echo "</td><td> <b>EPS:</b> " . $fila2['EPS_paciente'] . " </br>";
              }
              ?></ </td>
          </tr>
        </thead>

      </table>
    </div>
    <?php
    $idu = $_REQUEST['idu'];
    $consulta = "SELECT * FROM `tbl_evoluciones` WHERE identificacion_paciente=$idu order by id_evolucion desc limit 1";
    $resultado = mysqli_query($con, $consulta);
    while ($fila = mysqli_fetch_array($resultado)) {
      $id_especialista=$fila['id_especialista']; ?>
      <table class="table table-bordered table-hover" style="font-size: 12px">
        <tr class="colortabla">
          <th scope="col" colspan="10">
            <center>Información evolución</center>
          </th>
        </tr>
        <tr>
          <td><b>Motivo de la consulta: </b><br>
          <?php echo $fila['motivo_evolucion']; ?></td>
        </tr>
        <tr>
          <td><b>Enfermedad actual: </b><br>
          <?php echo $fila['enfermedadactual_evolucion']; ?></td>
        </tr>
        <tr>
          <td><b>Signos vitales: </b><br>
          <?php echo $fila['signos_evolucion']; ?></td>
        </tr>
        <tr>
          <td><b>Hallazgos físicos: </b><br>
          <?php echo $fila['hallazgos_evolucion']; ?></td>
        </tr>
        <tr>
          <td><b>Diagnóstico principal: </b><br>
          <?php echo $fila['diagnosprincipal_evolucion']; ?></td>
        </tr>
        <tr>
          <td><b>Diagnóstico relacionado: </b><br>
          <?php echo $fila['diagnossecundario_evolucion']; ?></td>
        </tr>
        <tr>
          <td><b>Análisis y plan de manejo: </b><br>
          <?php echo $fila['analisis_evolucion']; ?></td>
        </tr>
      </table>
    <?php
    $consulta="SELECT * FROM tbl_usuarios_jornada WHERE cedula_usuario=$id_especialista";
    $resultado_consulta = mysqli_query($con, $consulta);
              while ($fila2 = mysqli_fetch_array($resultado_consulta)){
                $dir=$fila2['firma_usuario'];?>
                <center><img src="../fotos/<?=$dir?>" class="img-rounded" width=150px/></center><br>
                <center><b><?=$fila2['nombre_usuario']?></b></center>
                <center><b>C.C. <?=$fila2['cedula_usuario']?></b></center>
<?php
              }
    }
    ?>
</body>

</html>
<script>
  window.print();
  window.setTimeout(cerrar, 2000);

  function cerrar() {
    window.close();
  }
</script>