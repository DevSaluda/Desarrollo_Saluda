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

<form action="javascript:void(0)" method="post" id="ActualizaProveedores" >
  <label for=""> <h3> Datos generales del empleado</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de empleado </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<? echo $Especialistas->ID_Proveedor; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre proveedor<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="ActNombresPro" id="actnombrespro" value="<? echo $Especialistas->Nombre_Proveedor; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">RFC </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " id="actrfc" name="ActRFC" value="<? echo $Especialistas->Rfc_Prov; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Telefono <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="number" class="form-control " name="AcTtelefonoPro" id="acttelefonopro" value="<? echo $Especialistas->Numero_Contacto; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Correo </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  id="actcorreopro" name="ActCorreoPro" value="<? echo $Especialistas->Correo_Electronico;?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Clave adicional <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="ActPassPro" id="actpasspro" value="<? echo $Especialistas->Clave_Proveedor; ?>" aria-describedby="basic-addon1" >            
</div></div></div>
<label for=""> <h3>Vigencia del proveedor</h3></label>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Vigencia actual </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="VigenciaPro" class="form-control" id="vigencia" onchange="TipoVigencia();">
                 
                    
                   <option  value="<? echo $Especialistas->CodigoEstatus; ?>"><? echo $Especialistas->Estatus; ?></option>		
              <option  value="background-color:#2BBB1D!important;">Alta</option>		
              <option  value="background-color:#FE0000!important;">Baja</option>						  	
            				  				  
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
<button id="VigenciaBD" class="btn btn-default btn-sm" style=<? echo $Especialistas->CodigoEstatus; ?>><? echo $Especialistas->Estatus; ?></button> 
     <button id="SiVigente" class="divOculto btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</button> 
      <button id="NoVigente" class="divOculto btn btn-default btn-sm" style="background-color:#FE0000!important;">Baja</button>
      <button id="Quizasproximo" class="divOculto btn btn-default btn-sm" style="background-color: #ECB442 !important;">Capacitación</button></td>
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    <input type="text"  class="form-control "  hidden readonly name="VigenciaEst" id="vigenciaest">
    <input type="text" class="form-control " hidden  readonly id="actusuariop" name="ActUsuarioP" readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="actsistemap" name="ActSistemaP" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="hidden" name="ID_Provvedor" id="id" value="<?php echo $Especialistas->ID_Proveedor; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaProveedores.js"></script>

<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script type="text/javascript">
  

  function TipoVigencia() {


/* Para obtener el texto */
var combo = document.getElementById("vigencia");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaest").val(selected);
}


$(function() {
  
    
$("#vigencia").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigente").show();
                        
                        $("#NoVigente").hide();
                        $("#Quizasproximo").hide();   
                        $("#VigenciaBD").hide(); 
     
      break;

    case "background-color:#FE0000!important;":
        $("#NoVigente").show();

        $("#SiVigente").hide();
        $("#Quizasproximo").hide();    
        $("#VigenciaBD").hide();
      
      break;
      case "background-color: #ECB442 !important;":
        $("#Quizasproximo").show();    
        $("#NoVigente").hide();
        $("#SiVigente").hide();
        $("#VigenciaBD").hide();
     
      
      break;
      case "":
        $("#NoVigente").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigente").hide();
        $("#VigenciaBD").hide();
        
     
      
      break;
      case "<? echo $Especialistas->CodigoEstatus; ?>":
  
        $("#VigenciaBD").show();
        $("#NoVigente").hide();
        $("#Quizasproximo").hide();    
        $("#SiVigente").hide();
       
     
      
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