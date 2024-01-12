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
        <form  method="post" id="Logs">
  
      <input type="text" class="form-control" name="usuario" id="usuario" readonly hidden value="<?echo $row['Nombre_Apellidos']?>" >
      <input type="text" class="form-control" name="log" id="log" readonly hidden value="Cierre de sesión" >
      <input type="text" class="form-control" name="sistema" id="sistema" hidden readonly value="Punto de venta" >
      <input type="text" class="form-control" name="empresa" id="empresa" hidden readonly value="<?echo $row['ID_H_O_D']?>" >
  
  

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
