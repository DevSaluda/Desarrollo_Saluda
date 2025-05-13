<div class="modal fade" id="Salida" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
 aria-hidden="true">
  <div class="modal-dialog cascading-modal modal-avatar modal-sm " role="document">
    <!--Content-->
    <div class="modal-content">

      <!--Header-->
      <div class="modal-header">
          
        <img src="../Perfiles/<?echo $row['file_name']?>" alt="Perfil" class="rounded-circle img-responsive">
    
      </div>
     
      
      <!--Body-->
      <div class="modal-body text-center mb-1">
     
      <i class="fas fa-sign-out-alt fa-4x mb-3 animated rotateIn" style="color:red"></i>
    
        <h5 class="mt-1 mb-2">¿Deseas cerrar tu sesión? <br>
        <?echo $row['Nombre_Apellidos']?> <br>
        <form  method="post" id="Logsalidas">
  
        <input type="text" class="form-control" name="usuariosalida"  readonly hidden value="<?echo $EstadoIngreso['PersonalAgenda_ID']?>" >
      <input type="date" class="form-control" name="fechasalida"  hidden readonly  value="<?echo $fcha?>" >
      <input type="datetime" name="Horasalida" readonly  hidden value="<?echo date('h:i:s A');?>">
  
  

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <button type="submit" class="btn btn-danger" >Salir <i class="fas fa-sign-out-alt"></i></button>
         </form>
       </div>
       
      

       
      </div>

    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: Login with Avatar Form-->
