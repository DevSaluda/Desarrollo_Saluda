<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT * FROM Proveedores_POS WHERE ID_Proveedor = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<? if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaProspectos" >
  <label for=""> <h3> Datos generales del prospecto</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de prospecto </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->ID_Proveedor; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre prospecto<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="ActNombresPros" id="actnombrespros" value="<? echo $Especialistas->Nombre_Proveedor; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">RFC </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " id="actrfcs" name="ActRFCs" value="<? echo $Especialistas->Rfc_Prov; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Telefono <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control " name="AcTtelefonoPros" id="acttelefonopros" value="<? echo $Especialistas->Numero_Contacto; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  id="actcorreopros" name="ActCorreoPros" value="<? echo $Especialistas->Correo_Electronico;?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Clave adicional <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="ActPassPros" id="actpasspros" value="<? echo $Especialistas->Clave_Proveedor; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<label for=""> <h3>Vigencia del proveedor</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Vigencia actual </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="VigenciaPros" class="form-control" id="vigenciaPros" onchange="TipoVigenciaPros();">
                 
                    
                   <option  value="<? echo $Especialistas->CodigoEstatus; ?>"><? echo $Especialistas->Estatus; ?></option>		
              <option  value="background-color:#2BBB1D!important;">Alta</option>		
             						  	
            				  				  
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
<button id="VigenciaBDPros" class="btn btn-default btn-sm" style=<? echo $Especialistas->CodigoEstatus; ?>><? echo $Especialistas->Estatus; ?></button> 
     <button id="SiVigentePros" class="divOcultoPros btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</button> 
      <button id="QuizasproximoPros" class="divOcultoPros btn btn-default btn-sm" style="background-color: #ECB442 !important;">Prospecto</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    <input type="text"  class="form-control "  hidden readonly name="VigenciaEsts" id="vigenciaestpro">
    <input type="text" class="form-control " hidden  readonly id="actusuariops" name="ActUsuarioPs" readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="actsistemaps" name="ActSistemaPs" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="hidden" name="ID_Prospectos" id="id" value="<?php echo $Especialistas->ID_Proveedor; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Asignar <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaProspectos.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script type="text/javascript">
  

  function TipoVigenciaPros() {


/* Para obtener el texto */
var combo = document.getElementById("vigenciaPros");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestpro").val(selected);
}


$(function() {
  
    
$("#vigenciaPros").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigentePros").show();
                        
                        $("#NoVigente").hide();
                        $("#QuizasproximoPros").hide();   
                        $("#VigenciaBDPros").hide(); 
     
      break;

    case "background-color:#FE0000!important;":
        $("#NoVigente").show();

        $("#SiVigentePros").hide();
        $("#QuizasproximoPros").hide();    
        $("#VigenciaBDPros").hide();
      
      break;
      case "background-color: #ECB442 !important;":
        $("#QuizasproximoPros").show();    
        $("#NoVigente").hide();
        $("#SiVigentePros").hide();
        $("#VigenciaBDPros").hide();
     
      
      break;
      case "":
        $("#NoVigente").hide();
        $("#QuizasproximoPros").hide();    
        $("#SiVigentePros").hide();
        $("#VigenciaBDPros").hide();
        
     
      
      break;
      case "<? echo $Especialistas->CodigoEstatus; ?>":
  
        $("#VigenciaBDPros").show();
        $("#NoVigente").hide();
        $("#QuizasproximoPros").hide();    
        $("#SiVigentePros").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoPros {
			display: none;
		}
</style>