<form id="frmProduct" method="post" action="">
<button class="btn btn-primary" type="submit" name="guardar" value="Guardar Ahora">GUARDAR</button> 
<div class="row">
    <div class="col">
    <label for="exampleFormControlInput1">Vendedor</label>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="Vendedor" id="vendedor" readonly value="<?php echo $row['Nombre_Apellidos']?>" >
    </div>
    </div>
    
    <div class="col">
      
    <label for="exampleFormControlInput1">Caja</label> <br>
    <div class="input-group mb-3">
  <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
  </div>
  <input type="text" class="form-control " name="NmCaja" id="nmcaja" readonly value="<?php echo $ValorCaja['Valor_Total_Caja']?>" >
    </div>
   
<label for="clav" class="error"></div>
<div class="col">
      
      <label for="exampleFormControlInput1">Total de venta</label> <br>
      <div class="input-group mb-3">
    <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
    </div>
    <input type="number" class="form-control " id="totalventa" readonly  >
      </div>
    <? echo $totalmonto;;?> 
  <label for="clav" class="error"></div>

</div>





<input type="text" hidden class="form-control " name="SucursalVentas" readonly value="<?php echo $row['Nombre_Sucursal']?>" >
<div id="outer">
<div id="header">

</div> 

<div id="productos">
<?php require_once("InputDinamico.php") ?>
   
</div> 

<div style="position: relative;">

</div>
</div>


 
</form>