<!-- Central Modal Medium Info -->
<div class="modal fade" id="AltaFondo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Asignación de fondo de caja</p>

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
         <form id="AgregaFondos">
  <div class="form-group">
  <label for="exampleFormControlInput1">Folio de empleado <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled >
    </div>
    
  </div>
  <div class="form-group">
     <label for="exampleFormControlInput1">Sucursal <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal">
                  
                                              <option value="">Seleccione una Sucursal:</option>
                                              <option value="18">Akil</option>
                                              <option value="24">Capacitación</option>
                                              <option value="21">CEDIS</option>
                                              <option value="23">CEDIS(Partner)</option>
                                              <option value="25">Itzincab</option>
                                              <option value="3">Izamal</option>
                                              <option value="19">Kanasín</option>
                                              <option value="4">Mama</option>
                                              <option value="5">Mani</option>
                                              <option value="20">Motul</option>
                                              <option value="15">Oficinas</option>
                                              <option value="6">Oxkutzcab</option>
                                              <option value="7">Peto</option>
                                              <option value="8">Teabo</option>
                                              <option value="22">Teabo Clínica</option>
                                              <option value="9">Tekax</option>
                                              <option value="10">Tekit</option>
                                              <option value="11">Ticul</option>
                                              <option value="12">Tixkokob</option>
                                              <option value="13">Uman</option>

        </select>   
</div><label for="nombres" class="error">
    </div>
     <div class="form-group">
  <label for="exampleFormControlInput1">Cantidad de fondo de caja <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="number" class="form-control " id="cantidad" name="Cantidad" >
    </div>
    <label for="nombres" class="error">
  </div>

  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus de asignacion </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="Vigencia" class="form-control" id="vigencia" onchange="TipoVigencia();">
                 
                    
  <option  value="">Elija un estatus</option>   
              <option  value="background-color: #2BBB1D !important;">Asignado</option>    
                  
              <option  value="background-color: #ECB442 !important;">Pendiente</option>                       
             </select>
    </div><label for="vigencia" class="error">
    </div>
    <div class="col">
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus del fondo</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>

     <button id="SiVigente" class="divOculto btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Asignado</button> 
    
      <button id="Quizasproximo" class="divOculto btn btn-default btn-sm" style="background-color: #ECB442 !important;">Pendiente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>

      <input type="text"  class="form-control "  hidden readonly name="EstadoAsignacion" id="estadoasignacion">
  <input type="text" class="form-control"  name="Empresa" id="empresa" hidden readonly value="<?echo $row['ID_H_O_D']?>">
    <input type="text" class="form-control"  name="Agrega" id="agrega" hidden readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  name="Sistema" id="sistema" hidden readonly value=" POS <?echo $row['Nombre_rol']?>">
    
  <button type="submit"  name="submit_registro" id="submit_registro"  value="Guardar" class="btn btn-success">Asignar <i class="fas fa-save"></i></button>
</form>
           
</div>


    </div>



   
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
$("#estadoasignacion").val(selected);
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