<!-- Central Modal Medium Info -->
<div class="modal fade" id="AltaProductos" tabindex="-100" role="dialog" aria-labelledby="myModalLabel"
   aria-="true" style="overflow-y: scroll;">
   <div class="modal-dialog modal-lg modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Alta de nuevo producto</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-="true" class="white-text">&times;</span>
         </button>
       </div>
       <div class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span class="text-semibold">Estimado usuario, </span>
                            los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
         <form enctype="multipart/form-data" id="AgregaProductos">
       
 
   
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  
<div class="ui-widget">
  <input type="text" class="form-control " id="codbarrap" name="CodBarraP"  style="z-index:100;"placeholder="Escanee o ingrese código" >
    </div>
    </div>
    
    <div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Clave adicional <span class="text-info">Opcional</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " name="Clav" id="clav"  placeholder="Ingrese código" aria-describedby="basic-addon1" maxlength="60">            
</div><label for="clav" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Nombre / Descripcion <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-pencil-alt"></i></span>
  </div>
  <textarea class="form-control" id="nombre_prod" name="Nombre_Prod" rows="3"></textarea>
 
    </div><label for="nombreprod" class="error">
    </div>
</div>


<!-- PRIMERA TANDA -->

<div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Lote <span class="text-info">Opcional</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " name="LoteProd" id="loteprod"  placeholder="Ingrese código" aria-describedby="basic-addon1" maxlength="60">            
</div><label for="clav" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad <span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-pencil-alt"></i></span>
  </div>
  <input type="text" class="form-control " name="FechaCaducidad" id="fechacaducidad"  placeholder="Ingrese código" aria-describedby="basic-addon1" maxlength="60">        
 
    </div><label for="nombreprod" class="error">
    </div>
</div>
<div class="row">
    <div class="col">
      
    <label for="exampleFormControlInput1">Minimo / Maximo existencias<span class="text-info">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " name="Minimo" id="minimo"  placeholder="Ingrese código" aria-describedby="basic-addon1" maxlength="60"> 
  <input type="text" class="form-control " name="Maximo" id="maximo"  placeholder="Ingrese código" aria-describedby="basic-addon1" maxlength="60">            
</div><label for="clav" class="error"></div>
<div class="col">
    <label for="exampleFormControlInput1">Cantidad de ingreso<span class="text-danger">*</span></label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-pencil-alt"></i></span>
  </div>
  <input type="text" class="form-control " name="IngresoCantidad"  placeholder="Ingresa cantidad" aria-describedby="basic-addon1" maxlength="60">        
 
    </div><label for="nombreprod" class="error">
    </div>
</div>
    
  

   
    

   </div>
   <input type="text" class="form-control " hidden name="ID_Prod_Prod"  id="id_prod_prod"  >  
   <input type="text" class="form-control " hidden name="CodigosDeBarras"  id="codigosdebarras"  >   
   <input type="text" class="form-control " hidden name="PrecioCom"  id="preciocom"  >   
   <input type="text" class="form-control " hidden name="PrecioVen"  id="precioven"  >
   <input type="text" class="form-control " hidden name="Categoria"  id="categoria"  >
   <input type="text" class="form-control " hidden name="Marca"  id="marca"  >
   <input type="text" class="form-control " hidden name="Tipo"  id="tipo"  >   
   <input type="text" class="form-control " hidden name="Presentacion"  id="presentacion"  >
   <input type="text" class="form-control " hidden name="RevProvee1"  id="revprovee1"  >   
    <input type="text" class="form-control " hidden name="RevProvee2"  id="revprovee2"  >   
    <input type="text" class="form-control " hidden name="EmpresaProductos" id="empresa"  value="<?echo $row['ID_H_O_D']?>"aria-describedby="basic-addon1" >       
    <input type="text" class="form-control"  hidden name="Sucursale" id="sucursale"  readonly value=" <?echo $row['Fk_Sucursal']?>">
    <input type="text" class="form-control"  hidden name="AgregaProductosBy" id="agrega"  readonly value=" <?echo $row['Nombre_Apellidos']?>">
    <input type="text" class="form-control"  hidden name="SistemaProductos" id="sistema"  readonly value=" POS <?echo $row['Nombre_rol']?>">
    
   

  

       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
       <button type="submit"   id="EnviarDatos" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                                        </form>
         
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 </div>


 <script type="text/javascript">
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
 