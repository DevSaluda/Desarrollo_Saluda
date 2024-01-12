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
Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,Programacion_Medicos_Sucursales.Fecha_Inicio,Programacion_Medicos_Sucursales.Fecha_Fin,
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
  <b>Horarios completos</b>
<input type="checkbox" name="check" id="check" value="1" onchange="showContent()" />
</div>
<div id="AutorizaFin"> 
  <form action="javascript:void(0)" method="post" id="ProgramaHoras">
  <?php

$inicio =$Especialistas->Hora_inicio;
$final = $Especialistas->Hora_Fin;
$incr = $Especialistas->Intervalo;
$date_obj = new DateTime($inicio);
    $date_incr = $inicio;
    while($date_incr < $final) {
        $date_incr = $date_obj->format('H:i:s');
        $date_incr;
        $date_obj->modify('+'.$incr.' minutes');
    
        
     
    
    echo '<input  class="form-control"  hidden name="HorasAGuardar[]" value="'.$date_incr.'">';
} 
?>
  
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Medico<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Nombre_Apellidos; ?>" >
  
         
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Nombre_Sucursal; ?>" >
 
 
         
    </div><label for="nombreprod" class="error">
    </div>  
    <div class="col">
    <label for="exampleFormControlInput1">Fecha<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <select  class = "form-control" name = "FechaAsignadaParaHoras"  >
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT ID_Fecha_Esp,Fecha_Disponibilidad,Fk_Programacion FROM 
          Fechas_Especialistas_Sucursales WHERE ID_Fecha_Esp NOT IN (SELECT FK_Fecha FROM Horarios_Citas_Sucursales) AND Fk_Programacion=$Especialistas->ID_Programacion");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Fecha_Esp].'">'.fechaCastellano($valores[Fecha_Disponibilidad]).'</option>';
          }
        ?>  </select>
  
         
    </div><label for="nombreprod" class="error">
    </div> 
  
    </div>
    
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Hora inicio<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Hora_inicio; ?>" >
  
         
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Hora fin<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Hora_Fin; ?>" >
  
         
    </div><label for="nombreprod" class="error">
    </div>  
    <div class="col">
    <label for="exampleFormControlInput1">Tiempo entre citas<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Intervalo; ?>" >
  
         
    </div><label for="nombreprod" class="error">
    </div>  </div>
  
    

    <input type="text" class="form-control " hidden name="MedicoHoras" readonly  value="<? echo $Especialistas->FK_Medico; ?>" >
    <input type="text" class="form-control "  hidden name="NumberProgramaHoras" readonly  value="<? echo $Especialistas->ID_Programacion; ?>" >
       
     
    <input type="text" class="form-control"  hidden name="UsuarioHoras"  readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="EmpresaHoras"  readonly value=" <?echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control"  hidden  name="SistemaHoras"  readonly value="<?echo $row['Nombre_rol']?>">
    
   

  

     
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form></div></div>
                                        <div id="content" style="display: none;">
                                        <form action="javascript:void(0)" method="post" id="ActualizaElEstadoHoras"> 
                                        <div class="modal-body">
                                        <p>¿Esta seguro que se han autorizado todos los horarios para fechas? <br> del medico <? echo $Especialistas->Nombre_Apellidos; ?> <br>
                                        de la sucursal <? echo $Especialistas->Nombre_Sucursal; ?>  <br> del periodo <? echo $Especialistas->Fecha_Inicio; ?> al <? echo $Especialistas->Fecha_Fin; ?>
                                         <br>
        <i class="fas fa-calendar-times fa-4x animated rotateIn"></i>
       
      </div>
      
                                        <input type="text" class="form-control " hidden  name="ID_ProgramaF" readonly  value="<? echo $Especialistas->ID_Programacion; ?>" >
                                        <input type="text" class="form-control"  hidden name="EstadoProgramacionF"  readonly value="Autorizado">
       
     
       <input type="text" class="form-control"  hidden name="UsuarioAutorizoF"  readonly value=" <?echo $row['Nombre_Apellidos']?>">
       
       <input type="text" class="form-control"  hidden  name="SistemaAutorizoF"  readonly value="<?echo $row['Nombre_rol']?>">
                                        <button type="submit"   id="ActualizarEstadoFinal" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>               
                                        </div>                           
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

<script src="js/AgregaHorasProgramacion.js"></script>
<script src="js/ActualizaEstadoParaFinalizar.js"></script>

<script>
    function showContent() {
        element = document.getElementById("content");
        element2 = document.getElementById("AutorizaFin");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display='block';
            element2.style.display='none';
        }
        else {
            element.style.display='none';
            element2.style.display='block';
        }
    }

</script>