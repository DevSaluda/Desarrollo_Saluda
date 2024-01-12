<?php

$SucursalDestino=($_POST['SucursalConOrdenDestino']);
$SucursalDestinoLetras=($_POST['sucursalLetras']);

$NumeroOrdenTraspaso=($_POST['NumOrden']);
$NumeroDeFacturaTrapaso=($_POST['NumFactura']);
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/AnalisisIndex.php";
include "Consultas/SumaDeTraspasos.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Generar ordenes de traspasos <?echo $row['ID_H_O_D']?> </title>

<?include "Header.php"?>

 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
  
}
table td {
  word-wrap: break-word;
  max-width: 400px;
}

    </style>

<style>
        .error {
  color: red;
  margin-left: 5px; 
  
}
#Tarjeta2{
  background-color: #2bbbad !important;
  color: white;
}
    </style>
</head>
<?include_once ("Menu.php")?>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  
  
  <li class="nav-item">
    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ordenes de traspasos</a>
  </li>
 
</ul>

<div class="tab-content" id="pills-tabContent">


  <div class="card text-center">
  <div class="card-header" style="background-color:#2b73bb !important;color: white;">
 Traspasos de cedis de <?echo $row['ID_H_O_D']?>  
  </div>
 
  <div >
 
                
</div>
</div>



<script type="text/javascript">  
        $(function() {
          
        $(document).ready(function(){

             var maxGroup = 600;
             var id = 0;
            $(".addMore").click(function(){
                id = id + 1;
                if($('body').find('.form-group').length <= maxGroup){
                    var fieldHTML = '<div class="form-group fieldGroup selector-' + id + '">'+$(".fieldGroupCopy").html()+'</div>';
                    $('body').find('.fieldGroupCopy:last').before(fieldHTML);
                }else{
                    alert('Maximo '+maxGroup+' personas, mayor a esto realize cargue masivo.');
                }
                $(".selector-" + id + " #codbarra").focus(); 
                $(".selector-" + id + " #codbarra").autocomplete({
                        source: "Consultas/BusquedaCedisProductos.php",
                        minLength: 2,
                        select: function(event, ui) {
                        event.preventDefault();
                       
                        $('.selector-' + id + ' #idprod').val(ui.item.idprod);
                        $('.selector-' + id + ' #codbarra').val(ui.item.codbarra);
                        $('.selector-' + id + ' #nombres').val(ui.item.nombres);
                        $('.selector-' + id + ' #precioventa').val(ui.item.precioventa);
                        $('.selector-' + id + ' #preciodecompra').val(ui.item.preciodecompra);
                         $('.selector-' + id + ' #tipodeservicio').val(ui.item.tipodeservicio);
                         $('.selector-' + id + ' #proveedor1').val(ui.item.proveedor1);
                         $('.selector-' + id + ' #proveedor2').val(ui.item.proveedor2);
                         $('.selector-' + id + ' #proveedor1vista1').val(ui.item.proveedor1vista1);
                         $('.selector-' + id + ' #proveedor2vista2').val(ui.item.proveedor2vista2);
                        $('#ajustador').trigger('click');
                        $('#agregarmasproductos').trigger('click');
                        
                        
                        }
                        
                    });
                    
                });
            });
            //remover
            $("body").on("click",".remove",function(){ 
                $(this).parents(".fieldGroup").remove();
                contarTotal();
            });
        });

                

        </script>
        <a href="javascript:void(0)" id="agregarmasproductos"class="btn btn-info addMore"> Agregar producto <i class="fa-solid fa-plus"></i></a>
<button class="btn btn-primary" id="ajustador" onclick="contarTotal()">Ajustar total <i class="fa-solid fa-sliders"></i></button>
<form action="javascript:void(0)" method="post" id="Generamelostraspasos" >
  <div class="text-center">
  <button type="submit"   value="Guardar" class="btn btn-success">Generar traspaso <i class="fa-solid fa-arrow-right-arrow-left"></i></button>
  
  <div class="container" >
<div class="row">


    <div class="col">
   
    <label for="exampleFormControlInput1">Sucursal destino</label> 
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-barcode"></i></span>
  <input type="text" name="" hidden id="" readonly class="form-control" value="<?echo $SucursalDestino?>">
  <input type="text" name="" id=""  readonly class="form-control" value="<?echo $SucursalDestinoLetras?>">
  </div>
  
    </div>  </div>
        
    

            
    <div class="col">
      
    <label for="exampleFormControlInput1"># de orden</label> 
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-clock"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?echo $NumeroOrdenTraspaso?>"  > 
  
  
    </div>  </div>
    
 
  
  


      
      <div class="col">
      
  <label for="exampleFormControlInput1">Total de Piezas </label> 
      <div class="input-group mb-3">
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fa-solid fa-puzzle-piece"></i></span>
    </div>
    <input type="number" class="form-control " id="resultadopiezas" name="resultadepiezas[]" readonly  >
   
      </div>
  
      </div>
      <!-- <div class="col">
      
  <label for="exampleFormControlInput1">Total de compra </label> 
      <div class="input-group mb-3">
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-money-check-alt"></i></span>
    </div>
    <input type="number" class="form-control " id="resultadocompras" name="resultadocompras[]" readonly  >
   
      </div>
  
      </div> -->
</div>
</div>
</div>

