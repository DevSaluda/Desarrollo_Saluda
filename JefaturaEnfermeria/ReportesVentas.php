<?php
include "Consultas/Consultas.php";


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Generar reportes |
    <?php echo $row['ID_H_O_D']?>
  </title>

  <?php include "Header.php"?>
  <style>
    .error {
      color: red;
      margin-left: 5px;

    }
  </style>
</head>
<?php include_once ("Menu.php")?>
<div class="card text-center">
  <div class="card-header" style="background-color:#0057b8 !important;color: white;">
    Generar reportes para
    <?php echo $row['ID_H_O_D']?>
  </div>

  <!-- <div>
    <a href="Reportegeneral.php" target="blank_" data-target="#AltaEmpleado" class="btn btn-primary">
      Descargar reporte general <i class="fas fa-download"></i>
    </a>
  </div> -->
</div>


<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  
<li class="nav-item">
    <a class="nav-link active" id="reportered" data-toggle="pill" href="#ConRedRepor" role="tab" aria-controls="pills-home" aria-selected="true"><i class="fas fa-file-excel"></i> Reportes de sistema en linea <i class="fas fa-globe"></i></a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link" id="reportesinred" data-toggle="pill" href="#SinRedRepor" role="tab" aria-controls="pills-profile" aria-selected="false"><i class="fas fa-file-excel"></i> Reportes de sistema sin internet <i class="fas fa-sync"></i></a>
  </li> -->
</ul>

<div class="container">
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="ConRedRepor" role="tabpanel" aria-labelledby="pills-home-tab">
     
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <!-- <li class="nav-item">
    <a class="nav-link active" id="reportegeneral" data-toggle="pill" href="#reportegeneral" role="tab" aria-controls="pills-home" aria-selected="true">Reporte General <i class="fas fa-file-invoice"></i></a>
  </li> -->
  <li class="nav-item">
    <a class="nav-link" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Reporte por sucursal <i class="fas fa-hospital-alt"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Reporte por vendedor <i class="fas fa-user"></i></a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Reporte por tipo de servicio</a>
  </li> -->
</ul>


<style>
#Tarjeta2
{
  background-color: #00c851;
    color: white;
}
</style>
<div class="tab-content" id="pills-tabContent">
<!-- <div class="tab-pane fade " id="reportegeneral" role="tabpanel" aria-labelledby="pills-home-tab"> -->
  <!-- <form action="ReporteGeneralDeSucursales.php" target="blank_" method="post" id="AgendaNuevoPaciente" >


<div class="text-center" >
<div class="row">
    
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-day"></i></span>
  </div>
  <input type="date" name="FechaInicialGeneral" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-minus"></i></span>
  </div>
  <input type="date" name="FechaFinalGeneral" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    
    </div>
              
  
 

    <input type="text" class="form-control" name="UsuarioMaestro" id="usuario"  value="<?php echo $row['Nombre_Apellidos']?>"  hidden readonly >
   
    <input type="text" class="form-control" name="Sistema" id="sistema"  value="Farmacia" hidden  readonly >
    <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?php echo $row['ID_H_O_D']?>" hidden  readonly >

    
<button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Generar Reporte <i class="fas fa-file-import"></i></button>
</div>                    
</form>
</div> -->
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
  <form action="ReportePorSucursal.php" target="blank_" method="post" id="AgendaNuevoPaciente" >


<div class="text-center" >
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-hospital-alt"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal"  onchange="sucursaldereporte();">
         <option value="">Seleccione una Sucursal:</option>
          <?php
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE ID_H_O_D='".$row['ID_H_O_D']."'");
        
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
                        ?>
         </select>
</div>
<label for="sucursal" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-day"></i></span>
  </div>
  <input type="date" name="FechaInicial" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-minus"></i></span>
  </div>
  <input type="date" name="FechaFinal" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    
    </div>
              
  
 <script>
 function sucursaldereporte(){
var combo = document.getElementById("sucursal");
var selected = combo.options[combo.selectedIndex].text;
$("#sucursalporsucursal").val(selected);
}

 </script>

    <input type="text" class="form-control" name="UsuarioPorSucursal" id="usuario"  value="<?php echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="SucursalPorSucursal" id="sucursalporsucursal"    hidden readonly >
    <input type="text" class="form-control" name="Sistema" id="sistema"  value="Farmacia" hidden  readonly >
    <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?php echo $row['ID_H_O_D']?>" hidden  readonly >

    
<button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Generar Reporte <i class="fas fa-file-import"></i></button>
</div>                    
</form>
</div>
 <!-- REPORTE SUCURSALES FIN -->




 <!-- REPORTE VENDEDORES -->
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  
  <form action="ReportePorVendedor.php" target="blank_" method="post" id="AgendaNuevoPaciente" >


<div class="text-center" >

<div class="row">
<div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-hospital-alt"></i></span>
  </div>
  <select id = "sucursalvendedor" class = "form-control" >
                                               <option value="">Seleccione una Sucursal:</option>
        <?php
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Nombre_Sucursal !='Matriz'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>
</div>
<label for="sucursal" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Vendedor</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="far fa-address-card"></i></span>
  </div>
 
         <select id = "vendedor" class = "form-control" name = "Vendedor"  onchange="vendedordereporte();" disabled = "disabled" >
								<option value = "">Seleccione un vendedor</option>
							</select>
