<script type="text/javascript">
$(document).ready( function () {
    $('#CitasExteriores').DataTable({
      "order": [[ 0, "desc" ]],
     
      "info": false,
      "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
		},
 
    
		
	  } 
	  
	  );
} );
</script>
<?php
function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
include("db_connection.php");
include "Consultas.php";


$user_id=null;
$sql1="SELECT Agenda_Labs.Id_genda,Agenda_Labs.Nombres_Apellidos,Agenda_Labs.Telefono,Agenda_Labs.Fk_sucursal,Agenda_Labs.Hora,
Agenda_Labs.Fecha,Agenda_Labs.LabAgendado,Agenda_Labs.Asistio,Agenda_Labs.Agrego,Agenda_Labs.AgregadoEl,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM
Agenda_Labs, SucursalesCorre WHERE SucursalesCorre.ID_SucursalC = Agenda_Labs.Fk_sucursal ";
$query = $conn->query($sql1);
?>

<?php if($query->num_rows>0):?>
  <div class="text-center">
    <div class="table-responsive">
      <table  id="CitasExteriores" class="table table-hover">
        <thead> 
          <th>Proveedor</th>
          <th>Nombre comercial</th>
          <th>Ingrediente Activo</th>
          <th>Presentación</th>
          <th>Cantidad a pedir</th>
          <th>Stock actual</th>
        </thead>
        <tbody>
          <?php while ($Usuarios=$query->fetch_array()):?>
            <tr>
              <td><input type="text" class="form-control" value="<?php echo $Usuarios["Proveedor"]; ?>" readonly></td>
              <td><input type="text" class="form-control" value="<?php echo $Usuarios["Nombre_comercial"]; ?>" readonly></td>
              <td><input type="text" class="form-control" value="<?php echo $Usuarios["Ingrediente_Activo"]; ?>" readonly></td>
              <td><input type="text" class="form-control" value="<?php echo $Usuarios["Presentación"]; ?>" readonly></td>
              <td><input type="number" class="form-control" value="<?php echo $Usuarios["Cantidad_a_pedir"]; ?>" readonly></td>
              <td><input type="number" class="form-control" value="<?php echo $Usuarios["Stock_actual"]; ?>" readonly></td>
            </tr>
          <?php endwhile;?>
        </tbody>
      </table>
    </div>
  </div>
<?php else:?>
  <p class="alert alert-warning">Por el momento no hay citas</p>
<?php endif;?>


  <div class="modal fade" id="editModalExt" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalExtLabel" aria-hidden="true">
  <div id="DiExt"class="modal-dialog  modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloExt"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><?php echo $row['Nombre_Apellidos']?>
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editExt"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->    