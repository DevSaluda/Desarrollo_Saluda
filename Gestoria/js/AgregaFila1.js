var campos_max          = 1;   //max de 10 campos
var x = 0;
$('#add_field').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x < campos_max) {
                $('#parte2').append('<div>\
                <a class="btn btn-warning btn-sm" id="remover_campo">Remover</a>\
              <div class="row">\
    <div class="col">\
    <label for="exampleFormControlInput1">Codigo barras <span class="text-danger">*</span></label>\
    <input class="form-control"  hidden type="text" id="fkid2" name="pro_FKID[]"/>\
    <input class="form-control"   hidden type="text" id="clavad2" name="pro_clavad[]"/>\
    <input class="form-control"  hidden type="text" id="identificadortip2" name="IdentificadorTip[]"/>\
    <input type="text" class="form-control " readonly id="codbarras2" name="CodBarras[]"  >\
</div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Nombre prod <span class="text-danger">*</span></label>\
  <textarea class="form-control" readonly id="nombreprod2"name="NombreProd[]" rows="3"></textarea>\
    </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Lote <span class="text-danger">*</span></label>\
  <input type="text" class="form-control" readonly type="text" id="lote2"name="pro_lote[]" placeholder="Ingrese minimo de existencia" aria-describedby="basic-addon1" ></div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Costo venta<span class="text-danger">*</span></label>\
    <input  class="form-control" type="number" readonly id="precioprod2"  name="pro_cantidad[]" > </div>\
    <div class="col">\
    <label for="exampleFormControlInput1">Importe<span class="text-danger">*</span></label>\
  <input  class=" form-control" readonly type="number" id="costoventa2"  > </div>\
   <div class="col">\
    <label for="exampleFormControlInput1">Cantidad<span class="text-danger">*</span></label>\
<input   class="form-control"  id="cantidad2" type="number" name="CantidadTotal[]" value="1" > </div>\
<input type="text" hidden class="form-control "  name="Sucursaleventas[]"readonly value="<?echo $row['Fk_Sucursal']?>">\
<input type="text"  hidden class="form-control "  name="Empresa[]" readonly value="<?echo $row['ID_H_O_D']?>" >\
<input type="text"  hidden class="form-control "  name="Sistema[]" readonly value="Ventas" >\
<input type="text" class="form-control " hidden id="valcaja"name="CajaSucursal[]" readonly value="<?php echo $ValorCaja["ID_Caja"];?>" >\
<input type="text" hidden class="form-control " name="Vendedor[]" readonly value="<?echo $row['Nombre_Apellidos']?>" >\
</div>');
                x++;
        }
}); 
// Remover o div anterior
$('#parte2').on("click","#remover_campo",function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
        $("#FiltrarContenido2").hide()
    $("#FiltrarContenido").show()
});