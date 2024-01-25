
  
      <div class="modal fade bd-example-modal-xl" id="AltadeServicios" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nuevo servicio</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
        <i class="fas fa-info-circle"></i> <span class="text-semibold"><?php echo $row['Nombre_Apellidos']?>, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
     
 <form action="javascript:void(0)" method="post" id="AgregaservicioNueva">
    
 
    
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  readonly maxlength="60">
    </div>
    
    
      
    <label for="exampleFormControlInput1">Nombre de Servicio<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="Nombreservicio" id="nombreservicio" placeholder="Por ejemplo: Antibiotico" aria-describedby="basic-addon1" maxlength="60">            
</div>
<div><label for="nombreservicio" class="error">
</div>
<label for="exampleFormControlInput1">Vigencia <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <select name="VigenciaServicio" class="form-control" id="vigenciaservicio" onchange="TipoVigenciaServicio();">
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
       <th scope="col" style="background-color: #00c851 !important;">Estatus de servicio</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
     <button id="SiVigenteServicio" class="divOcultoServicio btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="NoVigenteServicio" class="divOcultoServicio btn btn-default btn-sm" style="background-color: #828681  !important;">Descontinuado</button>
      <button id="QuizasproximoServicio" class="divOcultoServicio btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
<input type="text" class="form-control " hidden  readonly id="usuario" name="UsuarioServ" readonly value="<?php echo $row['Nombre_Apellidos']?>">
<input type="text"  class="form-control " hidden  readonly name="VigenciaServ" id="vigenciaestServ">
<input type="text" class="form-control "  hidden  readonly id="sistema" name="SistemaServ" readonly value="POS <?php echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresa" name="EmpresaServ" readonly value="<?php echo $row['ID_H_O_D']?>">
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
  

  function TipoVigenciaServicio() {


/* Para obtener el texto */
var combo = document.getElementById("vigenciaservicio");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestServ").val(selected);
}


$(function() {
  
    
$("#vigenciaservicio").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #2BBB1D !important;":
        $("#SiVigenteServicio").show();
                        
                        $("#NoVigenteServicio").hide();
                        $("#QuizasproximoServicio").hide();    
     
      break;

    case "background-color: #828681  !important;":
        $("#NoVigenteServicio").show();

        $("#SiVigenteServicio").hide();
        $("#QuizasproximoServicio").hide();    
     
      
      break;
      case "background-color: #ff6c0c !important;":
        $("#QuizasproximoServicio").show();    
        $("#NoVigenteServicio").hide();
        $("#SiVigenteServicio").hide();
       
     
      
      break;
      case "":
        $("#NoVigenteServicio").hide();
        $("#QuizasproximoServicio").hide();    
        $("#SiVigenteServicio").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoServicio {
			display: none;
		}
</style>