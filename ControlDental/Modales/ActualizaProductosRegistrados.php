
<div class="modal fade" id="ActualizaRegistros" tabindex="-1" role="dialog" style="overflow-y: scroll;" aria-labelledby="editModalLabel" aria-hidden="true">
  <div id="Di"class="modal-dialog modal-lg modal-notify modal-success">
      <div class="modal-content">
      <div class="modal-header">
         <p class="heading lead" id="Titulo">Registro de productos</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
        <div id="Mensaje "class="alert alert-info alert-styled-left text-blue-800 content-group">
						                <span id="Aviso" class="text-semibold">Estimado usuario, 
                            Verifique los campos antes de realizar alguna accion</span>
						                <button type="button" class="close" data-dismiss="alert">×</button>
                            </div>
	        <div class="modal-body">
          <div class="text-center">
     
<form action="javascript:void(0)" method="post" id="RegistrosPorActualizar" >
<div class="text-center">
<div class="form-group">
    <label for="exampleFormControlInput1">Codigo o nombre de producto</label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  <span class="input-group-text" id="Tarjeta"><i class="fas fa-user"></i></span>
  </div>
  <input type="text" class="form-control"   name="" id="clavebusqueda" aria-describedby="basic-addon1">
</div>
    </div>
    
    
    
   
    
 
  
<!-- INICIA DATA DE AGENDA -->

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Codigo</label>
     <div class="input-group mb-3">
   
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " readonly id="codbarrap" name="CodBarraP" placeholder="Escanee o ingrese código" >
    </div>
 
</div>

   
    <div class="col">
    <label for="exampleFormControlInput1">Nombre Producto</label>
     <div class="input-group mb-3">
  
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <textarea class="form-control" readonly id="nameprod" name="NameProd" rows="3"></textarea>

    </div>
    </div>
</div>

<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Existencias</label>
     <div class="input-group mb-3">

  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>

  <input type="number" class="form-control " readonly id="existencias" name="Existencias" placeholder="Escanee o ingrese código" >
    </div>
 
</div>

  
<div class="col">
    <label for="exampleFormControlInput1">Nuevas Existencias</label>
     <div class="input-group mb-3">

  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>

  <input type="number" class="form-control "  oninput="cal()" id="existenciasnew" name="Existenciasnew" placeholder="Escanee o ingrese código" >
    </div>
 
</div>
    </div>
    
    <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Lote</label>
     <div class="input-group mb-3">
   
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="text" class="form-control " id="lote" name="Lote" placeholder="Escanee o ingrese código" >
    </div>
 
</div>

   
    <div class="col">
    <label for="exampleFormControlInput1">Fecha caducidad</label>
     <div class="input-group mb-3">
  
  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>
  <input type="date" class="form-control " id="fechacad" name="FechaCad"  >

    </div>
 
</div>

  
    <div class="col">
    <label for="exampleFormControlInput1">Total Existencias</label>
     <div class="input-group mb-3">

  <div class="input-group-prepend">  <span class="input-group-text" ><i class="fas fa-barcode"></i></span>
  </div>

  <input type="text" class="form-control "  readonly id="existenciasreales" name="ExistenciasReales" placeholder="Escanee o ingrese código" >
    </div>
 
</div>

    </div>   
    </div>   
    <input type="text" class="form-control" name="Usuario" id="usuario"  value="<?echo $row['Nombre_Apellidos']?>"  hidden readonly >
    <input type="text" class="form-control" name="Sistema" id="sistema"  value="<?echo $row['Nombre_rol']?>" hidden readonly >
    <input type="text" class="form-control" name="Folioporact" id="Folioporact"  hidden readonly >
    
<button type="submit"  name="submit_Age" id="submit_Age"  class="btn btn-success">Confirmar datos <i class="fas fa-user-check"></i></button>
    </div>    </div>
<!-- FINALIZA DATA DE AGENDA -->
                  
</form>


</div></div>




        
        </div>

      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <script>
    function cal() {
  try {
    var a = parseInt(document.getElementById("existencias").value) || 0,
      b = parseInt(document.getElementById("existenciasnew").value) || 0;
  

    document.getElementById("existenciasreales").value = a + b ;
  } catch (e) {}
}
  </script>