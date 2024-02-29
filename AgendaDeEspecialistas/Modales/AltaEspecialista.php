<div class="modal fade" id="Especialista" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Alta de especialista</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
 
 <form action="javascript:void(0)" method="post" id="AltaEspecialistas">

 <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombre y apellidos <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreApellidos" id="nombreapellidos" >
    </div>
    </div>
    <div class="col">

<label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <select id = "SucEs" class = "form-control" >
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $mysqli -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
         
    </div><label for="nombreprod" class="error">
    </div>
  
<div class="col">

<label for="exampleFormControlInput1">Especialidad<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
 
      <select   id = "especialidadsuc" class = "form-control" name = "EspecialidadSuc" disabled = "disabled" >
								<option value = "">Selecciona una especialidad</option>
							</select>
         
    </div><label for="nombreprod" class="error">
    </div>
  
</div>

<div class="row">
    
    
  
<div class="col">

<label for="exampleFormControlInput1">Telefono<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="text" class="form-control " name="Telefono" id="telefono" >
    </div><label for="nombreprod" class="error">
    </div>

    <div class="col">

<label for="exampleFormControlInput1">Correo<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
 
  <input type="text" class="form-control " name="Correo" id="correo" >
    </div><label for="nombreprod" class="error">
    </div>
  
</div>
 

<input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<? echo $row['ID_H_O_D']?>" >
<input type="text" class="form-control" id="usuario" name="Usuario" hidden  value="<? echo $row['Nombre_Apellidos']?>" >   
         
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        

      </div>
    </div>
  </div>
</div></div></div>

