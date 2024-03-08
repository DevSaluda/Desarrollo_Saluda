<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$user_id=null;
$sql1= "SELECT * FROM Presentacion_Prod_POS WHERE ID_H_O_D ='".$row['ID_H_O_D']."' AND Pprod_ID = ".$_POST["id"];
$query = $conn->query($sql1);
$Presentaciones = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Presentaciones=$r;
  break;
}

  }
?>

<?php if($Presentaciones!=null):?>

<form action="javascript:void(0)" method="post" id="ActualizaPresentaciones" >
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Presentaciones->Pprod_ID; ?>">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre de presentación <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="ActNombrepresentacion" id="actnombrepresentacion" value="<?php echo $Presentaciones->Nom_Presentacion; ?>">            
</div></div></div>
    
   
 

    
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Siglas </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " name="ActSiglaspresentacion" id="Actsiglaspresentacion" value="<?php echo $Presentaciones->Siglas; ?>">   
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Estatus </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-info-circle"></i></span>
  </div>
  <select name="ActVigenciaPre" class="form-control" id="actualizavigenciapre" onchange="ActualizaTipoVigenciaPre();">
                 
                    
                   <option  value="<?php echo $Presentaciones->Cod_Estado; ?>"><?php echo $Presentaciones->Estado; ?></option>		
              <option  value="background-color:#2BBB1D!important;">Vigente</option>		
              <option  value="background-color:#828681!important;">Descontinuado</option>						  	
              <option  value="background-color:#ff6c0c!important;">Proximamente</option>						  				  
             </select>
    </div>
          
  </div></div>
    </div>
    <div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus fondo</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
<button id="VigenciaBDPre" class="btn btn-default btn-sm" style=<?php echo $Presentaciones->Cod_Estado; ?>><? echo $Presentaciones->Estado; ?></button> 
     <button id="SiVigentePreAct" class="divOcultoPreAct btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</button> 
      <button id="NoVigentePreAct" class="divOcultoPreAct btn btn-default btn-sm" style="background-color:#828681!important;">Descontinuado</button>
      <button id="QuizasproximoPreAct" class="divOcultoPreAct btn btn-default btn-sm" style="background-color:#ff6c0c!important;">Próximamente</button></td>
    </tr>
    
  
  </tbody>
</table>
</div> 
    <input type="text"  class="form-control " hidden readonly name="ActVigEstP" id="vigenciaPreact">
    <input type="text" class="form-control " hidden  readonly id="actusuariop" name="ActUsuarioP" readonly value="<?php echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="actsistemap" name="ActSistemaP" readonly value="POS <?php echo $row['Nombre_rol']?>">
<input type="hidden" name="Id_Cat_Pre" id="id_pre" value="<?php echo $Presentaciones->Pprod_ID; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaPresentacion.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
<script type="text/javascript">
  

  function ActualizaTipoVigenciaPre() {


/* Para obtener el texto */
var combo = document.getElementById("actualizavigenciapre");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaPreact").val(selected);
}


$(function() {
  
    
$("#actualizavigenciapre").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigentePreAct").show();
                        
                        $("#NoVigentePreAct").hide();
                        $("#QuizasproximoPreAct").hide();   
                        $("#VigenciaBDPre").hide(); 
     
      break;

    case "background-color:#828681!important;":
        $("#NoVigentePreAct").show();

        $("#SiVigentePreAct").hide();
        $("#QuizasproximoPreAct").hide();    
        $("#VigenciaBDPre").hide();
      
      break;
      case "background-color:#ff6c0c!important;":
        $("#QuizasproximoPreAct").show();    
        $("#NoVigentePreAct").hide();
        $("#SiVigentePreAct").hide();
        $("#VigenciaBDPre").hide();
     
      
      break;
      case "":
        $("#NoVigentePreAct").hide();
        $("#QuizasproximoPreAct").hide();    
        $("#SiVigentePreAct").hide();
        $("#VigenciaBDPre").hide();
        
     
      
      break;
      case "<?php echo $Presentaciones->Cod_Estado; ?>":
  
        $("#VigenciaBDPre").show();
        $("#NoVigentePreAct").hide();
        $("#QuizasproximoPreAct").hide();    
        $("#SiVigentePreAct").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoPreAct {
			display: none;
		}
</style>