</div>
<label for="sucursal" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="far fa-address-card"></i></span>
  </div>
  <input type="date" name="FechaInicial" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="far fa-address-card"></i></span>
  </div>
  <input type="date" name="FechaFinal" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    
    </div>
              
  
 <script>
 function vendedordereporte(){
var combo = document.getElementById("vendedor");
var selected = combo.options[combo.selectedIndex].text;
$("#vendedorporvendedor").val(selected);
}

 </script>

    <input type="text" class="form-control" name="UsuarioPorSucursal" id="usuario"  value="<?php echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="VendedorPorVendedor" id="vendedorporvendedor"    hidden readonly >
    <input type="text" class="form-control" name="Sistema" id="sistema"  value="Farmacia" hidden  readonly >
    <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?php echo $row['ID_H_O_D']?>" hidden  readonly >

    
<button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Generar Reporte <i class="fas fa-file-import"></i></button>
</div>                    
</form>
  </div>
  <!-- <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div> -->
</div>
</div>
<!-- AREA DE REPORTES SIN INTERNET -->
<!-- <div class="tab-pane fade" id="SinRedRepor" role="tabpanel" aria-labelledby="pills-profile-tab">
<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home-sinred" role="tab" aria-controls="pills-home" aria-selected="true">Reporte por sucursal <i class="fas fa-hospital-alt"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile-sinred" role="tab" aria-controls="pills-profile" aria-selected="false">Reporte por vendedor <i class="fas fa-user"></i></a>
  </li> -->
  <!-- <li class="nav-item">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Reporte por tipo de servicio</a>
  </li> -->
<!-- </ul>


<style>
#Tarjeta2
{
  background-color: #00c851;
    color: white;
}
</style>
<div class="tab-content" id="pills-tabContent">
  <div class="tab-pane fade show active" id="pills-home-sinred" role="tabpanel" aria-labelledby="pills-home-tab">
  <form action="ReportePorSucursalSinRed.php" target="blank_" method="post" id="AgendaNuevoPaciente" >


<div class="text-center" >
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-hospital-alt"></i></span>
  </div>
  <select id = "sucursalsinred" class = "form-control" name = "SucursalSinRed"  onchange="sucursaldereportesinred();">
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Nombre_Sucursal !='Matriz'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>
</div>
<label for="sucursal" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-day"></i></span>
  </div>
  <input type="date" name="FechaInicialSinRed" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-calendar-minus"></i></span>
  </div>
  <input type="date" name="FechaFinalSinRed" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    
    </div>
              
  
 <script>
 function sucursaldereportesinred(){
var combo = document.getElementById("sucursalsinred");
var selected = combo.options[combo.selectedIndex].text;
$("#sucursalporsucursalsinred").val(selected);
}

 </script>

    <input type="text" class="form-control" name="UsuarioPorSucursalSinRed" id="usuario"  value="<?echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="SucursalPorSucursalSinRed" id="sucursalporsucursalsinred"    hidden readonly >
    <input type="text" class="form-control" name="SistemaSinRed" id="sistema"  value="Farmacia" hidden  readonly >
    <input type="text" class="form-control" name="EmpresaSinRed" id="empresa"  value="<?echo $row['ID_H_O_D']?>" hidden  readonly >

    
<button type="submit"  name="reportesinred" id="reportesfueradered"  class="btn btn-success">Generar Reporte <i class="fas fa-file-import"></i></button>
</div>                    
</form>
</div> -->
 <!-- REPORTE SUCURSALES FIN -->




 <!-- REPORTE VENDEDORES -->
  <!-- <div class="tab-pane fade" id="pills-profile-sinred" role="tabpanel" aria-labelledby="pills-profile-tab">
  
  <form action="ReportePorVendedorSinRed.php" target="blank_" method="post" id="reportevendedorsinred" >


<div class="text-center" >

<div class="row">
<div class="col">
    <label for="exampleFormControlInput1">Sucursal</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="fas fa-hospital-alt"></i></span>
  </div>
  <select id = "sucursalvendedoroff" class = "form-control" >
                                               <option value="">Seleccione una Sucursal:</option>
        <?
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Nombre_Sucursal !='Matriz'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
          }
        ?>  </select>
</div>
<label for="sucursal" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Vendedor</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="far fa-address-card"></i></span>
  </div>
 
         <select id = "vendedoroff" class = "form-control" name = "Vendedoroff"  onchange="vendedordereportesinred();" disabled = "disabled" >
								<option value = "">Seleccione un vendedor</option>
							</select>
</div>
<label for="sucursal" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha inicio</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="far fa-address-card"></i></span>
  </div>
  <input type="date" name="FechaInicialoff" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Fecha fin</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta2"><i class="far fa-address-card"></i></span>
  </div>
  <input type="date" name="FechaFinaloff" id="" class="form-control">
</div>
<label for="especialidad" class="error">
    </div>
    
    </div>
              
  
 <script>
 function vendedordereportesinred(){
var combo = document.getElementById("vendedoroff");
var selected = combo.options[combo.selectedIndex].text;
$("#vendedorporvendedoroff").val(selected);
}

 </script>

    <input type="text" class="form-control" name="UsuarioPorSucursaloff" id="usuario"  value="<?echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="VendedorPorVendedoroff" id="vendedorporvendedoroff"    hidden readonly >
    <input type="text" class="form-control" name="Sistema" id="sistema"  value="Farmacia" hidden  readonly >
    <input type="text" class="form-control" name="Empresa" id="empresa"  value="<?echo $row['ID_H_O_D']?>" hidden  readonly >

    
<button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Generar Reporte <i class="fas fa-file-import"></i></button>
</div>                    
</form>
  </div> -->
  <!-- <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div> -->
</div>
</div>

</div>
</div>
    


<!-- /.content-wrapper -->

<!-- Control Sidebar -->

<!-- Main Footer -->
<?php
    
  include ("footer.php")?>


<script src="js/ObtieneVendedor.js"></script>
<script src="js/ObtieneVendedorOff.js"></script>

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