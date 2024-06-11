<div class="modal fade bd-example-modal-xl" id="AltadeTiposConsultas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nuevo tipo de consulta</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
        <i class="fas fa-info-circle"></i> <span class="text-semibold"><?echo $row['Nombre_Apellidos']?>, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
     
 <form action="javascript:void(0)" method="post" id="AgregaTipoConsultaNueva">
    
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">  
        <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <input type="text" class="form-control "  readonly maxlength="60">
    </div>
    
    <label for="exampleFormControlInput1">Nombre de tipo de consulta<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
      </div>
      <input type="text" class="form-control " name="NombreTipoConsulta" id="nombretipoconsulta" placeholder="Por ejemplo: Antibiotico" aria-describedby="basic-addon1" maxlength="60">            
    </div>
    <div><label for="nombretipoconsulta" class="error"></div>

    <label for="exampleFormControlInput1">Vigencia <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
      </div>
      <select name="VigenciaTipoConsulta" class="form-control" id="vigenciatipoconsulta" onchange="TipoVigenciaConsulta();">
        <option value="">Elige un estatus</option>
        <option value="background-color: #2BBB1D !important;">Vigente</option>								  	
        <option value="background-color: #ff6c0c !important;">Próximamente</option>						  				  
      </select>
    </div>
    <div><label for="vigencia" class="error"></div>
    
    <div class="table-responsive">
      <table class="table table-bordered">
      <thead>
        <tr>
           <th scope="col" style="background-color: #00c851 !important;">Estatus de tipo de consulta</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>
             <button id="SiVigenteTipoConsulta" class="divOcultoTipoConsulta btn btn-default btn-sm" style="background-color: #2BBB1D !important;">Vigente</button> 
              <button id="NoVigenteTipoConsulta" class="divOcultoTipoConsulta btn btn-default btn-sm" style="background-color: #828681  !important;">Descontinuado</button>
              <button id="QuizasproximoTipoConsulta" class="divOcultoTipoConsulta btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button>
          </td>
        </tr>
      </tbody>
      </table>
    </div>
    <input type="text" class="form-control " hidden  readonly id="usuario" name="UsuarioTipoConsulta" readonly value="<?echo $row['Nombre_Apellidos']?>">
    <input type="text"  class="form-control " hidden  readonly name="VigenciaTipoConsulta" id="vigenciaestTipoConsulta">
    <input type="text" class="form-control "  hidden  readonly id="sistema" name="SistemaTipoConsulta" readonly value="POS <?echo $row['Nombre_rol']?>">
    <input type="text" class="form-control "  hidden id="empresa" name="EmpresaTipoConsulta" readonly value="<?echo $row['ID_H_O_D']?>">
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
function TipoVigenciaConsulta() {
  var combo = document.getElementById("vigenciatipoconsulta");
  var selected = combo.options[combo.selectedIndex].text;
  $("#vigenciaestTipoConsulta").val(selected);
}

$(function() {
  $("#vigenciatipoconsulta").on('change', function() {
    var selectValue = $(this).val();
    switch (selectValue) {
      case "background-color: #2BBB1D !important;":
        $("#SiVigenteTipoConsulta").show();
        $("#NoVigenteTipoConsulta").hide();
        $("#QuizasproximoTipoConsulta").hide();    
        break;
      case "background-color: #828681  !important;":
        $("#NoVigenteTipoConsulta").show();
        $("#SiVigenteTipoConsulta").hide();
        $("#QuizasproximoTipoConsulta").hide();    
        break;
      case "background-color: #ff6c0c !important;":
        $("#QuizasproximoTipoConsulta").show();
        $("#NoVigenteTipoConsulta").hide();
        $("#SiVigenteTipoConsulta").hide();
        break;
      case "":
        $("#NoVigenteTipoConsulta").hide();
        $("#QuizasproximoTipoConsulta").hide();
        $("#SiVigenteTipoConsulta").hide();
        break;
    }
  }).change();
});
</script>

<style>
.divOcultoTipoConsulta {
  display: none;
}
</style>
