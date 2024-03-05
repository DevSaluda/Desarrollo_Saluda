<div class="modal fade" id="AltaSucursal" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alta de sucursal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="error_alta" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
      <div class="modal-body">
     
 <form action="javascript:void(0)" method="post" id="ajax-form">
    
 <div id="ValidaSucursal"></div>
<label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT Nombre_ID_Sucursal,Dueño_Propiedad FROM Sucursales WHERE  Dueño_Propiedad='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Nombre_ID_Sucursal].'">'.$valores[Nombre_ID_Sucursal].'</option>';
          }
        ?>  </select>
         
</div>


<input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<? echo $row['ID_H_O_D']?>" >
<input type="text" class="form-control" id="estatus" name="Estatus" hidden   value="Activo" >
<input type="text" class="form-control" id="color" name="Color" hidden   value="btn btn-success btn-sm" >              
               
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        <br>
      <div class="modal-footer">
      <p class="statusMsg"></p>
     

      </div>
    </div>
  </div>
</div></div>
