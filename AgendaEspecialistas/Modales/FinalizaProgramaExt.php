<?php

include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

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
$fcha = date("Y-m-d");
$user_id=null;
$sql1="SELECT Programacion_MedicosExt.ID_Programacion,Programacion_MedicosExt.FK_Medico,Programacion_MedicosExt.Fk_Sucursal,Programacion_MedicosExt.Tipo_Programacion,Programacion_MedicosExt.Fecha_Inicio,Programacion_MedicosExt.ID_H_O_D,Programacion_MedicosExt.ID_H_O_D,
Programacion_MedicosExt.Fecha_Fin,Programacion_MedicosExt.Hora_inicio,Programacion_MedicosExt.Hora_Fin,
Programacion_MedicosExt.Intervalo,Programacion_MedicosExt.Estatus, Especialidades_Express.ID_Especialidad,
Especialidades_Express.Nombre_Especialidad,Personal_Medico_Express.Medico_ID,Personal_Medico_Express.Especialidad_Express,
Personal_Medico_Express.Nombre_Apellidos,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM 
Programacion_MedicosExt,Especialidades_Express,Personal_Medico_Express,SucursalesCorre WHERE Programacion_MedicosExt.FK_Medico = Personal_Medico_Express.Medico_ID 
AND Programacion_MedicosExt.Fk_Sucursal= SucursalesCorre.ID_SucursalC AND Personal_Medico_Express.Especialidad_Express = Especialidades_Express.ID_Especialidad 
AND Programacion_MedicosExt.ID_Programacion = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>
<?php if($Especialistas!=null):?>
  
                                        <form action="javascript:void(0)" method="post" id="FinalizaSucursales"> 
                                        <div class="modal-body">
                                        <p>¿Estas seguro que deseas finalizar la programacion? <br> del medico <?php echo $Especialistas->Nombre_Apellidos; ?> <br>
                                        de la sucursal <?php echo $Especialistas->Nombre_Sucursal; ?>  <br> del periodo <?php echo $Especialistas->Fecha_Inicio; ?> al <?php echo $Especialistas->Fecha_Fin; ?>
                                         <br>
        <i class="fas fa-calendar-times fa-4x animated rotateIn"></i>
       
      </div>
                                        <input type="text" class="form-control " hidden id="ID_ProgramaF" name="ID_ProgramaF" readonly  value="<?php echo $Especialistas->ID_Programacion; ?>" >
                                       
                                        <button type="submit"   id="ActualizarEstadoFinal" value="Guardar" class="btn btn-danger">Finalizar <i class="fas fa-check-circle"></i></button>
                                        </form>               
                                  
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>

<script src="js/FinalizaProgramacionExt.js"></script>