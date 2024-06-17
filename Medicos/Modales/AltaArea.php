
  
      <div class="modal fade bd-example-modal-xl" id="AltaAreasCreditos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nuevo área de crédito <i class="fas fa-credit-card"></i></p>

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
     
 <form action="javascript:void(0)" method="post" id="AgregaAreCreditos">
    
 
    
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly maxlength="60">
    </div>
    
    
      
    <label for="exampleFormControlInput1">Nombre de área <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreArea" id="nombrearea" placeholder="Por ejemplo: Antibiotico" aria-describedby="basic-addon1" maxlength="60">            
</div>
<div><label for="nombrecredito" class="error">
</div>
<label for="exampleFormControlInput1">Vigencia <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <select name="VigenciaArea" class="form-control" id="vigenciaarea" onchange="TipoVigenciaArea();">
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
     <button id="SiVigenteArea" class="divOcultoAreaCred btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="QuizasproximoArea" class="divOcultoAreaCred btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
<input type="text" class="form-control " hidden  readonly name="UsuarioArea" id="usuarioarea"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text"  class="form-control " hidden  readonly name="VigenciaEstArea" id="vigenciaestarea">
<input type="text" class="form-control "  hidden  readonly id="sistemaarea" name="SistemaArea" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresaarea" name="EmpresaArea" readonly value="<?echo $row['ID_H_O_D']?>">
  <div>
   
      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  <script type="text/javascript">
  

  function TipoVigenciaArea() {


/* Para obtener el texto */
var combo = document.getElementById("vigenciaarea");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestarea").val(selected);
}


$(function() {
  
    
$("#vigenciaarea").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigenteArea").show();
                        
                    
                        $("#QuizasproximoArea").hide();    
     
      break;

      case "background-color:#ff6c0c!important;":
        $("#QuizasproximoArea").show();    
    
        $("#SiVigenteArea").hide();
       
     
      
      break;
      case "":
    
        $("#QuizasproximoArea").hide();    
        $("#SiVigenteArea").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoAreaCred {
			display: none;
		}
</style>