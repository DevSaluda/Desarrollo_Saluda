  
      <div class="modal fade bd-example-modal-xl" id="AltaMarcas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nueva marca</p>

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
     
 <form action="javascript:void(0)" method="post" id="AgregaMarcaNueva">
    
 
    
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly maxlength="60">
    </div>
    
    
      
    <label for="exampleFormControlInput1">Nombre de Marca <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreMarca" id="nombremarca" placeholder="Por ejemplo: Antibiotico" aria-describedby="basic-addon1" maxlength="60">            
</div>
<div><label for="nombremarca" class="error">
</div>
<label for="exampleFormControlInput1">Vigencia <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <select name="Vigencia" class="form-control" id="vigenciamarcas" onchange="TipoVigenciaMarcas();">
                   <option value="">Elige un estatus</option>
                    
				
              <option  value="background-color: #2BBB1D !important;">Vigente</option>		
              <option  value="background-color: #828681  !important;">Descontinuado</option>						  	
              <option  value="background-color: #ff6c0c !important;">Próximamente</option>						  				  
             </select>
             </div><div><label for="vigencia" class="error">
</div>
    
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #00c851 !important;">Vigencia de marca</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
     <button id="SiVigenteMarcas" class="divOculto3 btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="NoVigenteMarcas" class="divOculto3 btn btn-default btn-sm" style="background-color: #828681  !important;">Descontinuado</button>
      <button id="QuizasproximoMarcas" class="divOculto3 btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
<input type="text" class="form-control " hidden disabled readonly id="usuariom" disabled readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text"  class="form-control " hidden disabled readonly name="VigenciaEst" id="vigenciaestm">
<input type="text" class="form-control "  hidden disabled readonly id="sistemam" disabled readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresam" disabled readonly value="<?echo $row['ID_H_O_D']?>">
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
  

  function TipoVigenciaMarcas() {


/* Para obtener el texto */
var combo = document.getElementById("vigenciamarcas");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestm").val(selected);
}


$(function() {
  
    
$("#vigenciamarcas").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #2BBB1D !important;":
        $("#SiVigenteMarcas").show();
                        
                        $("#NoVigenteMarcas").hide();
                        $("#QuizasproximoMarcas").hide();    
     
      break;

    case "background-color: #828681  !important;":
        $("#NoVigenteMarcas").show();

        $("#SiVigenteMarcas").hide();
        $("#QuizasproximoMarcas").hide();    
     
      
      break;
      case "background-color: #ff6c0c !important;":
        $("#QuizasproximoMarcas").show();    
        $("#NoVigenteMarcas").hide();
        $("#SiVigenteMarcas").hide();
       
     
      
      break;
      case "":
        $("#NoVigenteMarcas").hide();
        $("#QuizasproximoMarcas").hide();    
        $("#SiVigenteMarcas").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOculto3 {
			display: none;
		}
</style>