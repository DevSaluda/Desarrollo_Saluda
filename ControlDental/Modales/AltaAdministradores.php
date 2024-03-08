<!-- Central Modal Medium Info -->
<div class="modal fade" id="AltaEmpleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
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
         <form enctype="multipart/form-data" id="AgregaEmpleados">
         <label for="exampleFormControlInput1"><h2>Datos personales</h2></label>
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
      
    <label for="exampleFormControlInput1">Nombre y apellidos <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-user"></i></span>
  </div>
  <input type="text" class="form-control " name="nombres" id="nombres"  aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha de nacimiento <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-alt"></i></span>
  </div>
  <input type="date" class="form-control " id="fecha" name="fecha">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Telefono </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="number" class="form-control"  id="telefono" name="telefono"aria-describedby="basic-addon1" >            
</div></div></div>
<label for=""> <h3> Datos del empleado para el uso del sistema</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " id="correo" name="correo" >
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Contraseña <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-unlock-alt"></i></span>
  </div>
  <input type="text" class="form-control " name="password" id="password"  aria-describedby="basic-addon1" >            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "sucursal">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
         
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Foto de perfil <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="file" class="form-control " name="file" id="file" aria-describedby="basic-addon1" >            
</div></div></div>
<label for=""> <h3>Vigencia del empleado</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus del empleado </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="vigencia" class="form-control" id="vigencia" onchange="TipoVigencia();">
                 
                    
  <option  value="">Elija un estatus</option>		
              <option  value="background-color: #2BBB1D !important;">Vigente</option>		
            	  	
              <option  value="background-color: #ECB442 !important;">Capacitación</option>						  				  
             </select>
    </div>
    </div>
    <div class="col">
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus del empleado</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>

     <button id="SiVigente" class="divOculto btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
    
      <button id="Quizasproximo" class="divOculto btn btn-default btn-sm" style="background-color: #ECB442 !important;">Capacitación</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>


    <input type="number" class="form-control" name="usuario" id="usuario"hidden readonly value="6">
    <input type="text"  class="form-control "  hidden readonly name="VigenciaInicio" id="vigenciainicio">
    <input type="text" class="form-control"  name="empresa" id="empresa" hidden readonly value="<?echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control"  name="agrega" id="agrega" hidden readonly value=" <?echo $row['Nombre_Apellidos']?>">
    
   

  

       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
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