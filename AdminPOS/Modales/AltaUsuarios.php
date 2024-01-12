<!-- Central Modal Medium Info -->
<div class="modal fade" id="AltaUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-lg modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Alta de nuevo usuario</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <form action="javascript:void(0)" method="post" id="AgregaEmpleados">
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombres y apellidos</label>
      <input type="text" class="form-control" placeholder="Ingresa el nombre y apellidos">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Foto del usuario</label>
      <input type="text" class="form-control" placeholder="Last name">
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo electronico</label>
      <input type="email" class="form-control" placeholder="Por ejemplo 'Joel@outlook.com'">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Contraseña</label>
      <input type="text" class="form-control" placeholder="***************">
    </div>
  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha de nacimiento</label>
      <input type="Date" class="form-control" placeholder="24/06/1995">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
    <select id = "sucursal" class = "form-control" name = "Sucursal">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
         
    </div>
 
    <input type="number" class="form-control" hidden readonly value="6">
    <input type="text" class="form-control" hidden readonly value="<?echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control" hidden readonly value="<?echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control" hidden readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control" hidden readonly value="Activo">
    <input type="text" class="form-control" hidden readonly value="btn btn-success btn-sm">
   

  
</div>

         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                        </form>
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Info-->
