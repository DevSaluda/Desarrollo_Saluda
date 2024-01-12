<script type="text/javascript">
$(document).ready( function () {
    $('#StockSucursales').DataTable({
      "order": [[ 0, "desc" ]],
      "lengthMenu": [[10,50,100,500, -1], [10,50,100,500, "Todos"]],   
      "language": {
        "url": "Componentes/Spanish.json"
    },
 
 
    
    } 
    
    );
} );
</script>

<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";
include "ContadorIndex.php";

$user_id=null;
$sql1=" SELECT Tickets_Incidencias.ID_incidencia,Tickets_Incidencias.Descripcion,Tickets_Incidencias.Reporto,
Tickets_Incidencias.Fecha_Reporte,Tickets_Incidencias.Sistema,Tickets_Incidencias.Fk_Sucursal,Tickets_Incidencias.Estatus,Tickets_Incidencias.ID_H_O_D, 
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM SucursalesCorre,Tickets_Incidencias where 
Tickets_Incidencias.Fk_Sucursal= SucursalesCorre.ID_SucursalC  
AND Tickets_Incidencias.ID_H_O_D ='".$row['ID_H_O_D']."'";
$query = $conn->query($sql1);
?>

<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row"> 

         <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">                  
                    <h3><?echo $TotalTickets['TotalTickets']?></h3>

                     <p>Total Tickets</p>
                  </div>

                  <div class="icon">
                  <i class="fas fa-ticket"></i>        
                  </div>

                  <a data-toggle="modal" data-target="#MuestraTicketsAbiertos" class="small-box-footer">Ver <i class="fas fa-eye"></i></a>
                </div>
           </div>

                      <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">                  
                     <h3><?echo $TicketsAsignados['TicketsAsignados']?></h3>

                     <p>Tickets Asignados</p>
                  </div>
                  <div class="icon">
                  <i class="fas fa-user"></i>
                  </div>
                  <a data-toggle="modal"  data-target="#MuestraTicketsAsignados" class="small-box-footer">Ver <i class="fas fa-eye"></i></a>
                </div>
           </div>

        <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">                 
                      <h3><?echo $TicketsCerrados['TicketsCerrados']?></h3>

                     <p>Tickets Cerrados</p>
                  </div>
                  <div class="icon">
                  <i class="fas fa-clock"></i>
                  </div>
                  <a data-toggle="modal" data-target="#MuestraTicketsCerrados" class="small-box-footer">Ver <i class="fas fa-eye"></i></a>
                </div>
        </div>



        </div> 
</div> 

<?php
include "../Modales/NuevoTicket.php";

?>



<?php if($query->num_rows>0):?>
  <div class="text-center">
  <div class="table-responsive">
  <table  id="StockSucursales" class="table table-hover">
<thead>

    <th>Folio</th>
    <th>Descripcion</th> 
    <th>Reporta</th>
    <th>Sistema</th>
    <th>Fecha reporte</th>
    <th>Sucursal</th>
    <th>Estatus</th>
    <th>Asignado a</th>
    <th>Fecha Asignación</th>
    <th>Fecha Cierre</th>
     <th>Acciones</th>
</thead>

<?php while ($Usuarios=$query->fetch_array()):?>
<tr>


  <td > <?php echo $Usuarios['ID_incidencia']; ?></td>
  <td > <?php echo $Usuarios['Descripcion']; ?></td>
  <td > <?php echo $Usuarios['Reporto']; ?>  </td>
  <td > <?php echo $Usuarios['Sistema']; ?></td>
  <td > <?php echo fechaCastellano($Usuarios['Fecha']); ?></td>
  <td > <?php echo $Usuarios['Nombre_Sucursal']; ?></td>
  <td > <?php echo $Usuarios['Estatus']; ?></td>
  <td > <?php echo $Usuarios['']; ?></td>
  <td > <?php echo $Usuarios['']; ?></td>
  <td > <?php echo $Usuarios['']; ?></td>
  <td >
        <!-- Basic dropdown -->
        <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"
          aria-haspopup="true" aria-expanded="false"><i class="fas fa-list-ul"></i></button>

        <div class="dropdown-menu">
        <a data-id="<?php echo $Cumples["Folio_Ticket"];?>" class="btn-asigna dropdown-item" >Asignar <i class="fas fa-user"></i></a>
        <a data-id="<?php echo $Cumples["Folio_Ticket"];?>" class="btn-cierra dropdown-item" >Modificar <i class="fas fa-phone"></i></a> 
        </div>
        <!-- Basic dropdown -->
  </td >

</tr>
<?php endwhile;?>
</table>
</div>
</div>
<?php else:?>
  <p class="alert alert-warning">Aún no hay incidencias registradas </p>
<?php endif;?>


  <!-- Modal -->







  <?

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
?>
