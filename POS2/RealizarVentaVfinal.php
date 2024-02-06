<?php
include "Consultas/Consultas.php";

include "Consultas/AnalisisIndex.php";
include "Consultas/ConsultaCaja.php";
include "Consultas/SumadeFolioTickets.php";
include "Consultas/ConsultaFondoCaja.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Realizando ventas <?echo $row['ID_H_O_D']?> <?echo $row['Nombre_Sucursal']?> </title>

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
  background-color: #007bff !important;
  color: white;
}
    </style>
</head>
<?include_once ("Menu.php")?>

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  
  
  <li class="nav-item">
    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Ventas <?echo $row['ID_H_O_D']?> <?echo $row['Nombre_Sucursal']?> </a>
  </li>
 
</ul>

<div class="tab-content" id="pills-tabContent">


  <div class="card text-center">
 
  <div >
 
                
</div>
</div>



<script>
  window.onload=function()
{$('#agregarmasproductos').trigger('click');
};
</script>


 
<script>
  $(function() {

$(document).ready(function() {
  var maxGroup = 40;
    var id = 0;
                $(".addMore").click(function() {
        id = id + 1;
        if ($('body').find('.form-group').length <= maxGroup) {
            var fieldHTML = '<div class="form-group fieldGroup selector-' + id + '">' + $(".fieldGroupCopy").html() + '</div>';
            $('body').find('.fieldGroupCopy:last').before(fieldHTML);
        } else {
            alert('Maximo ' + maxGroup + ' de productos añadido.');
        }
              });
    
      
        $("#FiltrarContenido").autocomplete({
            source: "https://saludapos.com/POS2/Consultas/BusquedaOptimizadaDeProductos.php",
            minLength: 1,
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
                $('#agregarmasproductos').trigger('click');
 $(' #FiltrarContenido').val('');

                

            }

        });

   
});
//remover
$("body").on("click", ".remove", function() {
    $(this).parents(".fieldGroup").remove();
    contarTotal();
});
});
</script>

<div class="text-center">
        <div class="container"  style="max-width: 1600px !important;">
        
        <a href="javascript:void(0)" id="agregarmasproductos"class="btn btn-info  btn-sm addMore "> Agregar producto <i class="fa-solid fa-plus"></i></a>
<button class="btn btn-primary  btn-sm " id="ajustador" onclick="contarTotal()">Ajustar total <i class="fa-solid fa-sliders"></i></button>
        <button data-toggle="modal" data-target="#CambioAdar" class="btn btn-success btn-sm">Realizar venta <i class="fas fa-cash-register"></i></button>
<button  class="btn btn-danger btn-sm" onclick="CargaGestionventas();">Cancelar venta <i class="far fa-window-close"></i></button>
     
<button data-toggle="modal" data-target="#ConsultaProductosDeSucursal" class="btn btn-primary btn-sm"  >Consulta productos <i class="fas fa-search"></i></button>
<button data-id="<?php echo $ValorFondoCaja["ID_Fon_Caja"];?>" class="btn-aperturacaja btn btn-success btn-sm">
  Apertura de caja <i class="fas fa-address-card"></i>
</button>
<button data-id="<?php echo $ValorCaja["ID_Caja"];?>" class="btn-arqui btn btn-warning btn-sm " type="submit"  >Arqueo de caja <i class="fa-solid fa-money-bill-transfer"></i> </button> 
<button data-id="<?php echo $ValorCaja["ID_Caja"];?>" class="btn-edit btn btn-warning btn-sm " type="submit"  >Corte de caja <i class="fas fa-cut"></i> <i class="fas fa-money-bill"></i></button> 
  
  <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Desplegar menu
  </button>

<div class="collapse" id="collapseExample">
<button  data-toggle="modal" data-target="#ReimprimeVentas"   class="btn-reimpresion btn btn-info btn-sm  " type="submit"  >Reimpresión de tickets <i class="fas fa-print"></i></button>
<button  data-toggle="modal" data-target="#ReimprimeVentas"   class="btn-reimpresion btn btn-info btn-sm  " type="submit"  >Cambio de caja <i class="fas fa-print"></i></button>
</div>


</div>

<!-- INICIO DE FORMULARIO QUE SE REGISTRA EN BD  -->
<form action="javascript:void(0)" method="post" id="VentasAlmomento" >
  <div class="text-center">
  <button type="submit"  style="display: none;" value="Guardar" class="btn btn-success">Generar traspaso <i class="fa-solid fa-arrow-right-arrow-left"></i></button>
  <div >
  <div class="container"  style="max-width: 1600px !important;" >
<div class="row">


   
        


            
    <div class="col">
      
    <label for="exampleFormControlInput1">Total en caja </label> 
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-wallet"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $ValorCaja['Valor_Total_Caja']?>"> 
  
  
    </div>  </div>
    <div class="col">
      
    <label for="exampleFormControlInput1">Turno </label> 
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-clock"></i></span>
  </div>
  <input type="text" class="form-control " readonly  value="<?php echo $ValorCaja['Turno']?>"  > 
  
  
    </div>  </div>
      
    <div class="col">
      
    <label for="exampleFormControlInput1">Fecha de venta</label> 
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-week"></i></span>
  </div>
  <input type="date" class="form-control "  readonly  value="<?echo date("Y-m-d")?>"  > 
  
  
    </div>  </div>



  <div class="col">
      
  <label for="exampleFormControlInput1">Total de venta </label>
      <div class="input-group mb-3">
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-money-check-alt"></i></span>
    </div>
    <input type="number" class="form-control " id="resultadoventas" name="resultadoventas[]" readonly  >
   
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
<div class="container"  style="max-width: 1600px !important;" >
  <input id="FiltrarContenido" type="text" class="form-control"  autofocus placeholder="Ingrese codigo de barra" style="position: relative;"aria-label="Alumno" aria-describedby="basic-addon1">
  
  </div>
