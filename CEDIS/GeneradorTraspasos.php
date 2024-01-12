
<?php
 $IdBusqueda=base64_decode($_GET['idProd']);
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
$fcha = date("Y-m-d");
$user_id=null;
$sql1= "SELECT Stock_POS.Folio_Prod_Stock,Stock_POS.ID_Prod_POS,Stock_POS.Clave_adicional,Stock_POS.Cod_Barra,Stock_POS.Nombre_Prod,Stock_POS.Tipo_Servicio,
Stock_POS.Fk_sucursal, Stock_POS.Existencias_R,Stock_POS.Proveedor1,Stock_POS.Proveedor2,Stock_POS.CodigoEstatus,Stock_POS.Lote,Stock_POS.Precio_C,	Stock_POS.Precio_Venta,
Stock_POS.Estatus,Stock_POS.Fecha_Caducidad,Stock_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal FROM Stock_POS,SucursalesCorre WHERE Stock_POS.Fk_Sucursal = SucursalesCorre.ID_SucursalC AND Stock_POS.Folio_Prod_Stock = $IdBusqueda";
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

  <title>Generar Traspasos </title>

<?include "Header.php"?>
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
<?include_once ("Menu.php")?>
<? if($Especialistas!=null):?>
  <div class="card text-center">
  <div class="card-header" style="background-color:#4285f4!important;color: white;">
  Generando traspaso de <? echo $Especialistas->Nombre_Prod; ?> 
  </div>
  </div>
  <div class="col-md-12">
  <button type="button" class="btn btn-outline-info btn-sm" onClick="history.go(-1);" class="btn btn-default">
  <i class="fas fa-long-arrow-alt-left fa-lg"></i> Regresar a stock de sucursales 
</button>
  <div class="text-center">
    <br>
  
<form enctype="multipart/form-data" id="GeneraTraspasoProductos">
         <div class="row">
         <div class="col">
    <label for="exampleFormControlInput1">Folio de traspaso <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled  value="AUTOGENERADO POR SISTEMA" >
    </div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " readonly id="asignacodbarra" name="AsignaCodBarra" value="<? echo $Especialistas->Cod_Barra; ?>" >
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Nombre / Descripcion<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly id="asignanombreprod" name="AsignaNombreProd" value="<? echo $Especialistas->Nombre_Prod; ?>" >          
    </div>
   </div></div>
   <div class="row">
   <div class="col">
    <label for="exampleFormControlInput1">Sucursal Origen <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="text" class="form-control " readonly  value="<? echo $Especialistas->Nombre_Sucursal; ?>" >   
  <input type="text" class="form-control "  readonly hidden id="sucursalorigen" name="SucursalOrigen" value="<? echo $Especialistas->Fk_sucursal; ?>" >       
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal Destino <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <select id = "sucursaldestino" class = "form-control"  >
  <option value="">Seleccione una Sucursal:</option>
                                               <?
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
                        ?>
        </select>   
        <input type="text" class="form-control" id="sucursalreal" hidden name="VerdaderaSucursal">  
        <input type="text" class="form-control" id="sucursaltexto" hidden name="SucursalDestino">              
    </div><label for="sucursaldestino" class="error">
    </div>

    <script>
      $("#sucursaldestino").change(function() {
  var valor = $(this).val(); // Capturamos el valor del select
  var texto = $(this).find('option:selected').text(); // Capturamos el texto del option seleccionado

  $("#sucursalreal").val(valor);
  $("#sucursaltexto").val(texto);
});
    </script>
   
    <!-- DATA IMPORTANTE -->

    <div class="col">
      
    <label for="exampleFormControlInput1">Fecha estimada de entrega <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="date" class="form-control " name="FechaAprox" id="fechaaprox"  > 
</div><label for="fechaaprox" class="error"></div></div>
<div class="row">
    
    <div class="col">
    <label for="exampleFormControlInput1">Existencia en sucursal <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly name="ExisteActual" id="existenciaactual"  aria-describedby="basic-addon1" value="<? echo $Especialistas->Existencias_R; ?>" >           
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad a traspasar <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="number" class="form-control monto" name="CanTraspaso"  oninput ="multiplicar()"  id="cantraspaso"  aria-describedby="basic-addon1"  >           
    </div><label for="maxe" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad en sucursal despues de traspaso <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " readonly id="newcantidadexistenciasr" name="NewCantidadExistenciasR" >
    </div><label for="pc" class="error">
    </div>
    </div>
    <script>
      function multiplicar(){
  m1 = document.getElementById("cantraspaso").value;
  m2 = document.getElementById("precioventa").value;
  m3= document.getElementById("preciocompra").value;
  r = m1*m2;
  v= m1* m3;
  document.getElementById("totaldeventa").value = r;
  document.getElementById("totaldecompra").value = v;
}



    </script>
    <!-- VALORES DE DATOS DE FACTURA -->

    <div class="row">
   <div class="col">
    <label for="exampleFormControlInput1">Precio venta <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="Number" class="form-control monto " readonly  id="precioventa" name="PrecioVenta" value="<? echo $Especialistas->Precio_Venta; ?>" >   
      
    </div><label for="mine" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Precio compra <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="Number" class="form-control " name="PrecioCompra" id="preciocompra"  readonly  value="<? echo $Especialistas->Precio_C; ?>" >
    </div><label for="mine" class="error">
    </div>

   
    <!-- DATA IMPORTANTE -->

    <div class="col">
      
    <label for="exampleFormControlInput1">Valor total compra <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="number" class="form-control " name="Totaldecompra" id="totaldecompra" >
</div><label for="pv" class="error"></div>

<div class="col">
      
    <label for="exampleFormControlInput1">Valor total venta <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-mobile"></i></span>
  </div>
  <input type="number" name="TotaldeVenta" id="totaldeventa" class="form-control "   >
</div><label for="pv" class="error"></div></div>

    <!-- VALORES DE DATOS DE FACTURA -->
    
   

<input type="text" class="form-control "  hidden name="ID_Prod" value="<? echo $Especialistas->ID_Prod_POS; ?>" >
<input type="text" class="form-control " hidden name="TipoServicio" id="tiposervicio"  value="<?echo $Especialistas->Tipo_Servicio?>"aria-describedby="basic-addon1" >
    <input type="text" class="form-control " hidden name="EmpresaProductos" id="empresa" value="<?echo  $row['ID_H_O_D']?>"aria-describedby="basic-addon1" >       
    <input type="text" class="form-control " hidden name="RevProvee1" id="revprovee1" value="<? echo $Especialistas->Proveedor1; ?>"  >   
    <input type="text" class="form-control " hidden name="RevProvee2" id="revprovee2" value="<? echo $Especialistas->Proveedor2; ?>" >   
    <input type="text" class="form-control " hidden name="AgregaProductosBy" id="agregaproductosby
    " value="<?echo $row['Nombre_Apellidos']?>" >   
 
    
    <div class="justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-primary">Realizar Traspaso <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>


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
<? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>

       <!--Footer-->
     

       </div>
       </div>


     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?
  include ("Modales/Vacios.php");
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");

  include ("footer.php")?>

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script>

var valor_inicial = $('#existenciaactual').val();

$( document ).ready(function() {
    $('#cantraspaso').keyup(function () {
        var valor = parseInt(valor_inicial);
        var valor_restar = 0;
        $('#cantraspaso').each(function () {
          if ($(this).val() > 0) {
            valor_restar += parseInt($(this).val());
          }
        });
            
        $('#newcantidadexistenciasr').val(valor - valor_restar);
              
    });
});
    </script>
<script src="js/GeneraTraspaso.js"></script>

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




</body>
</html>
<?

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