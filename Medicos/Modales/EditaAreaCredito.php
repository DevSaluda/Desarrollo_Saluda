<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$user_id=null;
$sql1= "SELECT * FROM `Areas_Credit_POS` WHERE ID_H_O_D='".$row['ID_H_O_D']."' AND ID_Area_Cred = ".$_POST["id"];
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

<form action="javascript:void(0)" method="post" id="EditaAreaCreditos" >
<div class="form-group">
    <label for="exampleFormControlInput1">Folio de área </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled readonly value="<?php echo $Especialistas->ID_Area_Cred; ?>">
    </div>
    </div>
    
   
    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre área<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control "  name="ActAreaN" id="actarean" value="<?php echo $Especialistas->Nombre_Area; ?>" aria-describedby="basic-addon1" maxlength="60">            
</div></div></div>



<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Estatus </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <select name="ActVigenciaArea" class="form-control" id="actvigenciaarea" onchange="ActTipoVigenciaAreas();">
                 
                    
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
<button id="VigenciaBD" class="btn btn-default btn-sm" style=<?php echo $Especialistas->CodigoEstatus; ?>><?php echo $Especialistas->Estatus; ?></button> 
     <button id="SiVigenteAcTArea" class="divOcultoActArea btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</button> 
      <button id="NoVigenteActArea" class="divOcultoActArea btn btn-default btn-sm" style="background-color:#FE0000!important;">Descontinuado</button>
    
    </tr>
    
  
  </tbody>
</table>
</div>           
  </div></div>
    </div>
    
<input type="text" class="form-control " hidden  readonly name="UsuarioActArea" id="usuarioactarea"  readonly value="<?php echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistemaactarea" name="SistemaActArea" readonly value="POS <?php echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresaactarea" name="EmpresaActArea" readonly value="<?php echo $row['ID_H_O_D']?>">
    <input type="text"  class="form-control " hidden readonly name="VigenciaEstActArea" id="vigenciaestactarea">
<input type="hidden" name="id_ActArea" id="id_actarea" value="<?php echo $Especialistas->ID_Area_Cred; ?>">
<button type="submit"  id="submit"  class="btn btn-info">Aplicar cambios <i class="fas fa-check"></i></button>
                          
</form>
<script src="js/ActualizaAreaCreditos.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
<script type="text/javascript">
  

  function ActTipoVigenciaAreas() {


/* Para obtener el texto */
var combo = document.getElementById("actvigenciaarea");
var selected = combo.options[combo.selectedIndex].text;
$("#vigenciaestactarea").val(selected);
}


$(function() {
  
    
$("#actvigenciaarea").on('change', function() {

  var selectValue = $(this).val();
  switch (selectValue) {

    case "background-color:#2BBB1D!important;":
        $("#SiVigenteAcTArea").show();
                        
                        $("#NoVigenteActArea").hide();
                       ;   
                        $("#VigenciaBD").hide(); 
     
      break;

    case "background-color:#FE0000!important;":
        $("#NoVigenteActArea").show();

        $("#SiVigenteAcTArea").hide();
       ;    
        $("#VigenciaBD").hide();
      
      break;
      case "background-color: #ECB442 !important;":
        $("#Quizasproximo").show();    
        $("#NoVigenteActArea").hide();
        $("#SiVigenteAcTArea").hide();
        $("#VigenciaBD").hide();
     
      
      break;
      case "":
        $("#NoVigenteActArea").hide();
       ;    
        $("#SiVigenteAcTArea").hide();
        $("#VigenciaBD").hide();
        
     
      
      break;
      case "<?php echo $Especialistas->CodigoEstatus; ?>":
  
        $("#VigenciaBD").show();
        $("#NoVigenteActArea").hide();
       ;    
        $("#SiVigenteAcTArea").hide();
       
     
      
      break;

    

  }
 
}).change();

});

</script>

<style>
    			.divOcultoActArea {
			display: none;
		}
</style>