<div></div><div></div>
 <br>
<div class="text-center">
    
   
            
                

            <div class="form-group fieldGroupCopy" style="display: none;">
            
            <div class="lista-producto float-clear" style="clear:both;">
            <ul class="list-group">
   <li class="list-group-item">
   <div class="form-row">
     <input class="form-control" hidden  type="text" id="idprod" autofocus name="Idprod[]"  placeholder="Codigo de barra o nombre de producto"/>
     
  
 
  
   <div class="col">  <label for="exampleFormControlInput1">Codigo de barra <span class="text-danger">*</span> </label>  <input class="form-control"  type="text" id="codbarra" autofocus name="CodBarra[]"  placeholder="Codigo de barra o nombre de producto"/></div>
   <div class="col">     <label for="exampleFormControlInput1">Nombre/Descripcion <span class="text-danger">*</span>   </label>   <input class="form-control" readonly type="text" id="nombres" name="NombreProducto[]" placeholder="Nombres"/></div>
  <div class="col">     <label for="exampleFormControlInput1">Precio de venta <span class="text-danger">*</span>  </label>   <input class="input-precio form-control"   type="text" id="precioventa" name="PrecioVenta[]" placeholder="Cargo"/></div>
  
   <div class="col">  <label for="exampleFormControlInput1">Precio de compra <span class="text-danger">*</span>  </label>  <input class="input-preciocompra form-control"   type="text" id="preciodecompra" name="PrecioDeCompra[]" placeholder="Grado"/></div>
   <div class="col"> <label for="exampleFormControlInput1">Cantidad a traspasar <span class="text-danger">*</span> </label><input class="input-cantidad form-control" value="0" onchange="contarTotal()" type="number" id="traspasocant" name="NTraspasos[]" placeholder="Cantidad traspasada"/></div>
   <div class="col"> <label for="exampleFormControlInput1">Forma de pago <span class="text-danger">*</span> </label><input class="input-formapago form-control"  type="text" id="Formapago" name="NTraspasos[]" value="Efectivo"/></div>
   

      <input type="text" class="form-control " hidden id="valcaja" name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >
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

    var totalAPagar = 0;
    for (let index = 0; index < inputsCantidad.length; index++) {
        totalAPagar += (Number(inputsPrecio[index].value) * Number(inputsCantidad[index].value));
    }
    var totalAPagarcompra = 0;
    for (let index = 0; index < inputsCantidad.length; index++) {
      totalAPagarcompra  += (Number(inputsPreciocompra[index].value) * Number(inputsCantidad[index].value));
    }
    document.getElementById("resultadoventas").value=totalAPagar;
    document.getElementById("subtotal").value=totalAPagar;

    var totalpiezas = 0;
    for (let index = 0; index < inputsCantidad.length; index++) {
      totalpiezas  += (Number(inputsCantidad[index].value));
    }

    document.getElementById("resultadopiezas").value=totalpiezas;



}





          </script>
    </div>   </div>   </div>   </div>   </div>   </div>   </div>   </div>   </div>   </div>
      <!-- Fin Contenido --> 
<!-- POR CADUCAR -->
  

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?

  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/CierreDeVenta.php");
  include ("Modales/AdvierteDeCaja.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/ActualizaProductosRegistrados.php");
  include ("Modales/BusquedaMejoradaProductos.php");

  
  include ("footer.php")?>

<?php
if($ValorCaja["Estatus"] == 'Abierta'){

    
     }else{
    
      echo '
      <script>
$(document).ready(function()
{
  // id de nuestro modal
  $("#NoCaja").modal("show");
});
</script>
      ';
      
      
    
     }
     
     ?>
<script>
  	
   
  </script>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
<div id="Di"class="modal-dialog modal-lg  modal-notify modal-warning">
    <div class="modal-content">
    <div class="modal-header">
       <p class="heading lead" id="Titulo"></p>

       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true" class="white-text">&times;</span>
       </button>
     </div>
      
        <div class="modal-body">
        <div class="text-center">
      <div id="form-edit"></div>
      
      </div>

    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


  <script>

$(".btn-edit").click(function() {
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/CortesDeCajaNuevo.php", "id=" + id, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").html("Corte de caja");
        $("#Di").addClass("modal-dialog modal-lg modal-notify modal-warning");
    });
    $('#editModal').modal('show');
});

$(".btn-arqui").click(function() {
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/ArqueoDeCaja.php", "id=" + id, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").html("Arqueo De Caja");
        $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-warning");
        $("#Di").addClass("modal-dialog modal-lg modal-notify modal-info");
    });
    $('#editModal').modal('show');
});

$(".btn-aperturacaja").click(function() {
    id = $(this).data("id");
    $.post("https://saludapos.com/POS2/Modales/AbreCajaEnVentas.php", "id=" + id, function(data) {
        $("#form-edit").html(data);
        $("#Titulo").text("Apertura De caja");
        $("#Di").removeClass("modal-dialog modal-lg modal-notify modal-warning");
        $("#Di").addClass("modal-dialog modal-lg modal-notify modal-success");
    });
    $('#editModal').modal('show');
});
  </script>

<script src="js/RealizaVentasVersionFinal.js"></script>
<script src="js/FuncionalidadesVentasNuevas.js"></script>
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