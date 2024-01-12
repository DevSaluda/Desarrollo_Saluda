<?
include "../Consultas/db_connection.php";
include "../Consultas/Consultas.php";
include "../Consultas/Sesion.php";
$user_id=null;
$sql1= "SELECT Productos_POS.ID_Prod_POS,Productos_POS.Clave_adicional,Productos_POS.Nombre_Prod,Productos_POS.Fk_sucursal,Productos_POS.Precio_Venta,
Productos_POS.Precio_C,Productos_POS.Max_Existencia,Productos_POS.Min_Existencia,Productos_POS.Tipo,Productos_POS.FkCategoria,
Productos_POS.FkMarca,Productos_POS.FkPresentacion,
Productos_POS.Proveedor1,Productos_POS.Proveedor2,
Productos_POS.ID_H_O_D,SucursalesCorre.ID_SucursalC,SucursalesCorre.Nombre_Sucursal,TipProd_POS.Tip_Prod_ID,TipProd_POS.Nom_Tipo_Prod,
Categorias_POS.Cat_ID,Categorias_POS.Nom_Cat,
Marcas_POS.Marca_ID,Marcas_POS.Nom_Marca,Presentacion_Prod_POS.Pprod_ID,Presentacion_Prod_POS.Nom_Presentacion 
FROM Productos_POS,SucursalesCorre,TipProd_POS,Categorias_POS,Marcas_POS,Presentacion_Prod_POS
WHERE Productos_POS.Fk_sucursal= SucursalesCorre.ID_SucursalC AND Productos_POS.Tipo=TipProd_POS.Tip_Prod_ID AND Productos_POS.FkCategoria=
Categorias_POS.Cat_ID AND Productos_POS.FkMarca= Marcas_POS.Marca_ID AND Productos_POS.FkPresentacion= Presentacion_Prod_POS.Pprod_ID AND 
Productos_POS.ID_H_O_D ='".$row['ID_H_O_D']."' AND  Productos_POS.ID_Prod_POS = ".$_POST["id"];
$query = $conn->query($sql1);
$Especialistas = null;
if($query->num_rows>0){
while ($r=$query->fetch_object()){
  $Especialistas=$r;
  break;
}

  }
?>
<? if($Especialistas!=null):?>
  <form enctype="multipart/form-data" id="AgregaEnStockProductos">
         <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Folio de producto <span class="text-danger">AUTOGENERADO</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " disabled >
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Nombre del producto </label> <br>
   
  <? echo $Especialistas->Nombre_Prod; ?> 
<label for="clav" class="error"></div>
</div>
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Lote <span class="text-danger">*</span> </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="Lote" id="lote">
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Fecha de caducidad <span class="text-info">Opcional</span></label>
    <input type="date" class="form-control " name="FCA" id="fca">
<label for="clav" class="error"></div>
</div>

<div class="form-group"  id="listas">
<label for="exampleFormControlInput1">Codigo de barras <span class="text-danger">*</span> </label>
<button type="button" class="btn btn-primary btn-sm"id="add_field" >Agregar</button>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control "  name="CODBARRA[]" id="codbarras">
    </div>
  </div>
<div class="table-responsive">
                        <table class="table">
  <thead>
    <tr>
    <th scope="col">Precio de venta</th>
      <th scope="col">Maximo</th>
      <th scope="col">Minimo</th>
      <th scope="col">Existencias</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td><input type="text" class="form-control " id="pvprod" name="PVProd" readonly value="<? echo $Especialistas->Precio_Venta; ?>" ></td>
      <td><? echo $Especialistas->Max_Existencia; ?></td>
      <td><? echo $Especialistas->Min_Existencia; ?></td>
      <td><input type="number" class="form-control" value="" placeholder="Ingresa cantidad de existencias" name="ExistenciasR" id="existencias"></td>
    </tr>
    
   
  </tbody>
</table>
                        </div>
<div class="table-responsive">
                        <table class="table">
  <thead>
    <tr>
    <th scope="col">Tipo</th>
      <th scope="col">Categoria</th>
      <th scope="col">Marca</th>
      <th scope="col">Presentacion</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    <td><? echo $Especialistas->Nom_Tipo_Prod; ?></td>
      <td><? echo $Especialistas->Nom_Cat; ?></td>
      <td><? echo $Especialistas->Nom_Marca; ?></td>
      <td><? echo $Especialistas->Nom_Presentacion; ?></td>
    </tr>
    
   
  </tbody>
