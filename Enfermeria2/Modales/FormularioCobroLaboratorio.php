
  
      <div class="modal fade bd-example-modal-xl" id="CobraLaboratorio" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nuevo procedimiento <i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold"><?echo $row['Nombre_Apellidos']?>, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
     
 <form action="javascript:void(0)" method="post" id="AgregaProcedimientos"> 
    
 
    
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly maxlength="60">
    </div>
    
    
      
    <label for="exampleFormControlInput1">Codigo procedimiento <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="CodigoProcedimiento" id="codigoprocedimiento" placeholder="0235-A" aria-describedby="basic-addon1" maxlength="60">            
</div>

<label for="exampleFormControlInput1">Nombre de procedimiento <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreProcedimiento" id="nombreprocedimiento" placeholder="Por ejemplo: Inyeccion" aria-describedby="basic-addon1" maxlength="60">            
</div>
<label for="exampleFormControlInput1">Costo de procedimiento <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="CostoProcedimiento" id="costoprocedimiento" placeholder="Por ejemplo:30.00" aria-describedby="basic-addon1" maxlength="60">            
</div>

    
    

<input type="text" class="form-control " hidden  readonly name="Usuario" id="usuario"  readonly value="<?echo $row['Nombre_Apellidos']?>">

<input type="text" class="form-control "  hidden id="empresa" name="Empresa" readonly value="<?echo $row['ID_H_O_D']?>">
  <div>
   
      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
 