<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Programacion_MedicosExt.ID_Programacion, Programacion_MedicosExt.FK_Medico, Programacion_MedicosExt.Fk_Sucursal, Programacion_MedicosExt.Tipo_Programacion, Programacion_MedicosExt.Fecha_Inicio, Programacion_MedicosExt.Fecha_Fin, Programacion_MedicosExt.Hora_inicio, Programacion_MedicosExt.Hora_Fin, Programacion_MedicosExt.Intervalo, Programacion_MedicosExt.Sistema, Programacion_MedicosExt.ID_H_O_D, SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,Personal_Medico_Express.Medico_ID,Personal_Medico_Express.Nombre_Apellidos
FROM Personal_Medico_Express,SucursalesCorre,Programacion_MedicosExt WHERE Personal_Medico_Express.Medico_ID = Programacion_MedicosExt.FK_Medico &&
SucursalesCorre.ID_SucursalC= Programacion_MedicosExt.Fk_Sucursal && Programacion_MedicosExt.ID_H_O_D ='".$row['ID_H_O_D']."' AND Programacion_MedicosExt.ID_Programacion = ".$_POST["id"];

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
    
  <form action="javascript:void(0)" method="post" id="ProgramaFechasNuevas">
 
  
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
    </div>  </div>
    <div class="form-group">
    <label for="exampleInputEmail1">Fechas disponibles</label> <br>
    <?php
$fechaInicio=strtotime($Especialistas->Fecha_Inicio);
$fechaFin=strtotime($Especialistas->Fecha_Fin);

?>  </select>   

<select id = "SeleccionFechas" class = "form-control" name = "FechasAguardar[]" multiple>
                          <?
                          for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
     
                            echo '<option value="'.date("Y-m-d",$i).'">'.date("Y-m-d",$i).'</option>';

                        }                   
                        ?> 
        </select>            
    </div>
    </div><label for="mine" class="error">
    </div>
  </div>

    <!-- <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Fecha_Inicio; ?>" >
  
         
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Fecha_Fin; ?>" >
  
         
    </div><label for="nombreprod" class="error">
    </div>  </div> -->
   
    

    <input type="text" class="form-control " hidden name="Medico" readonly  value="<? echo $Especialistas->FK_Medico; ?>" >
    <input type="text" class="form-control "  hidden name="NumberPrograma" readonly  value="<? echo $Especialistas->ID_Programacion; ?>" >
       
     
    <input type="text" class="form-control"  hidden name="UsuarioA"  readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="Empresa"  readonly value=" <?echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control"  hidden  name="SistemaA"  readonly value="<?echo $row['Nombre_rol']?>">
    
   

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>

                                        <!-- <form action="javascript:void(0)" method="post" id="ActualizaElEstadoFechas"> 
                                        <input type="text" class="form-control "   name="ID_Programa" readonly  value="<? echo $Especialistas->ID_Programacion; ?>" >
                                        <input type="text" class="form-control"  hidden name="EstadoProgramacion"  readonly value="Autorizar Horas">
       
     
       <input type="text" class="form-control"  hidden name="UsuarioAutorizo"  readonly value=" <?echo $row['Nombre_Apellidos']?>">
       
       <input type="text" class="form-control"  hidden  name="SistemaAutorizo"  readonly value="<?echo $row['Nombre_rol']?>">
                                        <button type="submit"   id="ActualizarEstadoFechas" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>                -->
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <?php else:?>
  <p class="alert alert-danger">Es posible que  esta programación  ya tenga sus fechas verificadas y asignadas por eso no podemos encontrar los datos que requieres. <i class="fas fa-exclamation-triangle"></i></p>
<?php endif;?>
<script src="js/AgregaFechasProgramacionExtV2.js"></script>


<script>
$(function(){
  $('#SeleccionFechas').multiselect({
          includeSelectAllOption: true,
          enableFiltering: true,
          selectAllText: 'Seleccionar Todas las fechas', 
          nonSelectedText: 'Elija fechas',
          enableFiltering: true,
          filterPlaceholder: 'Buscar fecha',
          selectAllValue: 'Marcar todo',
        });
});   
</script>