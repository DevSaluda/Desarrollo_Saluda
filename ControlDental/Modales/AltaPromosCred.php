
  
      <div class="modal fade bd-example-modal-xl" id="AltaPromosCreditos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nueva promocion <i class="fas fa-credit-card"></i></p>

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
     
 <form action="javascript:void(0)" method="post" id="AgregaPromoCreditos">
    
 
    
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombre promocion<span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
  </div>
 <input type="text" id="nombrepromo" name="NombrePromo" class="form-control">
             </div>
    </div>
      
    <div class="col">
<label for="exampleFormControlInput1">Cantidad a descontar<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar"></i></span>
  </div>
 <input type="number" id="cantidaddesc" name="CantidadDesc"  class="form-control">
             </div><div><label for="vigencia" class="error">
</div>
</div> </div>



<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Tratamiento<span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
  </div>
  <select id = "tratamiento" class = "form-control" name = "Tratamiento">
                                               <option value="">Seleccione un tratamiento:</option>
        <?
          $query = $conn -> query ("SELECT 	ID_Tip_Cred,Nombre_Tip FROM Tipos_Credit_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Estatus='Vigente'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Tip_Cred].'">'.$valores[Nombre_Tip].'</option>';
          }
        ?>  
             </div>
             </select>
    </div>
      
    <div class="col">
<label for="exampleFormControlInput1">Vigencia<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar"></i></span>
  </div>
  <select name="VigenciaPromo" class="form-control" id="vigenciapromo" onchange="TipoVigenciaPromo();">
                   <option value="">Elige un estatus</option>
                    
				
              <option  value="background-color:#2BBB1D!important;">Vigente</option>							  	
              <option  value="background-color:#ff6c0c!important;">Próximamente</option>						  				  
             </select>
             </div><div><label for="vigencia" class="error">
</div>
</div> </div>
   

    
    
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
     <button id="SiVigentePromo" class="divOcultoPromo btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
      <button id="QuizasproximoPromo" class="divOcultoPromo btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>
<input type="text" class="form-control " hidden  readonly name="UsuarioPromo" id="usuarioPromo"  readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text"  class="form-control " hidden  readonly name="VigenciaEstPromo" id="vigenciaestPromo">
<input type="text" class="form-control "  hidden  readonly id="sistemaPromo" name="SistemaPromo" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresaPromo" name="EmpresaPromo" readonly value="<?echo $row['ID_H_O_D']?>">
  <div>
   
      <button type="submit"  id="submit_registroPromo" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  <script type="text/javascript">
  

  function TipoVigenciaPromo() {


/* Para obtener el texto */
var combo = document.getElementById("vigenciapromo");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestPromo").val(selected);
}


$(function() {
  
    
$("#vigenciapromo").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigentePromo").show();
                        
                    
                        $("#QuizasproximoPromo").hide();    
     
      break;

      case "background-color:#ff6c0c!important;":
        $("#QuizasproximoPromo").show();    
    
        $("#SiVigentePromo").hide();
       
     
      
      break;
      case "":
    
        $("#QuizasproximoPromo").hide();    
        $("#SiVigentePromo").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoPromo {
			display: none;
		}
</style>