</table>
                        </div>
                        <div class="table-responsive">
                        <table class="table">
  <thead>
    <tr>
    <th scope="col">Proveedor</th>
      <th scope="col">Proveedor</th>
    
    </tr>
  </thead>
  <tbody>
    <tr>
    <td><? echo $Especialistas->Proveedor1; ?></td>
      <td><? echo $Especialistas->Proveedor2; ?></td>
      
    </tr>
    
   
  </tbody>
</table>
                        </div>
                  
   
    

                        <input type="text" class="form-control " hidden id="idprod" name="IDProd" value="<? echo $Especialistas->ID_Prod_POS; ?> " >
                        <input type="text" class="form-control " hidden id="nameprod" name="NameProd" value="<? echo $Especialistas->Nombre_Prod; ?> " >
                      
      <input type="text" class="form-control " hidden id="maxprod" name="MaxProd" value="<? echo $Especialistas->Max_Existencia; ?> " >
      <input type="text" class="form-control " hidden id="minprod" name="MinProd" value="<? echo $Especialistas->Min_Existencia; ?> " >
   <input type="text" class="form-control " hidden id="tipo" name="Tipo" value="<? echo $Especialistas->Tipo; ?>" >
   
   <input type="text" class="form-control " hidden id="categoria" name="Categoria" value="<? echo $Especialistas->FkCategoria; ?>" >
   <input type="text" class="form-control " hidden id="marca" name="Marca"  value="<? echo $Especialistas->FkMarca; ?>" >
   <input type="text" class="form-control " hidden id="presentacion" name="Presentacion"  value="<? echo $Especialistas->FkPresentacion; ?>">
  
   <input type="text" class="form-control " hidden id="pc" name="PCProd" value="<? echo $Especialistas->Precio_C; ?>" >
   <input type="text" class="form-control " hidden name="Clavee" id="clav" value="<? echo $Especialistas->Clave_adicional; ?>">            
   <input type="text" class="form-control " hidden name="Sucursal" id="sucursal"  value="<? echo $Especialistas->Fk_sucursal; ?>" >
  
    <input type="text" class="form-control " hidden name="EmpresaProductos" id="empresa" value="<?echo $row['ID_H_O_D']?>"aria-describedby="basic-addon1" >       
    <input type="text" class="form-control " hidden name="RevProvee1"  id="revprovee1" value="<? echo $Especialistas->Proveedor1; ?>"  >   
    <input type="text" class="form-control " hidden name="RevProvee2"  id="revprovee2" value="<? echo $Especialistas->Proveedor2; ?>" >   
    <input type="text" class="form-control" hidden name="AgregaProductosBy" id="agrega" readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema"  readonly value=" POS <?echo $row['Nombre_rol']?>">
    
   

  

       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button  id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>
 <? else:?>
  <p class="alert alert-danger">404 No se encuentra</p>
<? endif;?>
<script src="js/AgregaProductosStock.js"></script>

<script>
  var campos_max          = 30;   //max de 10 campos

var x = 0;
$('#add_field').click (function(e) {
        e.preventDefault();     //prevenir novos clicks
        if (x < campos_max) {
                $('#listas').append('<div>\
                <input type="text" class="form-control "  name="CODBARRA[]" id="lote">\
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
$(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });
});
</script>
 <script type="text/javascript">

 
function teclas(event) {
    tecla=(document.all) ? event.keyCode : event.which;
    if (tecla==13 && event.altKey) {
        alert('holaaa');
    }
 
    return false;
}

 $(function(){
  $('#demo').multiselect();
});
 var div1 = document.getElementById('errorproveedor');
    	function verify(s1) {
        var combo = document.getElementById("proveedor1");
var selected = combo.options[combo.selectedIndex].text;
$("#revprovee1").val(selected);
var combo = document.getElementById("proveedor2");
var selected = combo.options[combo.selectedIndex].text;
$("#revprovee2").val(selected);
    		var s2;
    		for (var i=1;i<=3;i++) {
    			s2 = document.getElementById('proveedor' + i);
    			if (s1.value == s2.value && s1 != s2) {
            div1.style.display = 'block';
            document.getElementById("EnviarDatos").disabled = true
    				s1.options[0].selected = true;
    				return;
          }
          else{
            div1.style.display = 'none';
            document.getElementById("EnviarDatos").disabled = false
          }
    		}
    	}
    </script>
 <!-- Central Modal Medium Info-->
 