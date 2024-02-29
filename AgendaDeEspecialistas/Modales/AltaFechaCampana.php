<div class="modal fade" id="AltaFecha" tabindex="-1" role="dialog" aria-labelledby="newModalLabel" aria-hidden="true">
<div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Alta de sucursal para campañas medicas</p>

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
     
      <form action="javascript:void(0)" method="post" id="ajax-form">
    
    <label for="exampleFormControlInput1">Sucursal</label>
        <div class="input-group mb-3">
     <div class="input-group-prepend">
     
       <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
     </div>
     <select id = "sucursal" class = "form-control" name = "Sucursal">
                                                  <option value="">Seleccione una Sucursal:</option>
           <?
             $query = $mysqli -> query ("SELECT 	ID_SucursalC,Nombre_Sucursal FROM Sucursales_CampañasV2 WHERE Estatus_Sucursal = 'Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."'");
             while ($valores = mysqli_fetch_array($query)) {
               echo '<option value="'.$valores[ID_SucursalC].'">'.$valores[Nombre_Sucursal].'</option>';
             }
           ?>  </select>
            
   </div>
   <label for="exampleFormControlInput1">Especialidad </label>
        <div class="input-group mb-3">
     <div class="input-group-prepend">
     
       <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
     </div>
     <select  id = "especialidad" name = "Especialidad"  class = "form-control " disabled = "disabled" >
                   <option value = "">Selecciona una especialidad</option>
                 </select>
   </div>
   <label for="exampleFormControlInput1">Medico Especialista</label>
        <div class="input-group mb-3">
     <div class="input-group-prepend">
     
       <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
     </div>
     <select  id = "medico" name = "Medico"  class = "form-control"  disabled = "disabled" >
                   <option value = "">Selecciona un medico</option>
                 </select>
   </div>
   
   <br>
   <div id="listas">
   <label for="exampleFormControlInput1">Fecha de citas</label>
   <button type="button" class="btn btn-primary btn-sm"id="add_field" >Agregar mas fechas</button>
        <div class="input-group mb-3">
     <div class="input-group-prepend">
     
       <span class="input-group-text" id="Tarjeta"><i class="far fa-address-card"></i></span>
     </div> <input type="date" class="form-control" name="Fecha[]" id="fecha"  aria-describedby="basic-addon1"></div>
     </div>
   </div>
   
   
   <input type="text" class="form-control" id="empresa" name="Empresa" hidden   value="<? echo $row['ID_H_O_D']?>" >
   <input type="text" class="form-control" id="usuario" name="Usuario"  hidden value="<? echo $row['Nombre_Apellidos']?>" >
   <input type="text" class="form-control" id="estatus" name="Estatus" hidden   value="Vigente" >
   <input type="text" class="form-control" id="color" name="Color" hidden   value="background-color:#b87455 !important" >              
                 <div> 
         <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
                                           </form>
                                          
                                           </div>
         </div>
       </div>
     </div>
   </div></div>
<script>
  var campos_max          = 30;   //max de 10 campos

var x = 0;
$('#add_field').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x < campos_max) {
                $('#listas').append('<div>\
                        <input type="date" class="form-control" name="Fecha[]" id="fecha"  aria-describedby="basic-addon1">\
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