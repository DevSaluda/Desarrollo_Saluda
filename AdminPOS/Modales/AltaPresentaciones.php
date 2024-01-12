
  
      <div class="modal fade bd-example-modal-xl" id="AltaPresentacion" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nueva presentación</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold"><i class="fas fa-info-circle"></i> <?echo $row['Nombre_Apellidos']?>, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
     
 <form action="javascript:void(0)" method="post" id="AgregaPresentacionNueva">
    
 
 <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly maxlength="60">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre de presentación <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="Nombrepresentacion" id="nombrepresentacion" placeholder="Por ejemplo: Antibiotico" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>
<div><label for="nombrepresentacion" class="error">
</div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Siglas<span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " id="siglas" name="Siglas" maxlength="60">
    </div>
    </div>
      
    <div class="col">
<label for="exampleFormControlInput1">Vigencia <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <select name="Vigencia" class="form-control" id="vigenciapresentacion" onchange="TipoVigenciaPresentaciones();">
                   <option value="">Elige un estatus</option>
                    
				
              <option  value="background-color: #2BBB1D !important;">Vigente</option>		
              <option  value="background-color: #828681  !important;">Descontinuado</option>						  	
              <option  value="background-color: #ff6c0c !important;">Próximamente</option>						  				  
             </select>
             </div><div><label for="vigencia" class="error">
</div>
</div> </div> 
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #00c851 !important;">Estatus de presentacion</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
     <button id="SiVigentePresentacion" class="divOculto2 btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="NoVigentePresentacion" class="divOculto2 btn btn-default btn-sm" style="background-color: #828681  !important;">Descontinuado</button>
      <button id="QuizasproximoPresentacion" class="divOculto2 btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
<input type="text" class="form-control " hidden disabled readonly id="usuariop" disabled readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text"  class="form-control " hidden disabled readonly name="VigenciaEst" id="vigenciaestp">
<input type="text" class="form-control "  hidden disabled readonly id="sistemap" disabled readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresap" disabled readonly value="<?echo $row['ID_H_O_D']?>">
  <div>
   
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  <script type="text/javascript">
  

  function TipoVigenciaPresentaciones() {


/* Para obtener el texto */
var combo = document.getElementById("vigenciapresentacion");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestp").val(selected);
}


$(function() {
  
    
$("#vigenciapresentacion").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #2BBB1D !important;":
        $("#SiVigentePresentacion").show();
                        
                        $("#NoVigentePresentacion").hide();
                        $("#QuizasproximoPresentacion").hide();    
     
      break;

    case "background-color: #828681  !important;":
        $("#NoVigentePresentacion").show();

        $("#SiVigentePresentacion").hide();
        $("#QuizasproximoPresentacion").hide();    
     
      
      break;
      case "background-color: #ff6c0c !important;":
        $("#QuizasproximoPresentacion").show();    
        $("#NoVigentePresentacion").hide();
        $("#SiVigentePresentacion").hide();
       
     
      
      break;
      case "":
        $("#NoVigentePresentacion").hide();
        $("#QuizasproximoPresentacion").hide();    
        $("#SiVigentePresentacion").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOculto2 {
			display: none;
		}
</style>