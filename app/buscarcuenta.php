<script src="lib/js/ajax.js"></script>
<?php
session_start();
$buscar = $_POST['b'];
if(!empty($buscar)) {
      buscar($buscar);  
}
 
function buscar($b) {
  $id_usuario=$_SESSION['cedula'];
      include( '../controller/conexion.php');
      $sqllot= "SELECT * FROM tbl_cuentas WHERE correo_cuenta='$b' and id_usuario='$id_usuario'";
      $sql = mysqli_query($con,$sqllot);
      $contar = mysqli_num_rows($sql);
       
      if($contar > 0) { echo"<script>
        $('#divcuenta').show();
        </script>"; 
        while ($row=mysqli_fetch_array($sql)) {
          $clave=$row['contraseña_cuenta'];
          $servicio=$row['id_servicio']; ?>
<input value="<?=$clave?>" style="display: none;" class="form-control" placeholder="Contraseña de la cuenta" name="clave_cuenta" type="text" autofocus required>
<input value="<?=$servicio?>" style="display: none;" class="form-control" name="servicio" type="text" autofocus required>
<?php
        } ?>
        <input style="display: none;" value="Existente" class="form-control" name="estadocuenta" type="text" required>
          <input required class="form-control" placeholder="Días pagos" name="dias" type="number" autofocus>
            <br>
            <input class="form-control" placeholder="Perfil (Opcional)" name="perfil" type="text" autofocus>
            <br>
            <input class="form-control" placeholder="PIN (Opcional)" name="pin" type="number" autofocus>
            <br>
            <input required class="form-control" placeholder="Precio de venta" name="precio" type="number" autofocus>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Registrar venta" name="btnreg">
          </div>
      <?php } else{
        echo"<script>
        $('#divcuenta').show();
        </script>"; ?>
        <input style="display: none;" value="No existente" class="form-control" name="estadocuenta" type="text" required>
        <select class="js-example-basic-single form-control" name="servicio">
              <option selected hidden>Servicio vendido</option>
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
            <br>
            <input class="form-control" placeholder="Contraseña de la cuenta" name="clave_cuenta" type="text" autofocus required>
            <br>
            <input class="form-control" placeholder="Cantidad de perfiles de la cuenta" name="perfiles" type="number" autofocus required>
            <br>
            <input class="form-control" placeholder="Días para renovar la cuenta" name="diascuenta" type="number" autofocus required>
            <br>
            <input required class="form-control" placeholder="Días pagos por el cliente" name="dias" type="number" autofocus>
            <br>
            <input class="form-control" placeholder="Perfil (Opcional)" name="perfil" type="text" autofocus>
            <br>
            <input class="form-control" placeholder="PIN (Opcional)" name="pin" type="number" autofocus>
            <br>
            <input required class="form-control" placeholder="Precio de venta" name="precio" type="number" autofocus>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <input type="submit" class="btn btn-primary" value="Registrar venta" name="btnreg">
          </div>
     <?php
        }
      

        }
?>