<div class="text-center">
    
   
            
                

            <div class="form-group fieldGroupCopy" style="display: none;">
            
            <div class="lista-producto float-clear" style="clear:both;">
            <ul class="list-group">
   <li class="list-group-item">
   <div class="form-row">
     <input class="form-control" hidden  type="text" id="idprod" autofocus name="Idprod[]"  placeholder="Codigo de barra o nombre de producto"/>
     
  
 
  
   <div class="col">  <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>  <input class="form-control"  type="text" id="codbarra" autofocus name="CodBarra[]"  placeholder="Codigo de barra o nombre de producto"/></div>
   <div class="col">     <label for="exampleFormControlInput1">Nombre/Descripcion <span class="text-danger">*</span>   </label>   <input class="form-control" readonly type="text" id="nombres" name="NombreProducto[]" placeholder="Nombres"/></div>
   <div class="col" hidden>     <label for="exampleFormControlInput1">Proveedor 1<span class="text-danger">*</span>   </label>   <input class="form-control" readonly type="text" id="proveedor1vista1" placeholder="Nombres"/></div>
   <div class="col" hidden>     <label for="exampleFormControlInput1">Proveedor 2 <span class="text-danger">*</span>   </label>   <input class="form-control" readonly type="text" id="proveedor2vista2" placeholder="Nombres"/></div>
   <div class="col" hidden>     <label for="exampleFormControlInput1">Precio de venta <span class="text-danger">*</span>  </label>   <input class="input-precio form-control"   type="text" id="precioventa" name="PrecioVenta[]" placeholder="Cargo"/></div>
  
   <div class="col" hidden>  <label for="exampleFormControlInput1">Precio de compra <span class="text-danger">*</span>  </label>  <input class="input-preciocompra form-control"   type="text" id="preciodecompra" name="PrecioDeCompra[]" placeholder="Grado"/></div>
   <div class="col"> <label for="exampleFormControlInput1">Cantidad a traspasar <span class="text-danger">*</span> </label><input class="input-cantidad form-control" value="0" onchange="contarTotal()" type="number" id="traspasocant" name="NTraspasos[]" placeholder="Cantidad traspasada"/></div>
   <input type="text" name="SucursalDestino[]"  hidden id="SucDestino" class="form-control" value="<?echo $SucursalDestino?>">
   <input type="text" name="SucursalDestinoLetras[]" hidden id="SucDestinoLetras" class="form-control" value="<?echo $SucursalDestinoLetras?>">
   <input type="text" name="TipodeServicio[]" hidden id="tipodeservicio" class="form-control" >
   <input type="text" name="SucursalTraspasa[]" hidden value="21" class="form-control" >
   <input type="date" class="form-control "  hidden name="FechaAprox[]" id="fechaaprox" value="<?echo date("Y-m-d")?>"  > 
   <input type="text" class="form-control "  hidden name="GeneradoPor[]" value="<?echo $row['Nombre_Apellidos']?>"readonly  >
      <input type="text" class="form-control " hidden  name="Empresa[]" value="<?echo $row['ID_H_O_D']?>"readonly  >
      <input type="text"  hidden name="Proveedor1[]" id="proveedor1" class="form-control" >
      <input type="text" hidden name="Proveedor2[]" id="proveedor2" class="form-control" >
      <input type="text" hidden name="Estatus[]" value="Generado" class="form-control" >
      <input type="text" hidden name="Existencia1[]" value="0" class="form-control" >
      <input type="text" hidden name="Existencia2[]" value="0" class="form-control" >
      <input type="text" hidden name="Recibio[]" value="" class="form-control" >
      <input type="text" class="form-control " hidden name="NumeroDelTraspaso[]" readonly  value="<?echo $NumeroOrdenTraspaso?>"  > 
      <input type="text" class="form-control " hidden  name="ProveedorDelTraspaso[]" readonly  value="CEDIS"  >
      <input type="text" class="form-control " hidden name="NumeroDeFacturaTraspaso[]" readonly  value="<?echo $NumeroDeFacturaTrapaso?>"  > 
  </form>    
   <div class="col">   <label for="exampleFormControlInput1">Eliminar </label> <br> <a   id="deletee" class="btn btn-danger btn-sm remove"><i class="fas fa-minus-circle"></i></a></div></div>
              	</li>
 </ul>      
              </div> </div> 
              
              <script>
                function contarTotal() {
    inputsPrecio = document.getElementsByClassName('input-precio');
    inputsPreciocompra = document.getElementsByClassName('input-preciocompra');
    inputsCantidad = document.getElementsByClassName('input-cantidad');

   
      

    var totalpiezas = 0;
    for (let index = 0; index < inputsCantidad.length; index++) {
      totalpiezas  += (Number(inputsCantidad[index].value));
    }

    document.getElementById("resultadopiezas").value=totalpiezas;



}





          </script>
          <script>
 $(function () {
    $("body").keypress(function (e) {
        var key;
        if (window.event)
            key = window.event.keyCode; //IE
        else
            key = e.which; //firefox     
        return (key != 13);
    });
});
  </script>
    </div>   </div>   </div>   </div>   </div>   </div>   </div>   </div>   </div>   </div>
      <!-- Fin Contenido --> 
<!-- POR CADUCAR -->
  

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?

  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/ActualizaProductosRegistrados.php");
  include ("footer.php")?>

<!-- ./wrapper -->

<script src="js/RealizaTraspasosV2.js"></script>

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