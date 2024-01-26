<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Programacion_Medicos_Sucursales.ID_Programacion,Programacion_Medicos_Sucursales.FK_Medico,Programacion_Medicos_Sucursales.Fk_Sucursal,
Programacion_Medicos_Sucursales.Estatus,Programacion_Medicos_Sucursales.Fecha_Inicio,Programacion_Medicos_Sucursales.Fecha_Fin,
Personal_Medico.Medico_ID,Personal_Medico.Nombre_Apellidos,
SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Programacion_Medicos_Sucursales,SucursalesCorre,Personal_Medico WHERE 
Programacion_Medicos_Sucursales.FK_Medico = Personal_Medico.Medico_ID AND Programacion_Medicos_Sucursales.Fk_Sucursal=SucursalesCorre.ID_SucursalC 
AND Programacion_Medicos_Sucursales.Estatus ='Autorizar fechas' 
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
<?php if($Especialistas!=null):?>
  <form action="javascript:void(0)" method="post" id="ProgramaFechas">
  <?php
$fechaInicio=strtotime($Especialistas->Fecha_Inicio);
$fechaFin=strtotime($Especialistas->Fecha_Fin);
for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
     
    
    echo '<input  class="form-control " hidden  name="FechasAguardar[]"value="'.date("Y-m-d",$i).'">';
} 
?>
  
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Medico<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Nombre_Apellidos; ?>" >
  
         
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Nombre_Sucursal; ?>" >
  
         
    </div><label for="nombreprod" class="error">
    </div>  </div>

    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Fecha_Inicio; ?>" >
  
         
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Fecha_Fin; ?>" >
  
         
    </div><label for="nombreprod" class="error">
    </div>  </div>
   
    

    <input type="text" class="form-control " hidden name="Medico" readonly  value="<?php echo $Especialistas->FK_Medico; ?>" >
    <input type="text" class="form-control "  hidden name="NumberPrograma" readonly  value="<?php echo $Especialistas->ID_Programacion; ?>" >
       
     
    <input type="text" class="form-control"  hidden name="UsuarioA"  readonly value=" <?php echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="Empresa"  readonly value=" <?php echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control"  hidden  name="SistemaA"  readonly value="<?php echo $row['Nombre_rol']?>">
    
   

  

       </div>
       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>

                                        <form action="javascript:void(0)" method="post" id="ActualizaElEstadoFechas"> 
                                        <input type="text" class="form-control "   name="ID_Programa" readonly  value="<?php echo $Especialistas->ID_Programacion; ?>" >
                                        <input type="text" class="form-control"  hidden name="EstadoProgramacion"  readonly value="Autorizar Horas">
       
     
       <input type="text" class="form-control"  hidden name="UsuarioAutorizo"  readonly value=" <?php echo $row['Nombre_Apellidos']?>">
       
       <input type="text" class="form-control"  hidden  name="SistemaAutorizo"  readonly value="<?php echo $row['Nombre_rol']?>">
                                        <button type="submit"   id="ActualizarEstadoFechas" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>               
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <?php else:?>
  <p class="alert alert-danger">Es posible que  esta programación  ya tenga sus fechas verificadas y asignadas por eso no podemos encontrar los datos que requieres. <i class="fas fa-exclamation-triangle"></i></p>
<?php endif;?>
<script src="js/AgregaFechasProgramacion.js"></script>
<script src="js/ActualizaEstadoParaHoras.js"></script>

 