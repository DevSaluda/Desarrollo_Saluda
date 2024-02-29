<?php
  // Obteniendo la fecha actual del sistema con PHP
  $fechaActual = date("Y-m-d",strtotime("+ 1 days"));
 
 $fechafinalcargasemama = date("Y-m-d",strtotime($fechaActual."+ 7 days"));
 $fechafinalcargames = date("Y-m-d",strtotime($fechaActual."+ 30 days"))
?>

<div class="modal fade" id="ProgramacionExt" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-lg modal-notify modal-primary">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Nueva programación</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div class="alert alert-success alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                          
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
      <div class="modal-body">
 
 <form action="javascript:void(0)" method="post" id="ProgramaEnSucursalesExt">

 <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-laptop-house"></i></span>
  </div>
  <select id = "sucursal" class = "form-control" name = "Sucursal"  >
                                               <option value="">Seleccione una Sucursal:</option>
        <?php
          $query = $conn -> query ("SELECT ID_SucursalC,Nombre_Sucursal,ID_H_O_D FROM SucursalesCorre WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Nombre_Sucursal !='Matriz'");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["ID_SucursalC"].'">'.$valores["Nombre_Sucursal"].'</option>';
          }
        ?>  </select>
  
         
    </div><label for="nombreprod" class="error">
    </div>
    
  
<div class="col">

<label for="exampleFormControlInput1">Especialidad<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  
  <select id="especialidadext"    class = "form-control" disabled = "disabled" >
                                               <option value="">Seleccione una especialidad:</option>
       </select>
                           
         
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">

<label for="exampleFormControlInput1">Médico<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user-md"></i></span>
  </div>
  <select  id = "medicoext" name = "MedicoExt"  class = "form-control" disabled = "disabled" >
								<option value = "">Selecciona un médico</option>
							</select>
                           
         
    </div><label for="nombreprod" class="error">
    </div>
</div>

<div class="text-center">
<!-- Default switch --><label for="exampleFormControlInput1">Tipo de programacion<span class="text-danger">*</span></label>
<div class="row">
    <div class="col">
<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="Dia"  >
  <label class="Dia custom-control-label" for="Dia">Dia <i class="fas fa-calendar-day"></i></label>
</div></div>
<div class="col">
<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="Semanal">
  <label class="custom-control-label" for="Semanal">Semanal <i class="fas fa-calendar-week"></i></label>
</div>
</div>
<div class="col">
<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="Mensual">
  <label class="custom-control-label" for="Mensual">Mensual <i class="fas fa-calendar-alt"></i></label>
</div>
</div>
</div>
<!-- INICIA FORM DE CARGA POR DIA -->
<br>
<div id="cargapordia" style="display: none;">
<div class="row">
    
    
  
<div class="col">

<label for="exampleFormControlInput1">Fecha <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-calendar-check"></i></span>
  </div>

  <input type="date" class="form-control " value="<?php echo $fechaActual?>" name="" id="fechapordia" min="<?php echo $fechaActual?>" >
  <input type="date" class="form-control "  value="<?php echo $fechaActual?>" name="" id="fechapordiafin"  >
    </div><label for="nombreprod" class="error">
    </div>

    <div class="col">

<label for="exampleFormControlInput1">Intervalo de tiempo entre citas<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-stopwatch"></i></span>
  </div>
 
  <input type="number" class="form-control " name="" id="timecitas" >
    </div><label for="nombreprod" class="error">
    </div>
  
</div>

<div class="row">
    
    
  
<div class="col">


<label for="exampleFormControlInput1">Hora inicio<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-hourglass-start"></i></span>
  </div>
  <input type="tipoprogramasemana" class="form-control " hidden id="tipodia" name="" value="Dia" >
  <input type="time" class="form-control " name="" id="timeiniciadia" >
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">


<label for="exampleFormControlInput1">Hora fin<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-hourglass-end"></i></span>
  </div>
 
  <input type="time" class="form-control " name="" id="timefindia" >
    </div><label for="nombreprod" class="error">
    </div>
   
</div>
</div>
<!-- FIN FORM DE CARGA POR DIA -->

<!-- INICIA FORM DE CARGA POR SEMANA -->
<div id="cargaporsemana" style="display: none;">
<div class="row">
    
    
  
<div class="col">

<label for="exampleFormControlInput1">Fecha inicio<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="date" class="form-control " value="<?php echo $fechaActual?>" name="" id="fechasemana1" >
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">

<label for="exampleFormControlInput1">Fecha fin<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="date" class="form-control " name=""  value="<?php echo $fechafinalcargasemama?>"  id="fechasemana2" >
    </div><label for="nombreprod" class="error">
    </div>
    
  
