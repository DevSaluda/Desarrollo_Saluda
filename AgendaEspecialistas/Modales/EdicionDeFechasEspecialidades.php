<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT * FROM `Fechas_EspecialistasExt` WHERE  Fk_Programacion = ".$_POST["id"];

$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>
<?php if ($Especialistas != null): ?>
  <form action="javascript:void(0)" method="post" id="ActualizaFechas">
    <table class="table">
      <tr>
        <th>Fechas activas o disponibles para editar</th>
      </tr>
      <?php
      $query = $conn->query($sql1);
      while ($r = $query->fetch_object()) {
      ?>
        <tr>
          <td>
            <input type="date" class="form-control" name="Fechasporactualizar[]" value="<?php echo $r->Fecha_Disponibilidad; ?>">
            <input type="text" class="form-control" hidden name="Id_Fecha[]" value="<?php echo $r->ID_Fecha_Esp; ?>">
          </td>
        </tr>
      <?php
      }
      ?>
    </table>

    <input type="text" class="form-control" hidden name="Numerodeprogramacion" readonly value="<?php echo $Especialistas->ID_Programacion; ?>">
    <input type="text" class="form-control" hidden name="UsuarioActualiza" readonly value="<?php echo $row['Nombre_Apellidos'] ?>">
  
   

    <button type="submit"   id="ActualizarEstadoFechas" value="Guardar" class="btn btn-success">Actualizar <i class="fas fa-save"></i></button>
                                
  </form>
  </div>
  </div>
  </div>
<?php else: ?>
  <p class="alert alert-danger">Es posible que esta programación ya tenga sus fechas verificadas y asignadas, por eso no podemos encontrar los datos que requieres. <i class="fas fa-exclamation-triangle"></i></p>
<?php endif; ?>
<script src="js/ActualizaFechasEspecialidades.js"></script>



