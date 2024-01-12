<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Inventarios_Clinicas.ID_Inv_Clic,Inventarios_Clinicas.Cod_Equipo,Inventarios_Clinicas.Cod_Equipo_Repetido,Inventarios_Clinicas.Cantidad_Mobil,
Inventarios_Clinicas.FK_Tipo_Mob,Inventarios_Clinicas.Nombre_equipo,Inventarios_Clinicas.Descripcion,Inventarios_Clinicas.ID_H_O_D,
Inventarios_Clinicas.Fecha_Ingreso,Inventarios_Clinicas.Estatus,Inventarios_Clinicas.CodigoEstatus,
Tipos_Mobiliarios_POS.Tip_Mob_ID,Tipos_Mobiliarios_POS.Nom_Tip_Mob from Inventarios_Clinicas,Tipos_Mobiliarios_POS 
WHERE Inventarios_Clinicas.FK_Tipo_Mob=Tipos_Mobiliarios_POS.Tip_Mob_ID AND Inventarios_Clinicas.ID_H_O_D ='".$row['ID_H_O_D']."' AND Inventarios_Clinicas.ID_Inv_Clic = ".$_POST["id"];
$query = $conn->query($sql1);
$Mobiliarios = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Mobiliarios=$r;
  break;
}

  }
?>

<? if($Mobiliarios!=null):?>

<form action="javascript:void(0)" method="post" id="AsignaMobiliarioSuc">


<div class="row">
   <div class="col">
   <label for="exampleFormControlInput1">Codigo de barra<span class="text-danger">*</span> </label>
   <div class="input-group mb-3">
 <div class="input-group-prepend">
 <div class="text-center">
 </div>
 <? echo $Mobiliarios->Cod_Equipo; ?> <br>
  <? echo $Mobiliarios->Cod_Equipo_Repetido; ?>
            </div>
   </div>
        </div>
   <div class="col">
<label for="exampleFormControlInput1">Nombre de equipo <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
 <div class="input-group-prepend">
 
   <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar"></i></span>
 </div>
<input type="text" id="nombrequipoas" name="NombreEquipoAS" value="<?php echo $Mobiliarios->Nombre_equipo;?>" readonly class="form-control">
            </div><div><label for="nombrequipoas" class="error">
</div>
</div> </div>
 
<div class="row">
   <div class="col">
   <label for="exampleFormControlInput1">Tipo<span class="text-danger">*</span> </label>
   <div class="input-group mb-3">
 <div class="input-group-prepend">
 
   <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
 </div>
<input type="text" id="tipoas" name="TipoAS" readonly value="<?php echo $Mobiliarios->Nom_Tip_Mob;?>"class="form-control">
            </div>
   </div>
     
   <div class="col">
<label for="exampleFormControlInput1">Sucursal <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
 <div class="input-group-prepend">
 
   <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar"></i></span>
 </div>
 <select id = "sucursalas" class = "form-control" name = "SucursalAS">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
            </div><div><label for="vigencia" class="error">
</div>
</div> </div> 

<div class="row">
   <div class="col">
   <label for="exampleFormControlInput1">Existencia<span class="text-danger">*</span> </label>
   <div class="input-group mb-3">
 <div class="input-group-prepend">
 
   <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
 </div>
<input type="text"  readonly value="<?php echo $Mobiliarios->Cantidad_Mobil;?>"class="form-control">
            </div>
   </div>
     
   <div class="col">
<label for="exampleFormControlInput1">Cantidad asignada <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
 <div class="input-group-prepend">
 
   <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar"></i></span>
 </div>
 <input type="number" class="form-control" name="CanAsi" id="canasi" >
            </div><div><label for="vigencia" class="error">
            <div id="Pasado" style="display: none;">
            <div class="alert alert-danger" role="alert">
  La cantidad asignada no concuerda con la existencia
</div>
</div>

</div>
</div> </div>
<div class="row">
   <div class="col">
   <label for="exampleFormControlInput1">Fecha para envio<span class="text-danger">*</span> </label>
   <div class="input-group mb-3">
 <div class="input-group-prepend">
 
   <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
 </div>
<input type="date" id="fecenvio" name="FecEnvio" class="form-control">
            </div>
   </div>
     
   <div class="col">
<label for="exampleFormControlInput1">Envia <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
 <div class="input-group-prepend">
 
   <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar"></i></span>
 </div>
 <input type="text" class="form-control " readonly id="usuarioenvia" name="UsuarioEnvia" readonly value="<?echo $row['Nombre_Apellidos']?>">
            </div><div><label for="vigencia" class="error">
</div>
</div> </div>
 <input type="text" class="form-control " hidden  readonly id="estadoas" name="EstadoAs" readonly value="En espera de recepcion">
 <input type="text" class="form-control " hidden  readonly id="codestas" name="CodEstadoAs" readonly value="background-color:#17a2b8!important;">
 <input type="text" class="form-control " hidden  readonly id="codigoas" name="CodigoAsignado" readonly value="<? echo $Mobiliarios->Cod_Equipo;?>">
 <input type="text" class="form-control " readonly id="usuarioas" name="UsuarioAS" readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistemamas" name="SistemaAs" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresaas" name="EmpresaAs" readonly value="<?echo $row['ID_H_O_D']?>">
 <div>
  
     <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                       </form>
                                       </div>
                                       </div>
    
   </div>
 </div>
 </div>
 </div>

 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script src="js/AsignaMobiliarios.js"></script>
<script>
$("#canasi").keyup(function(){
		if(parseInt($(this).val()) > <?php echo $Mobiliarios->Cantidad_Mobil;?> ||parseInt($(this).val()) <= 0 ){
      $("#submit_registro").attr("disabled",true);
      $("#Pasado").show() //
      
		}else{
                        $("#submit_registro").attr("disabled",false);
                        $("#Pasado").hide() //
                }

                
	});

  
</script>