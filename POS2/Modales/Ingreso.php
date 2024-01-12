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

        <h5 class="mt-1 mb-2">Bienvenido de nuevo <br>
        <?echo $row['Nombre_Apellidos']?> <br>
        <button type="submit" class="btn btn-primary"  name="Carga" id="Carga"><i class="fa fa-refresh fa-spin"></i> Estamos cargando los datos.. <i class="fa fa-refresh fa-spin"></i></button></h5>
        <form  method="post" id="Logs">
  
      <input type="text" class="form-control" name="usuario" id="usuario" readonly hidden value="<?echo $row['Nombre_Apellidos']?>" >
      <input type="text" class="form-control" name="log" id="log" readonly hidden value="Inicio de sesión" >
      <input type="text" class="form-control" name="sistema" id="sistema" hidden readonly value="POS Ventas" >
      <input type="text" class="form-control"  name="empresa" id="empresa" hidden readonly value="<?echo $row['ID_H_O_D']?>" >
  
  

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
