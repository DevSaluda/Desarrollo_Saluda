<div class="modal fade bd-example-modal-xl" id="AperturaCreditClinica" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-="true">
      
      <div class="modal-dialog modal-notify modal-success">
        <div class="modal-content">
        
    
        <div class="modal-header">
             <p class="heading lead">Apertura de credito</p>
    
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-="true" class="white-text">&times;</span>
             </button>
           </div>
            <div class="alert alert-success alert-styled-left text-blue-800 content-group">
                                            <span class="text-semibold">Estimado usuario, </span>
                                los campos con un  <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.
                              
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                </div>
            <div class="modal-body">
             <div class="text-center">
     
     <form action="javascript:void(0)" method="post" id="AbreCreditoClinica">
     <!-- PRIMERA TANDA INICIO -->
     <div class="form-group">
          
        <label for="exampleFormControlInput1">Nombre y apellidos <span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <select name="NombreEnfemero" id="nombreenfermero" class = "form-control"  onchange="CapturaNombreEnfermero();">
                                               <option value="">Seleccione un enfermero:</option>
        <?
          $query = $conn -> query ("SELECT Enfermero_ID,Nombre_Apellidos,ID_H_O_D,Fk_Sucursal,Estatus FROM Personal_Enfermeria WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[Enfermero_ID].'">'.$valores[Nombre_Apellidos].'</option>';
          }
        ?>  </select>  
        </div>
       
        </div>
        <div class="form-group">
        <label for="exampleFormControlInput1">Área</label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="far fa-calendar-alt"></i></span>
      </div>
      <input  type="text" id="areac" name="AreaC"  readonly value="Enfermería" class="form-control">
        </div>
      
       </div>
       <div class="form-group">
        <label for="exampleFormControlInput1">Fecha<span class="text-danger">*</span></label>
         <div class="input-group mb-3">
      <div class="input-group-prepend">
      
        <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
      </div>
      <input  type="date" id="fechainicioc" readonly name="FechaInicioC"  value="<?php echo $fcha;?>" class="form-control">
      
    </div>
    
        </div>
        <div class="form-group">
          
          <label for="exampleFormControlInput1">Costo total<span class="text-danger">*</span></label>
           <div class="input-group mb-3">
        <div class="input-group-prepend">
        
          <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
        </div>
        <input type="text"  class="form-control " value="Sin limite"  readonly >
      </div>
      
          </div>
          
    

       
        
    
    
        
        <input type="text" class="form-control" id="estatusc" name="EstatusC"  hidden  readonly value="Vigente" >

        <input type="number" class="form-control" id="valc" name="Valc"  hidden  readonly value="0.00" >

        <input  type="text" id="fechaterminoc" hidden readonly name="FechaTerminoc"  value="<?php echo $fcha;?>" class="form-control">
        <input type="text" class="form-control" id="nombrereal" name="NombreReal"  hidden  readonly >
        <input type="text"  class="form-control "   readonly name="SucursalC" id="sucursalc" hidden value="<?echo $row['Fk_Sucursal']?>">
        <input type="text" class="form-control" id="codestatusc" name="CodEstatusC"   hidden readonly value="background-color: #2BBB1D !important;" >
      <input type="text" class="form-control" id="empresac" name="EmpresaC"  hidden readonly value="<? echo $row['ID_H_O_D']?>" >
      <input type="text" class="form-control" id="agendac" name="AgendaPorC" hidden readonly   value="<?echo $row['Nombre_Apellidos']?>" >
      <input type="text" class="form-control" id="sistemac" name="SistemaC"    hidden readonly value="POS <?echo $row['Nombre_rol']?>" >
      
      <div class="text-center">
      <button type="submit"  name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
      </div>
                                            </form>
         
    </form>
    
    
        
          <p class="statusMsg"></p>
    
        
        </div>
      </div>
    </div>  </div>
    </div></div>  </div>
    </div>
    <script>
          
          
            
        </script>
    <script type="text/javascript">
      
      function CapturaNombreEnfermero() {
        var combo = document.getElementById("nombreenfermero");
    
    var selected = combo.options[combo.selectedIndex].text;
    $("#nombrereal").val(selected);
      
      }
    
    
    
    </script>
    
    <?php
    if($ValorCaja["Estatus"] == 'Abierta'){
    
      echo '
      <script>
    $(document).ready(function()
    {
    // id de nuestro modal
    
    $("#submit_registro").attr("disabled", false);
    });
    </script>
      ';
         }else{
        
          echo '
          <script>
    $(document).ready(function()
    {
      // id de nuestro modal
    
      $("#submit_registro").attr("disabled", true);
    });
    </script>
          ';
          
          
        
         } ?>