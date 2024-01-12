
  
      <div class="modal fade bd-example-modal-xl" id="FiltroFechasEspecificasFarmacias" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtrado de ventas por sucursal<i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form action="FiltroPorFechasEstadisticas" method="post" id="">
    
 <div class="form-group">
    <label for="exampleInputEmail1">Sucursal </label>
    <select id = "sucursal" class = "form-control" name = "Sucursal" required >
      <option value="">Seleccione una Sucursal:</option>
      <option value="21">CEDIS</option>
           <option value="23">CEDIS(Partner)</option>
           <option value="25">Itzincab</option>
          <option value="3">Izamal</option>
          <option value="19">Kanasín</option>
           <option value="4">Mama</option>
          <option value="5">Mani</option>
            <option value="20">Motul</option>
            <option value="15">Oficinas</option>
          <option value="6">Oxkutzcab</option>
           <option value="7">Peto</option>
             <option value="8">Teabo</option>
              <option value="22">Teabo Clínica</option>
               <option value="9">Tekax</option>
              <option value="10">Tekit</option>
              <option value="11">Ticul</option>
            <option value="12">Tixkokob</option>
          <option value="13">Uman</option>
       </select>
  </div>
    
    

 


  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha Inicio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha1"  required>
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Fecha Fin </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha2"  required>
    </div>
    
  
  <div>     </div>
  </div>  </div>


      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Aplicar cambio de sucursal <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  


  <!-- MODAL DE FILTRO POR VENDEDOR -->

  
  
  <div class="modal fade bd-example-modal-xl" id="FiltroFechasEspecificasFarmaciasVendedores" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Filtrado de ventas por sucursal<i class="fas fa-credit-card"></i></p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
     
      <div class="modal-body">
     
 <form action="FiltroPorFechasVendedores" method="post" id="">
    
 
 <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Sucursal Actual </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <select id = "sucursalvendedor" class = "form-control" name = "SucursalVendedor" required >
   <option value="">Seleccione una Sucursal:</option>
   <option value="21">CEDIS</option>
           <option value="23">CEDIS(Partner)</option>
           <option value="25">Itzincab</option>
          <option value="3">Izamal</option>
          <option value="19">Kanasín</option>
           <option value="4">Mama</option>
          <option value="5">Mani</option>
            <option value="20">Motul</option>
            <option value="15">Oficinas</option>
          <option value="6">Oxkutzcab</option>
           <option value="7">Peto</option>
             <option value="8">Teabo</option>
              <option value="22">Teabo Clínica</option>
               <option value="9">Tekax</option>
              <option value="10">Tekit</option>
              <option value="11">Ticul</option>
            <option value="12">Tixkokob</option>
          <option value="13">Uman</option>
        </select>
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Vendedor </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <select  id = "vendedorafiltrar" name = "VendedorAFiltrar"  class = "form-control " disabled = "disabled" >
								<option value = "">Selecciona el vendedor</option>
							</select>
    </div>

  <div>     </div>
  </div>  </div>
  <div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Fecha Inicio </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha1Vendedor"  required>
    </div>
    </div>
    
    <div class="col">
    <label for="exampleFormControlInput1">Fecha Fin </label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-hospital"></i></span>
  </div>
  <input type="date" class="form-control " name="Fecha2Vendedor"  required>
    </div>
    
  
  <div>     </div>
  </div>  </div>
      <button type="submit"  id="submit_registroarea" value="Guardar" class="btn btn-success">Realizar busqueda <i class="fas fa-exchange-alt"></i></button>
                                        </form>
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  
  <!-- MODAL DE FILTRO POR VENDEDOR -->