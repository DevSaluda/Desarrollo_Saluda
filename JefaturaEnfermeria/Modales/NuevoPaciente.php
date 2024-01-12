<div class="modal fade bd-example-modal-xl" id="AltaDePacientes" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-notify modal-success">
    <div class="modal-content">
    

    <div class="modal-header">
         <p class="heading lead">Alta de paciente</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
        <div class="modal-body">
         <div class="text-center">
 
 <form action="javascript:void(0)" method="post" id="PacientesNuevos">
 <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly maxlength="60">
    </div>
    </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre del paciente <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="NombreP" id="nombrep" placeholder="Por ejemplo : Luis Manuel" aria-describedby="basic-addon1" maxlength="60">            
</div>
<label for="nombrep" class="error">
    </div>
    </div>
    <!-- FECHA DE NACIMIENTO -->
    <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha de nacimiento </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
  </div>
  <input id="fechaNac" type="date" class="form-control">
    </div>
  
    </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Edad </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
  </div>
  <input type="text" class="form-control " id="edad" type="text" size="30" maxlength="60">            
</div>
<p id="salida">
    </div>
    </div>
 
    <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Sexo <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-venus-mars"></i></span>
  </div>
  <select name="Sexo" id="sexo" class="form-control">
    <option value="">Elige una opción</option>
    <option value="Masculino">Masculino</option>
    <option value="Femenino">Femenino</option>
  </select>
 
    </div>
    <label for="sexo" class="error">
    </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Alergias <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-allergies"></i></span>
  </div>
  <input type="text" class="form-control " name="Alergias" id="alergias" value="S/A" aria-describedby="basic-addon1" maxlength="60">            
</div>
<small>si el paciente no tiene alergias escribir S/A</small>
<label for="alergias" class="error">
    </div>
    </div>
    <div class="form-row">
    <div class="col">
    <label for="exampleFormControlInput1">Telefono</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile-alt"></i></span>
  </div>
  <input type="text" class="form-control " name="Telefono" id="telefono" value="S/T" aria-describedby="basic-addon1" maxlength="10">            
    </div>
    <small>si el paciente no tiene telefono escribir S/T</small>
    </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Correo </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-envelope"></i></span>
  </div>
  <input type="text" class="form-control " name="Correo" id="correo" value="S/C" aria-describedby="basic-addon1" maxlength="50">            
</div>
<small>si el paciente no tiene correo escribir S/C</small>
    </div>
    </div>
  
  
  <input type="text" class="form-control" id="empresa" name="Empresa" hidden  readonly value="<? echo $row['ID_H_O_D']?>" >
  <input type="text" class="form-control" id="agenda" name="AgendaPor" hidden readonly   value="<?echo $row['Nombre_Apellidos']?>" >
  <input type="text" class="form-control" id="sistema" name="Sistema"  hidden  readonly value="<?echo $row['Nombre_rol']?>" >
  <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                        </form>
     
</form>


    
      <p class="statusMsg"></p>

    
    </div>
  </div>
</div>  </div>
</div></div>  </div>
</div>
<script type="text/javascript">
function ShowSelected()
{

 
/* Para obtener el texto */
var combo = document.getElementById("colorpago");
var selected = combo.options[combo.selectedIndex].text;
$("#estatuspago").val(selected);
}
function ShowSelected2()
{

 
/* Para obtener el texto */
var combo = document.getElementById("colorcita");
var selected = combo.options[combo.selectedIndex].text;
$("#estatuscita").val(selected);
}

const edadLegal = 18;
const esMayor = fechaNac => {
  if(!fechaNac || isNaN(new Date(fechaNac))) return;
  const hoy = new Date();
  const dateNac = new Date(fechaNac);
  if(hoy - dateNac < 0) return;
  const years = hoy.getUTCFullYear() - dateNac.getUTCFullYear();
  if(years < edadLegal) return false;
  if(years > edadLegal) return true;
  const meses = hoy.getUTCMonth() - dateNac.getUTCMonth();
  if(meses < 0) return false;
  if(meses > 0) return true;
  const dias = hoy.getUTCDate() - dateNac.getUTCDate();
  if(dias < 0) return false;
  return true;
}
const edad = fechaNac => {
  if(!fechaNac || isNaN(new Date(fechaNac))) return;
  const hoy = new Date();
  const dateNac = new Date(fechaNac);
  if(hoy - dateNac < 0) return;
  let dias = hoy.getUTCDate() - dateNac.getUTCDate();
  let meses = hoy.getUTCMonth() - dateNac.getUTCMonth();
  let years = hoy.getUTCFullYear() - dateNac.getUTCFullYear();
  if(dias < 0) {
    meses--;
    dias = 30 + dias;
  }
  if(meses < 0) {
    years--;
    meses = 12 + meses;
  }
  
  return [years, meses, dias];
}

$('#fechaNac').change(e => {
  let mayor = esMayor(e.currentTarget.value);
  let suEdad = edad(e.currentTarget.value);
  if(mayor) {
    $('#salida').text(`El paciente es mayor de edad`);
  } else {
    if(mayor === false) {
    $('#salida').text(`el paciente es un menor`);
    } else {
      $('#salida').text('Fecha no válida, verifique');
    }
  }
  if(suEdad) {
    $('#edad').val(`${suEdad[0]} año(s), ${suEdad[1]} mes(es) y ${suEdad[2]} día(s).`);
  } else {
    $('#edad').val('');
  }
});
</script>