<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

include "../Consultas/BBB.php";

$user_id=null;
$sql1= "select * from Data_Pacientes where ID_Data_Paciente = ".$_POST["id"];
$query = $conn->query($sql1);
$datapacientes = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $datapacientes=$r;
  break;
}

  }
?>

<?php if($datapacientes!=null):?>

<form action="javascript:void(0)" method="post" id="ConfPac" >

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio único del paciente <span class="text-danger"> * </span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" disabled class="form-control" value="<?php echo $datapacientes->ID_Data_Paciente; ?>" name="Folio" id="folio" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Nombre del paciente <span class="text-danger"> * </span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Nombre_Paciente; ?>"oninput="actualizarNombre()" readonly name="Nombres" id="nombres" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha de nacimiento <span class="text-danger"> * </span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="date" class="form-control"  onchange="calculaedad()" id="fechaNac" aria-describedby="basic-addon1">
  <label for="fechaNac" class="error">
</div>

    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Edad <span class="text-danger"> * </span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"  name="Edad" oninput="actualizarEdad()" id="edad" aria-describedby="basic-addon1">
</div>
<label for="edad" class="error">
    </div>
   
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Teléfono <span class="text-danger"> * </span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Telefono; ?>"  oninput="actualizarTelefono()" name="Tel" id="tel" aria-describedby="basic-addon1">
</div>
<small>Si el usuario no tiene telefono colocar S/T</small>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Correo <span class="text-danger"> * </span></label>
    
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Correo; ?>" oninput="actualizarCorreo()"name="Correo" id="correo" aria-describedby="basic-addon1">
  
</div>
<small>Si el usuario no tiene correo colocar S/C</small>
    </div>
    </div>
     <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sexo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Sexo; ?>" readonly name="Sexo" id="sexo" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Alergias</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Alergias; ?>" oninput="actualizarAlergias()" name="Alergias" id="alergias" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <input type="hidden" name="id" id="id"value="<?php echo $datapacientes->ID_Data_Paciente; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
                          
</form>
    <!-- INICIA TOMA DE SIGNOS VITALES -->
    <button class="btn btn-info" type="button" data-toggle="collapse" id="datap" data-target="#GeneralPaciente" aria-expanded="false" aria-controls="DatoPaciente">
    Datos paciente
  </button>
    <form action="javascript:void(0)" method="post" id="SignosVitalesCaptura" >
      <!-- DATA GENERAL DEL PACIENTE -->
    <div class="collapse" id="GeneralPaciente">
            <!-- COLLAPSE PACIENTE -->
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio único del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" disabled class="form-control" value="<?php echo $datapacientes->ID_Data_Paciente; ?>" name="Folio2" id="folioo" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Nombre_Paciente; ?>" readonly name="Nombres2" id="nombress" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Edad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"  name="Edad2" id="edadd" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Telefono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Telefono; ?>" name="Tel2" id="tele" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Correo; ?>"  name="Correo2" id="correoo" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Alergias</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<?php echo $datapacientes->Alergias; ?>" h name="Alergias2" id="alergiass" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <!-- FIN DATA COLLAPSE -->
  </div>
    <!-- FIN DATA GENERAL PACIENTE -->
    
 

    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Peso</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control" onchange="calcular()" name="Peso" id="txtPeso" placeholder="Peso en kg,por ejemplo: 88.88" aria-describedby="basic-addon1">  
</div>

    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Talla</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control"  name="Talla" id="txtTalla" onchange="calcular()" placeholder="Talla en CM por ejemplo: 170" aria-describedby="basic-addon1">
</div>
<label for="txtTalla" class="error">
    </div>
  
    </div>
    
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">IMC <small>kg/m2</small></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" readonly placeholder="El calculo se realiza automaticamente" id="imc" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Estatus IMC</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" readonly name="estatusimc" id="estado"  placeholder="Esperando estado" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
			
		
		</div>
	</div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Temperatura <small>°C</small> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control"  name="Temperatura" id="temperatura"placeholder="Por ejemplo: 36.5" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">FC <small>lpm</small> </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control"  name="Fc" id="fc" placeholder="Por ejemplo: 75" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">F.R  <small>rpm</small></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"  name="FR" id="fr" placeholder="Por ejemplo 85"aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">T.A <small>mmHg</small></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
 
  <input type="text" class="form-control" name="TA" id="ta">
