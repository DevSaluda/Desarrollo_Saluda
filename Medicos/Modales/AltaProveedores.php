<!-- Central Modal Medium Info -->
<div class="modal fade" id="AltaProveedor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-lg modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Alta de nuevo empleado</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <form enctype="multipart/form-data" id="AgregaProveedores">
         <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de empleado <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled >
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre proveedor <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-user"></i></span>
  </div>
  <input type="text" class="form-control " name="Nombres" id="nombres"  aria-describedby="basic-addon1" maxlength="60">            
</div><label for="nombres" class="error"></div>
</div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">RFC <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-alt"></i></span>
  </div>
  <input type="text" class="form-control " id="rfc" name="Rfc">
    </div><label for="rfc" class="error">
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Clave adicional </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control"  id="clav" name="Clav"aria-describedby="basic-addon1" >            
</div><label for="clav" class="error"></div></div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " id="correo" name="Correo" >
    </div><label for="correo" class="error">
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Numero de contacto <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-unlock-alt"></i></span>
  </div>
  <input type="text" class="form-control " name="Contacto" id="contacto"  aria-describedby="basic-addon1" >            
</div><label for="contacto" class="error"></div></div>

<label for=""> <h3>Estatus proveedor</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus del proveedor </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="Vigencia" class="form-control" id="vigencia" onchange="TipoVigencia();">
                 
                    
  <option  value="">Elija un estatus</option>		
              <option  value="background-color: #2BBB1D !important;">Alta</option>		
            	  	
              <option  value="background-color: #ECB442 !important;">Prospecto</option>						  				  
             </select>
    </div><label for="vigencia" class="error">
    </div>
    <div class="col">
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus del proveedor</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>

     <button id="SiVigente" class="divOculto btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Alta</button> 
    
      <button id="Quizasproximo" class="divOculto btn btn-default btn-sm" style="background-color: #ECB442 !important;">Prospecto</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>


    
    <input type="text"  class="form-control "  hidden readonly name="VigenciaInicio" id="vigenciainicio">
    <input type="text" class="form-control"  name="Empresa" id="empresa" hidden readonly value="<?echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control"  name="Agrega" id="agrega" hidden readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  name="Sistema" id="sistema" hidden readonly value=" POS <?echo $row['Nombre_rol']?>">
    
   

  

       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <!-- Central Modal Medium Info-->
 <script type="text/javascript">
  

  function TipoVigencia() {


/* Para obtener el texto */
var combo = document.getElementById("vigencia");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciainicio").val(selected);
}


$(function() {
  
    
$("#vigencia").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color: #2BBB1D !important;":
        $("#SiVigente").show();
                        
                       
                        $("#Quizasproximo").hide();   
                      
     
      break;

   
      case "background-color: #ECB442 !important;":
        $("#Quizasproximo").show();    
      
        $("#SiVigente").hide();
        $("#VigenciaBD").hide();
     
      
      break;
      case "":
        $("#NoVigente").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigente").hide();
        $("#VigenciaBD").hide();
        
     
      
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