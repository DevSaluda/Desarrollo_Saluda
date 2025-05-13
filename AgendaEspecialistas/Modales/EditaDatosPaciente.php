<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";

$user_id=null;
$sql1= "SELECT * FROM Data_Pacientes WHERE ID_Data_Paciente = ".$_POST["id"];
$query = $conn->query($sql1);
$datapacientes = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $datapacientes=$r;
  break;
}

  }
?>

<? if($datapacientes!=null):?>
 
<form action="javascript:void(0)" method="post" id="ActualizaPaciente" >

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio único del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" disabled class="form-control" value="<? echo $datapacientes->ID_Data_Paciente; ?>" readonly  aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $datapacientes->Nombre_Paciente; ?>"  name="ActNombres" id="actnombres" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
   
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha de nacimiento</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="date" class="form-control"  value="<? echo $datapacientes->Fecha_Nacimiento; ?>" onchange="calculaedad()" name="Fecha" id="fechaNac" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Edad</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"  value="<? echo $datapacientes->Edad; ?>" name="Edad" readonly  id="edad" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Teléfono</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $datapacientes->Telefono; ?>"   name="ActTel" id="acttel" aria-describedby="basic-addon1">
</div>

    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Correo</label>
    
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $datapacientes->Correo; ?>"  name="ActCorreo" id="actcorreo" aria-describedby="basic-addon1">
  
</div>

    </div>
    </div>
     <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sexo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $datapacientes->Sexo; ?>" readonly name="Sexo" id="sexo" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Alergias</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $datapacientes->Alergias; ?>"  name="ActAlergias" id="actalergias" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    </div>

<!-- INICIA DATA DE AGENDA -->

    </div>
<!-- FINALIZA DATA DE AGENDA -->
 

    <input type="text" class="form-control" name="Usuario" id="usuario"  value="<?echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="Sistema" id="sistema"  value="Agenda de citas" hidden  readonly >
    <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?echo $row['ID_H_O_D']?>" hidden  readonly >
    <input type="hidden" name="id" id="id" value="<?php echo  $datapacientes->ID_Data_Paciente; ?>">
    
<button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
                          
</form>
</div>


<script src="js/ActualizaPaciente.js"></script>



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
    $('#edad').val(`${suEdad[0]} año(s), ${suEdad[1]} mes(es) y ${suEdad[2]} día(s).`);
  } else {
    $('#edad').val('');
  }
});
}


</script>
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