<input type="text" class="form-control" name="TA" readonly  value="       /">
  <input type="text" class="form-control" name="TA2" id="ta2">
</div>
    </div>
    </div>

   

    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">SA02 <small>%</small></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"  name="SA02" id="sa02" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">DXTX <small>mg/m2</small></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" value="0" class="form-control"  name="DXTX" id="dxtx" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Motivo de consulta</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" placeholder="Ingresa motivo de consulta" name="Motivo" id="motivo" aria-describedby="basic-addon1">
</div>
<label for="motivo" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Doctor</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
 <select name="Medico" id="medico" onchange="ElDoctor()" class="form-control">
 <option value="">Selecciona un doctor:</option>
        <?php
          $query = $conn -> query ("SELECT Medico_ID,Nombre_Apellidos,Fk_Sucursal,ID_H_O_D,Estatus FROM Personal_Medico where Fk_Sucursal ='".$row['Fk_Sucursal']."' AND Estatus='Vigente' AND ID_H_O_D ='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Medico_ID"].'">'.$valores["Nombre_Apellidos"].'</option>';
          }
        ?> 
    </select>
</div>
<label for="doctor" class="error">
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estado</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="Estado2" class="form-control"id="estado2" onchange="Estado();">
      <option value="">Selecciona un estado:</option>
        <?php
          $query = $conn -> query ("SELECT ID_Estado,Nombre_Estado FROM Estados");
          while ($valores = mysqli_fetch_array($query)) {
     echo '<option value="'.$valores["ID_Estado"].'">'.$valores["Nombre_Estado"].'</option>';
          }
        ?> 
      </select>
</div>
<label for="estado2" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Municipio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="municipio" class="form-control"id="municipio" onchange="Municipio();" disabled = "disabled">
<option value="">Selecciona un municipio</option>
    </select>
</div>
<label for="municipio" class="error">
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Localidad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="localidad" class="form-control"id="localidad" onchange="Localidad();" disabled = "disabled">
<option value="">Selecciona una localidad</option>
    </select>
</div>
<label for="localidad" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Tipo de visita</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" readonly value="Revaloración" name="TipoV" id="tipov" aria-describedby="basic-addon1">
 
</div>
    </div>
    </div>

    <input type="text" class="form-control" value="<?php echo $datapacientes->Sexo; ?>" readonly name="Sexoo" id="sexoo" hidden aria-describedby="basic-addon1">
    <input type="text"  class="form-control" readonly id="turno"  name="Turno" hidden value="<?php echo $Turno?>"  >
    <input type="text" class="form-control" name="visita" id="visita"  value="Primera vez" hidden readonly >
    <input type="text" class="form-control" name="Doctor" id="doctor"   hidden readonly >
    <input type="text" class="form-control" name="estador" id="estador" hidden readonly >
    <input type="text" class="form-control" name="municipior" id="municipior" hidden readonly >
    <input type="text" class="form-control" name="localidadr" id="localidadr"  hidden readonly >
    <input type="text" class="form-control" name="User" id="user"  value="<?php echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="sucursal" id="sucursal"  value="<?php echo $row['Fk_Sucursal']?>" hidden  readonly >
    <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?php echo $row['ID_H_O_D']?>" hidden  readonly >

    
<input type="hidden" name="id" value="<?php echo $datapacientes->ID_Especialista; ?>">
<button type="submit"  name="submit_Sig" id="submit_Sig"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
                          
</form>
</div>


<script src="js/SignoVitalNormal.js"></script>
<script src="js/Confirma.js"></script>
<script src="js/CapturaEldoctor.js"></script>
<script src="js/ObtieneMunicipio2.js"></script>
<script src="js/ObtieneLocalidad.js"></script>
<script src="js/CapturaResidencias.js"></script>
<script src="js/CapturaMunicipio.js"></script>
<script src="js/CapturaLocalidad.js"></script>
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

function calculaedad(){
const esMayor = fechaNac => {
  if(!fechaNac || isNaN(new Date(fechaNac))) return;
  const hoy = new Date();
  const dateNac = new Date(fechaNac);
  if(hoy - dateNac < 0) return;
  const years = hoy.getUTCFullYear() - dateNac.getUTCFullYear();
  
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
  if(suEdad) {
    $('#edadd').val(`${suEdad[0]} año(s), ${suEdad[1]} mes(es) y ${suEdad[2]} día(s).`);
  } else {
    $('#edadd').val('');
  }
});
}


</script>
<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
