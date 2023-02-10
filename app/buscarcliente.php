<script src="lib/js/ajax.js"></script>
<?php
session_start();
$buscar = $_POST['b'];
if(!empty($buscar)) {
      buscar($buscar);  
}
 
function buscar($b) {
      include( '../controller/conexion.php');
      $sqllot= "SELECT * FROM tbl_clientes WHERE nombre_cliente='$b'";
      $sql = mysqli_query($con,$sqllot);
      $contar = mysqli_num_rows($sql);
       
      if($contar < 1){
        echo"<script>
        $('#divcliente').show();
        </script>";?>
        <select style="width: 30%;" name="pais" class="form-control">
            <option value="">País (Opcional)</option>
            <option value="57">Colombia</option>
            <option value="591">Bolivia</option>
            <option value="59">Ecuador</option>
            <option value="51">Perú</option>
            <option value="58">Venezuela</option>
            <option value="54">Argentina</option>
            <option value="595">Paraguay</option>
            <option value="598">Uruguay</option></select>
            <br>
            <input class="form-control" placeholder="Teléfono Ej: 3214567895 (Opcional)" name="telefono" type="number" autofocus>
            <br>
            <input class="form-control" placeholder="Correo electrónico del cliente (Opcional)" name="correo_cliente" type="email" autofocus>
     <?php
      }else { echo"<script>
        $('#divcliente').show();
        </script>";
        while ($row=mysqli_fetch_array($sql)) {
          $tel=$row['telefono'];
          $correo=$row['correo_cliente']; ?>
<input value="<?=$tel?>" style="display: none;" class="form-control" name="telefono" type="text" autofocus>
<input value="<?=$correo?>" style="display: none;" class="form-control" name="correo_cliente" type="text" autofocus>
<?php
        } ?>
          Cliente registrado con anterioridad 
      <?php }

        }
?>