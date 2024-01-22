
<script>

tabla = $('#PacientesNuevos').DataTable({

 "bProcessing": true,
 "ordering": true,
 "bAutoWidth": false,
 "order": [[ 0, "desc" ]],
 "sAjaxSource": "https://controlconsulta.com/Enfermeria2/Consultas/ArrayPacientesSeguimiento.php",
 "aoColumns": [
       { mData: 'Folio' },
       { mData: 'Nombre' },

       { mData: 'Edad' },
       { mData: 'Sexo' },
       { mData: 'Alergias' },
       { mData: 'Cita' },
//        { mData: 'Existencias_R' },
//        { mData: 'Min_Existencia' },
//        { mData: 'Max_Existencia' },
//        {mData: "Existencias_R",
//         "searchable": true,
//         "orderable":true,
//         "render": function (data, type, row) {
//             if ( row.Existencias_R < row.Min_Existencia) {

//             return '<button class="btn btn-default btn-sm" style="background-color:#ff1800!important">Resurtir</button>';
//         }
//         else if ( row.Existencias_R > row.Max_Existencia) {
// return '<button class="btn btn-default btn-sm" style="background-color:#fd7e14!important">Sobregirado</button>'
//         }
//             else {
 
//     return '<button class="btn btn-default btn-sm" style="background-color:#2bbb1d!important">Completo</button>';
 
// }
//         }
 
//     },
 


      
  
      ],
     
    
      "lengthMenu": [[10,20,150,250,500, -1], [10,20,50,250,500, "Todos"]],  
  
      language: {
            "lengthMenu": "Mostrar _MENU_ registros",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                "sSearch": "Buscar:",
                "oPaginate": {
                    "sFirst": "Primero",
                    "sLast":"Último",
                    "sNext":"Siguiente",
                    "sPrevious": "Anterior"
			     },
			     "sProcessing":"Procesando...",
            },
          
        //para usar los botones   
        responsive: "true",
          
       
       
   
	   
        	        
    });     

</script>
<div class="text-center">
	<div class="table-responsive">
	<table  id="PacientesNuevos" class="table table-hover">
<thead>

    <th style ="background-color: #CE009F !important;">Folio </th>
    <th style ="background-color: #CE009F !important;">Nombre</th>
    <th style ="background-color: #CE009F !important;">Edad </th>
    <th style ="background-color: #CE009F !important;">Sexo </th>
    <th style ="background-color: #CE009F !important;">Alergias</th>
    <th style ="background-color: #CE009F !important;">Acciones</th>


</thead>

</div>
</div>


<!-- <script>
  $(".btn-edit").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/ReasignaProducto.php","id="+id,function(data){
        alert($(this).data("id"));
        $("#form-editPacientesNuevosG").html(data);
    $("#TituloPacientesNuevosG").html("Asignacion de PacientesNuevos en otras sucursales");
       
        $("#DiPacientesNuevosG").removeClass("modal-dialog  modal-xl modal-notify modal-info");
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiPacientesNuevosG").addClass("modal-dialog  modal-xl modal-notify modal-success");
    });
    $('#editModalPacientesNuevosG').modal('show'); 
});
$(".btn-VerDistribucion").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/DistribucionesPacientesNuevos.php","id="+id,function(data){
        $("#form-editPacientesNuevosG").html(data);
    $("#TituloPacientesNuevosG").html("Distribucion de PacientesNuevos");
       
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiPacientesNuevosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalPacientesNuevosG').modal('show');
});
$(".btn-editProd").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/EditaPacientesNuevosStockGeneral.php","id="+id,function(data){
        $("#form-editPacientesNuevosG").html(data);
    $("#TituloPacientesNuevosG").html("Editar datos");
       
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiPacientesNuevosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalPacientesNuevosG').modal('show');
});
$(".btn-History").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/HistorialPacientesNuevos.php","id="+id,function(data){
        $("#form-editPacientesNuevosG").html(data);
    $("#TituloPacientesNuevosG").html("Actualizaciones y movimientos");
       
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiPacientesNuevosG").addClass("modal-dialog  modal-xl modal-notify modal-info");
    });
    $('#editModalPacientesNuevosG').modal('show');
});


$(".btn-Delete").click(function(){
    id = $(this).data("id");
    $.post("https://controlfarmacia.com/AdminPOS/Modales/DeletePacientesNuevos.php","id="+id,function(data){
        alert($(this).data("id"));
        $("#form-editPacientesNuevosG").html(data);
    $("#TituloPacientesNuevosG").html("Eliminar producto");
       
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-danger");
        $("#DiPacientesNuevosG").removeClass("modal-dialog modal-lg modal-notify modal-primary");
        $("#DiPacientesNuevosG").removeClass("modal-dialog  modal-xl modal-notify modal-info");
        $("#DiPacientesNuevosG").addClass("modal-dialog modal-sm modal-notify modal-danger");
    });
    $('#editModalPacientesNuevosG').modal('show');
});


</script>


  <div class="modal fade" id="editModalPacientesNuevosG" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="DiPacientesNuevosG"class="modal-dialog modal-lg modal-notify modal-info">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="TituloPacientesNuevosG"></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
	        <div class="modal-body">
          <div class="text-center">
        <div id="form-editPacientesNuevosG"></div>
        
        </div>

      </div>
    </div>
  </div> -->