</div>

<div class="row">
    
    
  
<div class="col"> 


<label for="exampleFormControlInput1">Hora inicio<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " hidden id="tipoprogramasemana" name="" value="Semanal" >
  <input type="time" class="form-control " name="" id="timeiniciasemana" >
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">


<label for="exampleFormControlInput1">Hora fin<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
 
  <input type="time" class="form-control " name="" id="timefinsemana" >
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">


<label for="exampleFormControlInput1">Intervalo entre citas<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
 
  <input type="number" class="form-control " name="" id="timecitassemana" >
    </div><label for="nombreprod" class="error">
    </div>
</div>
</div>

<!-- FIN FORM DE CARGA POR SEMANA -->


<!-- INICIA FORM DE CARGA POR MES -->
<div id="cargapormes" style="display: none;">
<div class="row">
    
    
  
<div class="col">

<label for="exampleFormControlInput1">Fecha inicio<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="date" class="form-control " value="<?php echo $fechaActual?>" name="" id="fechasmes1" >
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">

<label for="exampleFormControlInput1">Fecha fin<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  
  <input type="date" class="form-control " name=""  value="<?php echo $fechafinalcargames?>"  id="fechasmes2" >
    </div><label for="nombreprod" class="error">
    </div>
    
  
</div>
<div class="row">
    
    
  
<div class="col"> 


<label for="exampleFormControlInput1">Hora inicio<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
  <input type="text" class="form-control " hidden id="tipoprogramames" name="" value="Mensual" >
  <input type="time" class="form-control " name="" id="timeiniciames" >
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">


<label for="exampleFormControlInput1">Hora fin<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
 
  <input type="time" class="form-control " name="" id="timefinmes" >
    </div><label for="nombreprod" class="error">
    </div>
    <div class="col">


<label for="exampleFormControlInput1">Intervalo entre citas<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-at"></i></span>
  </div>
 
  <input type="number" class="form-control " name="" id="timecitasmes" >
    </div><label for="nombreprod" class="error">
    </div>
</div>
</div>
 
<!-- FIN FORM DE CARGA POR MES -->

<input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<?php echo $row['ID_H_O_D']?>" >

<input type="text" class="form-control" id="sistema" name="Sistema" hidden   value="Agenda de citas" >

<input type="text" class="form-control" id="estatus" name="Estatus" hidden   value="Autorizar Fechas" >
<input type="text" class="form-control" id="usuario" name="Usuario" hidden  value="<?php echo $row['Nombre_Apellidos']?>" >   
         
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        

      </div>
    </div>
  </div>
</div></div></div>


<script type="text/javascript">
   $(document).ready(function(){
    $("#Dia").click(function(){
        $("#cargapordia").slideToggle();
        $("#fechasemana1").attr('name','');
              $("#fechasemana2").attr('name','');
              $("#timecitassemana").attr('name','');
              $("#Dia").attr('id','desactivardia');
              $(".Dia").attr('for','desactivardia');
              $("#fechapordia").attr('name','FechaApertura');
              $("#fechapordiafin").attr('name','FechaFin');
              $("#timecitas").attr('name','TimerCitas');
              $("#timeiniciadia").attr('name','HoraInicial');
              $("#timefindia").attr('name','HoraFinal');
              $("#tipodia").attr('name','TipoProgramacion');
    });
});

$(document).ready(function(){
    $("#Semanal").click(function(){
      
        $("#cargaporsemana").slideToggle();
        $("#fechapordia").attr('name','');
              $("#timecitas").attr('name','');
              $("#desactivardia").attr('id','Dia');
              $(".Dia").attr('for','Dia');
              $("#fechasemana1").attr('name','FechaApertura');
              $("#fechasemana2").attr('name','FechaFin');
              $("#timeiniciasemana").attr('name','HoraInicial');
              $("#timefinsemana").attr('name','HoraFinal');
                $("#timecitassemana").attr('name','TimerCitas');
                $("#tipoprogramasemana").attr('name','TipoProgramacion');
    });
});

$(document).ready(function(){
    $("#Mensual").click(function(){
      
        $("#cargapormes").slideToggle();
        $("#fechapordia").attr('name','');
              $("#timecitas").attr('name','');
              $("#desactivardia").attr('id','Dia');
              $(".Dia").attr('for','Dia');
              $("#fechasmes1").attr('name','FechaApertura');
              $("#fechasmes2").attr('name','FechaFin');
              $("#timeiniciames").attr('name','HoraInicial');
              $("#timefinmes").attr('name','HoraFinal');
                $("#timecitasmes").attr('name','TimerCitas');
                $("#tipoprogramames").attr('name','TipoProgramacion');
    });
});
</script>
