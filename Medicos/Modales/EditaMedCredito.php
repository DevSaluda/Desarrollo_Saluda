<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$user_id=null;
$sql1= "SELECT * FROM `Medicos_Credit_POS` WHERE ID_H_O_D='".$row['ID_H_O_D']."' AND ID_Med_Cred = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>

<?php if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="EditaMedCreditos" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio de Medico </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->ID_Med_Cred; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre área<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="ActAreaMed" id="actareamed" value="<?php echo $Especialistas->Nombre_Med; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>



<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="ActVigenciaMedico" class="form-control" id="actvigenciamedico" onchange="ActTipoVigenciaMedicos();">
                 
                    
                   <option  value="<?php echo $Especialistas->CodigoEstatus; ?>"><?php echo $Especialistas->Estatus; ?></option>		
              <option  value="background-color:#2BBB1D!important;">Vigente</option>		
              <option  value="background-color:#FE0000!important;">Descontinuado</option>						  	
              				  				  
             </select>
    </div>
    </div>
    <div class="col">
    
<div class="table-responsive">
  <table class="table table-bordered">
  <thead>
    <tr>
       <th scope="col" style="background-color: #4285f4 !important;">Estatus actual</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
<td>
<button id="VigenciaBDMed" class="btn btn-default btn-sm" style=<?php echo $Especialistas->CodigoEstatus; ?>><?php echo $Especialistas->Estatus; ?></button> 
     <button id="SiVigenteAcTMed" class="divOcultoActMed btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</button> 
      <button id="NoVigenteActMed" class="divOcultoActMed btn btn-default btn-sm" style="background-color:#FE0000!important;">Descontinuado</button>
    
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    
<input type="text" class="form-control " hidden  readonly name="UsuarioActMed" id="usuarioactmed"  readonly value="<?php echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistemaactmed" name="SistemaActMed" readonly value="POS <?php echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresaactmed" name="EmpresaActMed" readonly value="<?php echo $row['ID_H_O_D']?>">
    <input type="text"  class="form-control " hidden readonly name="VigenciaEstActMed" id="vigenciaestactmed">
<input type="hidden" name="id_ActMed" id="id_actamed" value="<?php echo $Especialistas->ID_Med_Cred; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaMedCreditos.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
<script type="text/javascript">
  

  function ActTipoVigenciaMedicos() {


/* Para obtener el texto */
var combo = document.getElementById("actvigenciamedico");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestactmed").val(selected);
}


$(function() {
  
    
$("#actvigenciamedico").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigenteAcTMed").show();
                        
                        $("#NoVigenteActMed").hide();
                       ;   
                        $("#VigenciaBDMed").hide(); 
     
      break;

    case "background-color:#FE0000!important;":
        $("#NoVigenteActMed").show();

        $("#SiVigenteAcTMed").hide();
       ;    
        $("#VigenciaBDMed").hide();
      
      break;
      case "background-color: #ECB442 !important;":
        $("#Quizasproximo").show();    
        $("#NoVigenteActMed").hide();
        $("#SiVigenteAcTMed").hide();
        $("#VigenciaBDMed").hide();
     
      
      break;
      case "":
        $("#NoVigenteActMed").hide();
       ;    
        $("#SiVigenteAcTMed").hide();
        $("#VigenciaBDMed").hide();
        
     
      
      break;
      case "<? echo $Especialistas->CodigoEstatus; ?>":
  
        $("#VigenciaBDMed").show();
        $("#NoVigenteActMed").hide();
       ;    
        $("#SiVigenteAcTMed").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoActMed {
			display: none;
		}
</style>