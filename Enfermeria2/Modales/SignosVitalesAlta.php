<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
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

<? if($datapacientes!=null):?>
  
  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#InfoPaciente" aria-expanded="false" aria-controls="DatoPaciente">
    Datos paciente
  </button>
<form  method="post" id="AltaSigVN" >
<div class="collapse" id="InfoPaciente">
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio único del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" disabled class="form-control" value="<? echo $datapacientes->ID_Data_Paciente; ?>" name="Folio" id="folio" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Nombre del paciente</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $datapacientes->Nombre_Paciente; ?>" disabled name="Nombres" id="nombres" aria-describedby="basic-addon1">
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
  <input type="text" class="form-control" value="<? echo $datapacientes->Edad; ?>" disabled name="Edad" id="edad" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sexo</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control" value="<? echo $datapacientes->Sexo; ?>" disabled name="Sexo" id="sexo" aria-describedby="basic-addon1">
</div>
    </div>
    </div>
    </div>
 <!-- FINALIZAN DATTOS DEL PACIENTE  -->

 <!-- INICIA TOMA DE SIGNOS VITALES -->
     <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Peso</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" class="form-control" onchange="calcular()" name="Peso" id="txtPeso" placeholder="Peso en kg,por ejemplo: 88.88" aria-describedby="basic-addon1">  
</div>
<label for="txtPeso" class="error">
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
  <input type="text" class="form-control"  placeholder="El calculo se realiza automaticamente" id="imc" aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Estatus IMC</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="text" class="form-control"  name="estatusimc" id="estado"  placeholder="Esperando estado" aria-describedby="basic-addon1">
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
  <input type="text" class="form-control"  name="DXTX" id="dxtx" aria-describedby="basic-addon1">
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
        <?
          $query = $conn -> query ("SELECT Medico_ID,Nombre_Apellidos,Fk_Sucursal,ID_H_O_D FROM Personal_Medico where Fk_Sucursal ='".$row['Fk_Sucursal']."' AND ID_H_O_D ='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Medico_ID].'">'.$valores[Nombre_Apellidos].'</option>';
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
        <?
          $query = $conn -> query ("SELECT ID_Estado,Nombre_Estado FROM Estados");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_Estado].'">'.$valores[Nombre_Estado].'</option>';
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
    <label for="exampleFormControlInput1">Primera visita</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <select name="TipoV" id="tipov" class="form-control">
                                               <option value="">Seleccione:</option>
                                               <option value="Recomendacion de un amigo/familiar">Recomendacion de un amigo/familiar</option>
                                               <option value="Redes sociales">Redes sociales</option>
                    
                                               <option value="Material impreso">Material impreso </option>
                                               <option value="Perifonista ">Perifonista </option>
       </select>
</div>
    </div>
    </div>



    <input type="text" class="form-control" name="visita" id="visita"  value="Primera vez" hidden readonly >
    <input type="text" class="form-control" name="estador" id="estador" hidden readonly >
    <input type="text" class="form-control" name="municipior" id="municipior" hidden readonly >
    <input type="text" class="form-control" name="localidadr" id="localidadr"  hidden readonly >
     <input type="text" class="form-control" name="Doctor" id="doctor"   hidden readonly >
    <input type="text" class="form-control" name="User" id="user"  value="<?echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="sucursal" id="sucursal"  value="<?echo $row['Fk_Sucursal']?>" hidden  readonly >
    <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?echo $row['ID_H_O_D']?>" hidden  readonly >
    <input type="text"  class="form-control" readonly id="turno" hidden name="Turno"  value="<?echo $Turno?>"  >
    <input type="text" class="form-control" value="<? echo $datapacientes->Telefono; ?>" hidden name="Tel" id="tel" aria-describedby="basic-addon1">
  <input type="text" class="form-control" value="<? echo $datapacientes->Correo; ?>" hidden name="Correo" id="correo" aria-describedby="basic-addon1">
  <input type="text" class="form-control" value="<? echo $datapacientes->Alergias; ?>" hidden name="Alergias" id="alergias" aria-describedby="basic-addon1">
<input type="hidden" name="id" value="<?php echo $datapacientes->ID_Especialista; ?>">
<button type="submit"  name="submit" id="submit"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
                          
</form>
</div>
<script src="js/CalculaIMC.js"></script>
<script src="js/CapturaEldoctor.js"></script>
<script src="js/ObtieneMunicipio2.js"></script>
<script src="js/ObtieneLocalidad.js"></script>
<script src="js/CapturaResidencias.js"></script>
<script src="js/CapturaMunicipio.js"></script>
<script src="js/CapturaLocalidad.js"></script>
<script src="js/SignoVitalAlta.js"></script>
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>