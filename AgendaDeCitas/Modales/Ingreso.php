<?$fcha = date("Y-m-d");?>
<div class="modal fade" id="Ingreso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
data-backdrop="static" data-keyboard="false" aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-sm" role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header">
        <img src="../Perfiles/<?echo $row['file_name']?>" alt="Perfil" class="rounded-circle img-responsive">
      </div>
      <!--Body-->
      <div class="modal-body text-center mb-1">

      <h5 class="mt-1 mb-2"> ¡Hola!<br>
        <?echo $mensaje?> <br>
        <?echo $row['Nombre_Apellidos']?> <br>
  
        <button type="submit" class="btn btn-primary"  name="Carga" id="Carga"><i class="fa fa-refresh fa-spin"></i> Estamos cargando los datos.. <i class="fa fa-refresh fa-spin"></i></button></h5>
        <form  method="post" id="Logs">
  
      <input type="text" class="form-control" name="usuario" id="usuario" readonly hidden value="<?echo $EstadoIngreso['PersonalAgenda_ID']?>" >
      <input type="date" class="form-control" name="fechaingreso"  hidden readonly  value="<?echo $fcha?>" >
      <input type="datetime" name="Horaingreso" readonly  hidden value="<?echo date('h:i:s A');?>">
  
  

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <button type="submit" class="btn btn-default"  name="CS" id="CS">Continuar <i class="fas fa-check"></i></button>
       
       </div>
       </form>
      

       
      </div>

    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: Login with Avatar Form-->

