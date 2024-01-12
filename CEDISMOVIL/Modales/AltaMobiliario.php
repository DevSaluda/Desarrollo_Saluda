
  
      <div class="modal fade bd-example-modal-xl" id="AltaMobiliarioNuevo" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Añadiendo nuevo mobiliario</p>

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
     
 <form action="javascript:void(0)" method="post" id="AgregaStockMobiliario">

 <div class="form-group" id="listas">
 <label for="exampleFormControlInput1">Codigo mobiliario <span class="text-danger">Escanear o ingresar *</span> </label>
 <button type="button" class="btn btn-primary btn-sm"id="add_field" >Agregar mas codigos</button>
    <div class="input-group mb-3" >
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " autofocus id="codbarramobi" name="CodBarraMobi[]"  maxlength="60">
  <input type="text" class="form-control "   autofocus id="codbarrauni" name="CodBarraUnico" placeholder="Escanea el codigo"  maxlength="60">
 
    </div>
    <input class="miOpcion" type="checkbox" value="1" onclick="tengoQueMostrarBoton()" /> Codigo unico
  </div>
 
 
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Nombre de mobiliario<span class="text-danger">*</span> </label>
    <input type="text" id="namembb" name="NameBB" class="form-control">
    </div>
      
    <div class="col">
<label for="exampleFormControlInput1">Tipo de mobiliario <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-archive"></i></span>
  </div>
  <select id = "tipomobbb" class = "form-control" name = "TipoMobbb">
                                               <option value="">Seleccione un tipo:</option>
        <?
          $query = $conn -> query ("SELECT 	Tip_Mob_ID,Nom_Tip_Mob FROM Tipos_Mobiliarios_POS WHERE  ID_H_O_D='".$row['ID_H_O_D']."' AND Estado='Vigente' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Tip_Mob_ID].'">'.$valores[Nom_Tip_Mob].'</option>';
          }
        ?>  </select>
             </div><div><label for="vigencia" class="error">
</div>
</div> </div> 
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-list-ol"></i></span>
  </div>
 <input type="number" id="cantidadmb" name="Cantidadmb" class="form-control">
             </div>
    </div>
      
    <div class="col">
<label for="exampleFormControlInput1">Fecha de ingreso <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar"></i></span>
  </div>
 <input type="datetime" id="fingreso" name="FechaIngreso" value="<?php echo $fcha;?>" readonly class="form-control">
             </div><div><label for="vigencia" class="error">
</div>
</div> </div> 
<div class="form-group">
    <label for="exampleFormControlTextarea1">Descripcion</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name="Descripcion" rows="3"></textarea>
  </div>
  <input type="text" class="form-control " hidden  readonly id="estadombb" name="EstadoMBB" readonly value="En inventario">
  <input type="text" class="form-control " hidden  readonly id="codestadobb" name="CodEstadoMBB" readonly value="background-color:#007bff!important;">

<input type="text" class="form-control " hidden  readonly id="usuariombb" name="UsuarioMBB" readonly value="<?echo $row['Nombre_Apellidos']?>">
<input type="text" class="form-control "  hidden  readonly id="sistemambb" name="SistemaMBB" readonly value="POS <?echo $row['Nombre_rol']?>">
<input type="text" class="form-control "  hidden id="empresambb" name="EmpresaMBBB" readonly value="<?echo $row['ID_H_O_D']?>">
  <div>
   
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  <style>
  #codbarrauni {
  display: none;
}
  </style>

<script>
  var campos_max          = 30;   //max de 10 campos

var x = 0;
$('#add_field').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x < campos_max) {
                $('#listas').append('<div>\
                <input type="text" class="form-control " autofocus id="codbarramobi" name="CodBarraMobi[]"  maxlength="60">\
                        <a class="btn btn-warning btn-sm" id="remover_campo">Remover</a>\
                        </div>');
                x++;
        }
});
// Remover o div anterior
$('#listas').on("click","#remover_campo",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
});

</script>
  <script type="text/javascript">
  
  function tengoQueMostrarBoton() {
  var elementos = $('input.miOpcion');
  var algunoMarcado = elementos.toArray().find(function(elemento) {
     return $(elemento).prop('checked');
  });
  
  if(algunoMarcado) {
    $('#codbarrauni').show();
    $('#codbarramobi').hide();
    $('#add_field').hide();
   
  } else {
    $('#codbarrauni').hide();
    $('#codbarramobi').show();
    $('#add_field').show();
  }
}
</script>

 