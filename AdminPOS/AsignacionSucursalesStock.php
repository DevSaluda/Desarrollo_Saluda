<?php
 $IdBusqueda=base64_decode($_GET['idProd']);
include "Consultas/Consultas.php";

$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT * FROM Productos_POS WHERE ID_Prod_POS = $IdBusqueda";
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){ 
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>ALMACEN | PRODUCTOS | <?php echo $row['ID_H_O_D']?> </title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 

}
#Tarjeta
{
  background-color: #4285f4 !important;
    color: white;
}
    </style>
</head>
<?php include_once ("Menu.php")?>
<?php if($Especialistas!=null):?>
  <div class="card text-center">
  <div class="card-header" style="background-color:#4285f4!important;color: white;">
 Asignando <?php echo $Especialistas->Nombre_Prod; ?> en sucursales
  </div>
  
  <div class="col-md-6">
  <button type="button" class="btn btn-outline-info btn-sm" onClick="history.go(-1);" class="btn btn-default">
  <i class="fas fa-long-arrow-alt-left fa-lg"></i> Regresar a productos 
</button>
  <div class="text-center">
    <br>
  
<form enctype="multipart/form-data" id="ReasignaProductos">
         <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " id="asignacodbarra" name="AsignaCodBarra" value="<?php echo $Especialistas->Cod_Barra; ?>" >
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Nombre / Descripcion<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " id="asignanombreprod" name="AsignaNombreProd" value="<?php echo $Especialistas->Nombre_Prod; ?>" >          
    </div><label for="nombreprod" class="error">
   </div></div>
   <div class="row">
   <div class="col">
    <label for="exampleFormControlInput1">Sucursal <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <select id = "sucursal" class = "form-control" name = "AsignaSucursal[]" multiple>
                                               <?php
$sql1= "SELECT * FROM Productos_POS WHERE ID_Prod_POS = $IdBusqueda";
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre where ID_SucursalC NOT IN (SELECT Fk_sucursal FROM Stock_POS where ID_Prod_POS='$IdBusqueda')");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
                        ?>
        </select>            
    </div><label for="mine" class="error">
    </div>


   
    <!-- DATA IMPORTANTE -->

    <div class="col">
      
    <label for="exampleFormControlInput1">Lote <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control " id="pv" name="AsLote" value="<?php echo $Especialistas->Lote_Med; ?>" >
</div><label for="pv" class="error"></div></div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " id="aslote" name="AsFecha" value="<?php echo $Especialistas->Fecha_Caducidad; ?>" >
    </div><label for="pc" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Existencia cedis <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " name="ExisteCedis" id="existecedis"  aria-describedby="basic-addon1" value="<?php echo $Especialistas->Stock; ?>" >           
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad asignada<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " name="CanAsigna" id="canasigna"  aria-describedby="basic-addon1"  >           
    </div><label for="maxe" class="error">
    </div>
    </div>
    
   <!-- DATA CAPTURA -->
   <div class="row">
   
    
    
   
 
    

    <div class="col">
      
    <label for="exampleFormControlInput1">Precio venta <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="text" class="form-control " id="aspv" name="ASPV" value="<?php echo $Especialistas->Precio_Venta; ?>" >
</div><label for="pv" class="error"></div>


    <div class="col">
    <label for="exampleFormControlInput1">Precio compra <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " id="aspc" name="ASPC" value="<?php echo $Especialistas->Precio_C; ?>" >
    </div><label for="pc" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Minimo existencia <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " name="ASMinimo" id="asmine"  aria-describedby="basic-addon1" value="<?php echo $Especialistas->Min_Existencia; ?>" >           
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Maximo existencia<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " name="AsMaximo" id="asmaxe"  aria-describedby="basic-addon1" value="<?php echo $Especialistas->Max_Existencia; ?>" >           
    </div><label for="maxe" class="error">
    </div>
    </div>
    
    </div>
   
   
    
   

    <input type="text" hidden name="AsTipo" class="form-control " value="<?php if($Especialistas->Tipo == 0000000000){
   echo "0000000000";
} else {
   echo "$Especialistas->Tipo";
}?>">

<input type="text" hidden name="AsCategoria" class="form-control " value="<?php if($Especialistas->FkCategoria == 0000000000){
   echo "0000000000";
} else {
   echo "$Especialistas->FkCategoria";
}?>">
<input type="text" hidden name="AsMarca" class="form-control " value="<?php if($Especialistas->FkMarca == 0000000000){
   echo "0000000000";
} else {
   echo "$Especialistas->FkMarca";
}?>">

