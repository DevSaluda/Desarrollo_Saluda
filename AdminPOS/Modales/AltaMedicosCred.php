
  
      <div class="modal fade bd-example-modal-xl" id="AltaMedicosCreditos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nuevo medico <i class="fas fa-credit-card"></i></p>

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
     
 <form action="javascript:void(0)" method="post" id="AgregaMedCreditos">
    
 
    
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly maxlength="60">
    </div>
    
    
      
    <label for="exampleFormControlInput1">Nombre de Médico <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreMedico" id="nombremedico" placeholder="Por ejemplo: Antibiotico" aria-describedby="basic-addon1" maxlength="60">            
</div>
<div><label for="nombrecredito" class="error">
</div>
<label for="exampleFormControlInput1">Vigencia <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <select name="VigenciaMedico" class="form-control" id="vigenciamedico" onchange="TipoVigenciaMedico();">
                   <option value="">Elige un estatus</option>
                    
				
              <option  value="background-color:#2BBB1D!important;">Vigente</option>							  	
              <option  value="background-color:#ff6c0c!important;">Próximamente</option>						  				  
             </select>
             </div><div><label for="vigencia" class="error">
</div>
    
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #00c851 !important;">Estatus de credito</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
     <button id="SiVigenteMedico" class="divOcultoMedicoCred btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="QuizasproximoMed" class="divOcultoMedicoCred btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
<input type="text" class="form-control " hidden  readonly name="UsuarioMedico" id="usuariomedico"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text"  class="form-control " hidden  readonly name="VigenciaEstMedico" id="vigenciaestmedico">
<input type="text" class="form-control "  hidden  readonly id="sistemamedico" name="SistemaMedico" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresamedico" name="EmpresaMedico" readonly value="<?echo $row['ID_H_O_D']?>">
  <div>
   
      <button type="submit"  id="submit_registromedico" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  <script type="text/javascript">
  

  function TipoVigenciaMedico() {


/* Para obtener el texto */
var combo = document.getElementById("vigenciamedico");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestmedico").val(selected);
}


$(function() {
  
    
$("#vigenciamedico").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigenteMedico").show();
                        
                    
                        $("#QuizasproximoMed").hide();    
     
      break;

      case "background-color:#ff6c0c!important;":
        $("#QuizasproximoMed").show();    
    
        $("#SiVigenteMedico").hide();
       
     
      
      break;
      case "":
    
        $("#QuizasproximoMed").hide();    
        $("#SiVigenteMedico").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoMedicoCred {
			display: none;
		}
</style>