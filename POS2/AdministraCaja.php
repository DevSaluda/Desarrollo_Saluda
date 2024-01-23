<?php
include "Consultas/Consultas.php";
include "Consultas/ConsultaFondoCaja.php";
include "Consultas/ConsultaCaja.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Administración de caja |</title>

<?php include "Header.php"?>
 <style>
        .error {
  color: red;
  margin-left: 5px; 
  
}

    </style>
</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header" style="background-color: #2bbbad !important;color: white;">
  Administración de caja de <?php echo $row['Nombre_Sucursal']?>
  </div>
  
  <div >
  <button data-id="<?php echo $ValorFondoCaja["ID_Fon_Caja"];?>" class="btn-editcaja btn btn-success">
  Apertura de caja <i class="fas fa-address-card"></i>
</button>
</div>

</div>




      <div id="Cajas"></div>
      </div>
    </div>
  </div>
</div>

</div>
  </div>
</div>

  
         
</div>
</div>

     
  
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
 
  <!-- Main Footer -->
<?php
    
  
  include ("Modales/Error.php");
  include ("Modales/Exito.php");
  include ("Modales/ExitoActualiza.php");
  include ("Modales/AdvierteDeCaja.php");
  include ("footer.php")?>

<!-- ./wrapper -->


<script src="js/Cajas.js"></script>
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

<script>
  	
    $(".btn-edit").click(function(){
  		id = $(this).data("id");
  		$.post("https://saludapos.com/POS2/Modales/AbreCaja.php","id="+id,function(data){
              $("#form-edit").html(data);
              $("#Titulo").html("Apertura de caja");
              $("#Di").addClass("modal-dialog modal-lg modal-notify modal-success");
  		});
  		$('#editModal').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog  modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><?php echo $row['Nombre_Apellidos']?>
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
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
?><?php
if($ValorCaja["Estatus"] == 'Abierta'){

    
     }else{
    
      echo '
      <script>
$(document).ready(function()
{
  // id de nuestro modal
  $("#NoCajaEnCaja").modal("show");
});
</script>
      ';
      
      
    
     } ?>