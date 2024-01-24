<?php
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";

$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Cajas_POS.ID_Caja,Cajas_POS.Empleado,Cajas_POS.Sucursal,Cajas_POS.Turno,Cajas_POS.Asignacion,
Cajas_POS.Valor_Total_Caja,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal from Cajas_POS,SucursalesCorre 
where Cajas_POS.Sucursal= SucursalesCorre.ID_SucursalC AND Cajas_POS.ID_Caja= ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
  $hora = date('G');
?>

<?php if($Especialistas!=null):?>

<form action="javascript:void(0)" method="post" id="AsignacionCaja" >
<div class="form-group">
    <label for="exampleFormControlInput1">Empleado<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
  </div>
  <input type="text" class="form-control " readonly   value="<?php echo $Especialistas->Empleado; ?>" aria-describedby="basic-addon1" >            
</div></div>

<div class="form-group">
    <label for="exampleFormControlInput1">Sucursal </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Nombre_Sucursal; ?>" aria-describedby="basic-addon1" >       
        
    </div>

    <div class="form-group">
    <label for="exampleFormControlInput1">Turno</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $Especialistas->Turno; ?>" aria-describedby="basic-addon1" >       
        
    </div>
    

  

    <!-- INICIA CONTADOR DINERO -->
    <input type="text"  hidden name="IDdeCajaAsignada" value="<?php echo $Especialistas->ID_Caja; ?>">


 <input type="text"  hidden name="SistemaCajaa" value="POS <?php echo $row['Nombre_rol']?>">
 <button type="submit"  id="cambialacaja"  class="btn btn-success">Asignar caja <i class="fas fa-exchange-alt"></i></button>                 
</form>



<script src="js/AsignaCaja.js"></script>

<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>
 



      
   