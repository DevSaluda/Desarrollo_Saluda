
  
      <div class="modal fade bd-example-modal-xl" id="AltaGastoCat" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nuevo tipo de crédito <i class="fas fa-credit-card"></i></p>

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
     
 <form action="javascript:void(0)" method="post" id="AgregaGastoCatNuevo">
    
 
    
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly maxlength="60">
    </div>
    
    
      
    <label for="exampleFormControlInput1">Nombre de concepto o categoría <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreCategoria" id="nombrecategoria" placeholder="Por ejemplo: Antibiotico" aria-describedby="basic-addon1" maxlength="60">            
</div>

<div><label for="nombrecredito" class="error">
</div>
<label for="exampleFormControlInput1">Vigencia <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-headset"></i></span>
  </div>
  <select name="Vigencia" class="form-control" id="vigencia" onchange="TipoVigencia();">
                   <option value="">Elige un estatus</option>
                    
				
              <option  value="background-color: #2BBB1D !important;">Vigente</option>							  	
              <option  value="background-color: #ff6c0c !important;">Próximamente</option>						  				  
             </select>
             </div><div><label for="vigencia" class="error">
</div>
    
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #00c851 !important;">Vigencia</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
     <button id="SiVigente" class="divOculto btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="NoVigente" class="divOculto btn btn-default btn-sm" style="background-color: #828681  !important;">Descontinuado</button>
      <button id="Quizasproximo" class="divOculto btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
<input type="text" class="form-control " hidden  readonly name="Usuario" id="usuario"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text"  class="form-control " hidden  readonly name="VigenciaEst" id="vigenciaest">
<input type="text" class="form-control "  hidden  readonly id="sistema" name="Sistema" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresa" name="Empresa" readonly value="<?echo $row['ID_H_O_D']?>">
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
  

  function TipoVigencia() {


/* Para obtener el texto */
var combo = document.getElementById("vigencia");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaest").val(selected);
}


$(function() {
  
    
$("#vigencia").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #2BBB1D !important;":
        $("#SiVigente").show();
                        
                        $("#NoVigente").hide();
                        $("#Quizasproximo").hide();    
     
      break;

    case "background-color: #828681  !important;":
        $("#NoVigente").show();

        $("#SiVigente").hide();
        $("#Quizasproximo").hide();    
     
      
      break;
      case "background-color: #ff6c0c !important;":
        $("#Quizasproximo").show();    
        $("#NoVigente").hide();
        $("#SiVigente").hide();
       
     
      
      break;
      case "":
        $("#NoVigente").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigente").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOculto {
			display: none;
		}
</style>