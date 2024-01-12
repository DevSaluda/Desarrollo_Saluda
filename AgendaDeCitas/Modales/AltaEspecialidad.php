<div class="modal fade" id="Especialidad" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Alta de especialidad</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold"><? echo $row['Nombre_Apellidos']?>, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
 
 <form action="javascript:void(0)" method="post" id="AltaEspecialidades">
 
 
     <label for="exampleFormControlInput1">Nombre de especialidad  <span class="text-danger"> * </span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-medical"></i></span>
  </div>
  <input type="text" class="form-control" name="Especialidad" id="especialidad"  aria-describedby="basic-addon1">

</div>
<div>
<label for="especialidad" class="error">
</div>
<label for="exampleFormControlInput1">Sucursal <span class="text-danger"> * </span> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-medical"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal"  >
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Nombre_Sucursal !='Matriz'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>

</div>
<div>
<label for="especialidad" class="error">
</div>
<input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<? echo $row['ID_H_O_D']?>" >
<input type="text" class="form-control" id="usuario" name="Usuario" hidden  value="<? echo $row['Nombre_Apellidos']?>" >    
   
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                             </form>
                                        
     
    
      
      </div>
    </div>
  </div>
</div></div></div>

