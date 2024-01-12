<?

include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
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
$sql1="SELECT Programacion_Medicos_Sucursales.ID_Programacion,Programacion_Medicos_Sucursales.FK_Medico,Programacion_Medicos_Sucursales.Fk_Sucursal,
Programacion_Medicos_Sucursales.Estatus,Programacion_Medicos_Sucursales.Hora_inicio,Programacion_Medicos_Sucursales.Hora_Fin,Programacion_Medicos_Sucursales.Intervalo,
Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Programacion_Medicos_Sucursales,SucursalesCorre,Personal_Medico WHERE 
Programacion_Medicos_Sucursales.FK_Medico = Personal_Medico.Medico_ID AND Programacion_Medicos_Sucursales.Fk_Sucursal=SucursalesCorre.ID_SucursalC
AND Programacion_Medicos_Sucursales.ID_Programacion = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>
<? if($Especialistas!=null):?>
  
                                        <form action="javascript:void(0)" method="post" id="FinalizaSucursales"> 
                                        <div class="modal-body">
                                        <p>¿Estas seguro que deseas finalizar la programacion? <br> del medico <? echo $Especialistas->Nombre_Apellidos; ?> <br>
                                        
        <i class="fas fa-calendar-times fa-4x animated rotateIn"></i>
       
      </div>
                                        <input type="text" class="form-control "  hidden id="ID_ProgramaF" name="ID_ProgramaF" readonly  value="<? echo $Especialistas->ID_Programacion; ?>" >
                                       
                                        <button type="submit"   id="ActualizarEstadoFinal" value="Guardar" class="btn btn-danger">Finalizar <i class="fas fa-check-circle"></i></button>
                                        </form>               
                                  
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

<script src="js/FinalizaProgramacion.js"></script>