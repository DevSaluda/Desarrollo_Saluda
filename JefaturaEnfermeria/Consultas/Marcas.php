<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#Marcas').DataTable({
            "order": [
                [0, "desc"]
            ],
            "lengthMenu": [
                [25, 50, 150, 200, -1],
                [25, 50, 150, 200, "Todos"]
            ],
            language: {
                "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast": "Último",
                    "sNext": "Siguiente",
                    "sPrevious": "Anterior"
                },
                "sProcessing": "Procesando...",
            },

            //para usar los botones   
            responsive: "true",
            dom: "<'#colvis row'><'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'bottom'ip><'clear'>'",




        });
    });
</script>
<?php

include("db_connection.php");
include "Consultas.php";
include "Sesion.php";

$user_id = null;
$sql1 = "SELECT * FROM `Marcas_POS` WHERE ID_H_O_D='" . $row['ID_H_O_D'] . "'";
$query = $conn->query($sql1);
?>

<?php if ($query->num_rows > 0) : ?>
    <div class="text-center">
        <div class="table-responsive">
            <table id="Marcas" class="table table-hover">
                <thead>

                    <th style="background-color: #0057b8 !important;">N°</th>
                    <th style="background-color: #0057b8 !important;">Presentacion</th>
                    <th style="background-color: #0057b8 !important;">Estatus</th>
                    <th style="background-color: #0057b8 !important;">Agregado el </th>
                    <th style="background-color: #0057b8 !important;">Acciones</th>




                </thead>
                <?php while ($MarcasBase = $query->fetch_array()) : ?>
                    <tr>
                        <td> <?php echo $MarcasBase["Marca_ID"]; ?></td>
                        <td> <?php echo $MarcasBase["Nom_Marca"]; ?></td>
                      
                        
                        <td> <button style="<?echo $MarcasBase['Cod_Estado'];?>" class="btn btn-default btn-sm"> <?php echo $MarcasBase["Estado"]; ?></button></td>
                        <td> <?php echo fechaCastellano($MarcasBase["Agregadoel"]); ?></td>
                        <td>
                            <!-- Basic dropdown -->
                            <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-th-list fa-1x"></i></button>

                            <div class="dropdown-menu">
                                <a data-id="<?php echo  $MarcasBase["Marca_ID"]; ?>" class="btn-edit5 dropdown-item">Editar datos <i class="fas fa-pencil-alt"></i></a>
                                <a data-id="<?php echo $MarcasBase["Marca_ID"]; ?>" class="btn-edit6 dropdown-item">Detalles <i class="fas fa-info-circle"></i></a>
                                <a data-id="<?php echo $MarcasBase["Marca_ID"]; ?>" class="btn-historialMar dropdown-item">Movimientos <i class="fas fa-history"></i></a>



                            </div>
                            <!-- Basic dropdown -->
                        </td>


                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </div>
<?php else : ?>
    <p class="alert alert-warning">No hay resultados</p>
<?php endif; ?>
<script>
  	$(".btn-edit5").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/EditaMarca.php","id="+id,function(data){
  			$("#form-edit3").html(data);
          $("#Titulo").html("Editar datos de categoria");
              $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-primary");
              $("#Di3").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di3").addClass("modal-dialog  modal-notify modal-info");
  		});
  		$('#editModal3').modal('show');
  	});
    $(".btn-edit6").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/DetallesMarca.php","id="+id,function(data){
              $("#form-edit3").html(data);
              $("#Titulo3").html("Detalles de marca ");
              $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di3").removeClass("modal-dialog modal-xl modal-notify modal-primary");
              $("#Di3").addClass("modal-dialog modal-notify modal-primary");
  		});
  		$('#editModal3').modal('show');
    });
    $(".btn-historialMar").click(function(){
  		id = $(this).data("id");
  		$.post("https://controlfarmacia.com/JefaturaEnfermeria/Modales/HistorialMarcas.php","id="+id,function(data){
              $("#form-edit3").html(data);
              $("#Titulo3").html("Movimientos realizados");
              $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-info");
              $("#Di3").removeClass("modal-dialog modal-lg modal-notify modal-danger");
              $("#Di3").addClass("modal-dialog modal-xl modal-notify modal-primary");
  		});
  		$('#editModal3').modal('show');
    });
  </script>
  <div class="modal fade" id="editModal3" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di3"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo3"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold"><i class="fas fa-info-circle"></i> <?echo $row['Nombre_Apellidos']?>, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-edit3"></div>
        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
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
?>-->