<?php
include "Consultas/Consultas.php";
include "Consultas/Sesion.php";
include "Consultas/Conexion_selects.php";
include "Consultas/ConeSelectDinamico.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>ALTA DE ESPECIALIDADES </title>



  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/b5ed0deb1b.js" crossorigin="anonymous"></script>
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.css">
  

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  

  <!-- JS, Popper.js, and jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  
  <!-- JS, Popper.js, and jQuery -->
  
  <script src="https://code.jquery.com/jquery-3.5.0.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 <!-- Font Awesome -->


<!-- Material Design Bootstrap -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">
</head>
<?include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header">
    Especialidades
  </div>
  
  <div class="card-footer">
  <button type="button" class="btn btn-success" data-toggle="modal" data-target=".bd-example-modal-lg" class="btn btn-default">
  Añadir nueva especialidad <i class="fas fa-plus-square"></i>    
</button>
<br><br>
    
  

  <div class="container">
<div class="row">
<div class="col-md-12">
    
<div id="TablaCampanas"></div>


</div>
</div>
</div>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?
  include ("Modales/AltaCampana2.php");
  include ("Modales/EliminarCampana.php");
  include ("footer.php")?>
<!-- ./wrapper -->
<script src="js/ControlCampanas.js"></script>
<script src="js/AgregaCampana.js"></script>
<script type = "text/javascript">
	$('document').ready(function(){
		$('#especialidad').on('change', function(){
				if($('#especialidad').val() == ""){
					$('#medico').empty();
					$('<option value = "">Selecciona un estudio</option>').appendTo('#medico');
					$('#medico').attr('disabled', 'disabled');
				}else{
					$('#medico').removeAttr('disabled', 'disabled');
					$('#medico').load('Consultas/ObtieneMedicos.php?especialidad=' + $('#especialidad').val());
				}
		});
  });
  	$('document').ready(function(){
		$('#medico').on('change', function(){
				if($('#medico').val() == ""){
					$('#fecha').empty();
					$('<option value = "">Selecciona una fecha</option>').appendTo('#fecha');
					$('#fecha').attr('disabled', 'disabled');
				}else{
					$('#fecha').removeAttr('disabled', 'disabled');
					$('#fecha').load('Consultas/ObtieneFecha.php?medico=' + $('#medico').val());
				}
		});
  });
  $('document').ready(function(){
		$('#medico').on('change', function(){
				if($('#medico').val() == ""){
					$('#hora').empty();
					$('<option value = "">Selecciona una hora</option>').appendTo('#hora');
					$('#fecha').attr('disabled', 'disabled');
				}else{
					$('#hora').removeAttr('disabled', 'disabled');
					$('#hora').load('Consultas/ObtieneHora.php?medico=' + $('#medico').val());
				}
		});
	});
</script>

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->

<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="dist/js/demo.js"></script>


</body>
</html>