<input type="text" hidden name="AsPresentacion" class="form-control " value="<?php if($Especialistas->FkPresentacion == 0000000000){
   echo "0000000000";
} else {
   echo "$Especialistas->FkPresentacion";
}?>">


<input type="text" class="form-control "  hidden name="ID_Prod" value="<?php echo $Especialistas->ID_Prod_POS; ?>" >
<input type="text" class="form-control " hidden name="TipoServicio" id="tiposervicio"  value="<?php echo $Especialistas->Tipo_Servicio?>"aria-describedby="basic-addon1" >
    <input type="text" class="form-control " hidden name="EmpresaProductos" id="empresa" value="<?php echo  $row['ID_H_O_D']?>"aria-describedby="basic-addon1" >       
    <input type="text" class="form-control " hidden name="RevProvee1" id="revprovee1" value="<?php echo $Especialistas->Proveedor1; ?>"  >   
    <input type="text" class="form-control " hidden name="RevProvee2" id="revprovee2" value="<?php echo $Especialistas->Proveedor2; ?>" >   
    <input type="text" class="form-control"  hidden name="AgregaProductosBy" id="agrega" readonly value=" <?php echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema" readonly value=" POS <?php echo $row['Nombre_rol']?>">
    <input type="text" class="form-control"  hidden name="Vigencia" id="sistema" readonly value="Vigente">
    <input type="text" class="form-control"  hidden name="CodVigencia" id="sistema" readonly value="background-color:#2BBB1D!important;">
    <input type="text" class="form-control " hidden name="ASignaClav" id="asignaclav" value="<?php echo $Especialistas->Clave_adicional; ?>">
  
  <input type="text" class="form-control "  hidden value="<?php echo $fcha;?>"  aria-describedby="basic-addon1"  >           
 
  
    <div class="justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-primary">Asignar <i class="fas fa-tasks"></i></button>
                                        </form>



                                        </div>


</div>
<div class="modal fade" id="Distribucioncorrecta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success" role="document">

    <div class="modal-content text-center">

      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Solicitud Completa</p>
      </div>

 
      <div class="modal-body">

      <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
      <p class="alert alert-danger" style="background-color: #00c851;color: white;">Se ha realizado de forma correcta la asignación de  <? echo $Especialistas->Nombre_Prod; ?></p>
     
    </p>
    <button type="button" class="btn btn-outline-info btn-sm" onClick="history.go(-1);" class="btn btn-default">
  <i class="fas fa-long-arrow-alt-left fa-lg"></i> Regresar a productos 
</button>
<a type="button" class="btn btn-outline-success btn-sm" href="https://controlfarmacia.com/AdminPOS/VerificaAsignacionProducto?idProd=<? echo base64_encode($Especialistas->ID_Prod_POS); ?>" class="btn btn-default">
   Verificar Asignación <i class="fas fa-table"></i>
</a>
      </div>
    
    
    </div>
 
  </div>
</div>
<?php else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<?php endif;?>

       <!--Footer-->
     

       </div>
       </div>


     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php
  include ("Modales/Vacios.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");

  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<script src="js/DistribuyeProductosAsucursales.js"></script>

<script src="datatables/Buttons-1.5.6/js/dataTables.buttons.min.js"></script>  
    <script src="datatables/JSZip-2.5.0/jszip.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/pdfmake.min.js"></script>    
    <script src="datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="datatables/Buttons-1.5.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>


<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>

<!-- PAGE PLUGINS -->
<script>
$(function(){
  $('#sucursal').multiselect({
          includeSelectAllOption: true,
          enableFiltering: true,
          selectAllText: 'Todas las sucursales', 
          nonSelectedText: 'Elija sucursales',
        
          
        });
});   
</script>


</body>
</html>
<?php

function fechaCastellano ($fecha) {
  $fecha = substr($fecha, 0, 10);
  $numeroDia = date('d', strtotime($fecha));
  $dia = date('l', strtotime($fecha));
  $mes = date('F', strtotime($fecha));
  $anio = date('Y', strtotime($fecha));
  $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
  $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
  $nombredia = str_replace($dias_EN, $dias_ES, $dia);
$meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
  $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
  $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
  return $nombredia." ".$numeroDia." de ".$nombreMes." de ".$anio;
}
?>