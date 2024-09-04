<div class="modal fade" id="VerificaHoras" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false"  aria-labelledby="newModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alta de horario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <span id="error_alta" class="alert alert-danger" style="display: none"></span>
        <p id="show_message" style="display: none">Form data sent. Thanks for your comments.We will update you within 24 hours. </p>
        <p id="show_error"  class="alert alert-danger" style="display: none">Algo salio mal </p>
      <div class="modal-body">
      <form action="javascript:void(0)" method="post" id="ajax-form">
 
  <input type="text" class="form-control" hidden readonly name="Especialista" id="especialista" value="<?php echo $_POST["Medico"];?>"  aria-describedby="basic-addon1">
  <input type="text" class="form-control" readonly hidden name="Fecha" id="fecha" value="<?php echo $_POST["Fecha"];?>"  aria-describedby="basic-addon1">
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Hora inicial </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="time" class="form-control" readonly name="Horainicio" id="horai" value="<?php echo $_POST["HoraInicio"];?>"  aria-describedby="basic-addon1">
</div>
    </div>
    <div class="col">
    <label for="exampleFormControlInput1">Hora final </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="time" class="form-control" readonly name="HoraFinal" id="horaf"  value="<?php echo $_POST["HoraFinal"];?>" aria-describedby="basic-addon1">
</div>

    </div>
  </div>

<label for="exampleFormControlInput1">Intervalo de tiempo entre citas </label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
  </div>
  <input type="number" readonly class="form-control" name="Intervalo" value="<?php echo $_POST["Intervalo"];?>" id="intervalo"  aria-describedby="basic-addon1">
</div>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    Mostrar horas
  </button>
<?php
$inicio = $_POST["HoraInicio"];;
$final = $_POST["HoraFinal"];;
$incr = $_POST["Intervalo"];; // Minutos

$date_obj = new DateTime($inicio);
$date_incr = $inicio;
while($date_incr < $final) {
    $date_incr = $date_obj->format('H:i:s');
    $date_incr;
    $date_obj->modify('+'.$incr.' minutes');

    echo 
    "<div class='collapse' id='collapseExample'>
  <div class='card card-body'>
     <input type='text' class='form-control' name='Horas[]' value='".$date_incr."'  > 
     </div>
</div>";
}
?>

<input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<? echo $row['ID_H_O_D']?>" >
<input type="text" class="form-control" id="estatus" name="Estatus" hidden   value="Activo" >
<input type="text" class="form-control" id="color" name="Color" hidden   value="btn btn-success btn-sm" >              
               
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        <br>
      <div class="modal-footer">
      <p class="statusMsg"></p>
     

      </div>
    </div>
  </div>
</div></div>
