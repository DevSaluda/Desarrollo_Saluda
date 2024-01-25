
  
      <div class="modal fade bd-example-modal-xl" id="CambioAdar" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success">
    <div class="modal-content">
    
    <div class="text-center">
    <div class="modal-header">
         <p class="heading lead">Realizando venta<i class="fas fa-credit-card"></i></p>

         <button type="button" id="Cierra" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       
      <div class="modal-body">
     
<label for="exampleFormControlInput1">Importe total <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-dollar-sign"></i></span>
  </div>
  
  <input type="number" step="any" class="form-control "readonly id="subtotal" >            
</div>
<div class="form-group">
          
        <label for="exampleFormControlInput1">Forma de pago<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
     <select  id="formapago" required class="form-control" onchange="CapturaFormadePago();">
     <option value="">Elija forma de pago</option>
     <option >Efectivo</option>
     <option >Tarjeta</option>
     <option >Credito</option>
     <option >Vale</option>
     <option >Transferencia</option>
     <option  >Crédito Enfermería</option>
     <option  >Crédito Farmacéutico</option>
      <option >Crédito Médico</option>
      <option >Crédito Limpieza</option>
      <!-- <option >Crédito Gestores</option> -->
     </select>
        </div>
        <div class="alert alert-danger" id="avisaformapago" role="alert" style="display:none;">
      ¡Debes elegir una forma de pago!
</div>
        </div>
        <div id="PublicoGenerall" >
       <div class="form-group">
          
        <label for="exampleFormControlInput1">Cliente<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <input  type="Text"  id="namecliente" class="form-control " oninput="CapturaNombreclienteTicket()" placeholder="Ingrese el nombre del cliente"  required >            
        </div>
        </div>
        <div id="SignoVitalpaciente" >
        <div class="form-group">
          
        <label for="exampleFormControlInput1">Folio de signo vital <span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <input  type="text"  class="form-control " id="Signosvitalescaptura" oninput="CapturaFolioSignoVital()" placeholder="Ingrese el folio del signo vital del paciente"  required >            
        </div>

        </div>

       <div class="form-group">
          
        <label for="exampleFormControlInput1"># de ticket anterior<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <input  type="text"  class="form-control " id="TicketAnterior" oninput="CapturaTicketAnterior()" placeholder="Ingrese el # de ticket "  required >            
        </div>
        
        </div> 
        </div></div>
        <div id="PersonalEnfermeria" style="display: none;">
        <div class="form-group">
          
        <label for="exampleFormControlInput1">Elije al enfermero<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <select name="NombreEnfemero" id="nombreenfermero" class = "form-control"  onchange="CapturaNombreEnfermero();">
                                               <option value="">Seleccione un enfermero:</option>
        <?php
          $query = $conn -> query ("SELECT Enfermero_ID,Nombre_Apellidos,ID_H_O_D,Fk_Sucursal,Estatus FROM Personal_Enfermeria WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Apellidos"].'">'.$valores["Nombre_Apellidos"].'</option>';
          }
        ?>  </select>  
        </div>
        <div class="alert alert-danger" id="avisaformapago" role="alert" style="display:none;">
      ¡Debes elegir una forma de pago!
</div>
        </div>
        </div>
        <div id="PersonalFarmacia" style="display: none;">
        <div class="form-group">
          
        <label for="exampleFormControlInput1">Elije al farmacéutico<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <select name="NombreFarmaceutico" id="nombrefarma" class = "form-control"  onchange="CapturaNombreFarmaceutico();">
                                               <option value="">Seleccione un farmacéutico:</option>
        <?php
          $query = $conn -> query ("SELECT Pos_ID,Nombre_Apellidos,ID_H_O_D,Fk_Sucursal,Estatus,Fk_Usuario FROM PersonalPOS WHERE 	Fk_Usuario=7 AND Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Apellidos"].'">'.$valores["Nombre_Apellidos"].'</option>';
          }
        ?>  </select>  
        </div>
        <div class="alert alert-danger" id="avisaformapago" role="alert" style="display:none;">
      ¡Debes elegir una forma de pago!
</div>
        </div>
        </div>
        <div id="PersonalMedico" style="display: none;">
        <div class="form-group">
          
        <label for="exampleFormControlInput1">Elije al médico<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <select name="NombreMedico" id="nombremedicoo" class = "form-control"  onchange="CapturaNombreMedico();">
                                               <option value="">Seleccione un médico:</option>
        <?php
          $query = $conn -> query ("SELECT Medico_ID,Nombre_Apellidos,ID_H_O_D,Fk_Sucursal,Estatus FROM Personal_Medico WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Apellidos"].'">'.$valores["Nombre_Apellidos"].'</option>';
          }
        ?>  </select>  
        </div>
        <div class="alert alert-danger" id="avisaformapago" role="alert" style="display:none;">
      ¡Debes elegir una forma de pago!
</div>
        </div>
        </div>


        <div id="PersonalLimpieza" style="display: none;">
        <div class="form-group">
          
        <label for="exampleFormControlInput1">Elije al personal de limpieza<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <select name="NombreIntendente" id="nombreintendente" class = "form-control"  onchange="CapturaNombreLimpieza();">
                                               <option value="">Seleccione personal:</option>
        <?php
          $query = $conn -> query ("SELECT Intendencia_ID,Nombre_Apellidos,ID_H_O_D,Fk_Sucursal,Estatus FROM Personal_Intendecia WHERE Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Apellidos"].'">'.$valores["Nombre_Apellidos"].'</option>';
          }
        ?>  </select>  
        </div>
        <div class="alert alert-danger" id="avisaformapago" role="alert" style="display:none;">
      ¡Debes elegir una forma de pago!
</div>
        </div>
        </div>


        <!-- <div id="PersonalGestores" style="display: none;">
        <div class="form-group">
          
        <label for="exampleFormControlInput1">Elije al médico<span class="text-danger">*</span></label>
        <div class="input-group mb-3">
      <div class="input-group-prepend">  <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
      </div>
      <select name="NombreMedico" id="nombremedicoo" class = "form-control"  onchange="CapturaNombreMedico();">
                                               <option value="">Seleccione un médico:</option>
        <?php
          $query = $conn -> query ("SELECT 	Pos_ID,Nombre_Apellidos,ID_H_O_D,Fk_Sucursal,Fk_Usuario,Estatus FROM PersonalPOS WHERE Fk_Usuario='31' AND Estatus='Vigente' AND ID_H_O_D='".$row['ID_H_O_D']."' AND Fk_Sucursal='".$row['Fk_Sucursal']."' ");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores["Nombre_Apellidos"].'">'.$valores["Nombre_Apellidos"].'</option>';
          }
        ?>  </select>  
        </div>
        <div class="alert alert-danger" id="avisaformapago" role="alert" style="display:none;">
      ¡Debes elegir una forma de pago!
</div>
        </div>
        </div> -->
        <div id="Pagare" >
<label for="exampleFormControlInput1">Pago <span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-money-bill-wave"></i></span>
  </div>
  
  <input type="number" step="any" class="form-control " oninput="CapturaValorPago()"id="pago" >            
</div>


<label for="exampleFormControlInput1">Cambio<span class="text-danger">*</span></label>
     <div class="input-group mb-3">
  <div class="input-group-prepend">
  
    <span class="input-group-text" id="Tarjeta"><i class="fas fa-hand-holding-usd"></i></span>
  </div>
  
  <input type="number" step="any" class="form-control " readonly onfocus="CapturaValorCambio()" id="cambio" >            
</div>
</div>



    


  <div>
 
      <button type="submit"   id="activoventa"  onClick="this.disabled='disabled'" disabled class="btn btn-success">Continuar <i class="fas fa-check-circle"></i></button> <br>
     
                                        </div>
                                        </div>
     
    </div>
  </div>
  </div>
  </div>
  <script>
       var pagare = document.getElementById("subtotal")
       var conesopago = document.getElementById("pago")
       var elcambio = document.getElementById("cambio")
    
       conesopago.addEventListener("change", () => {
            elcambio.value = parseFloat(conesopago.value) - parseFloat(pagare.value)
            $("#cambio").focus();
        })
       
       
        function CapturaValorPago() {
    var realpago = document.getElementById("pago").value;
    //Se actualiza en municipio inm
    document.getElementById("pagoreal").value = realpago;
   
}
function CapturaValorCambio() {
    var realcambio = document.getElementById("cambio").value;
    //Se actualiza en municipio inm
    document.getElementById("cambioreal").value = realcambio;
   
}

function CapturaFormadePago() {
  if (document.getElementById("formapago").value == "Crédito Enfermería") {
        $("#PersonalEnfermeria").show();
        $("#PublicoGenerall").hide();
        $("#PersonalFarmacia").hide();
        $("#PersonalMedico").hide();
        $("#PersonalLimpieza").hide();
        $("#SignoVitalpaciente").hide();
        $("#PersonalGestores").hide();
        $("#Pagare").hide();
        
    }
    if (document.getElementById("formapago").value == "Efectivo") {
      $("#PublicoGenerall").show();
      $("#SignoVitalpaciente").show();
        $("#Pagare").show();  
      $("#PersonalEnfermeria").hide();
      $("#PersonalMedico").hide();
      $("#PersonalLimpieza").hide();
      $("#PersonalGestores").hide();
      $("#PersonalFarmacia").hide();
    }

    if (document.getElementById("formapago").value == "Crédito Farmacéutico") {
      $("#PersonalFarmacia").show();
        $("#PublicoGenerall").hide();
        $("#PersonalEnfermeria").hide();
        $("#PersonalMedico").hide();
        $("#PersonalLimpieza").hide();
        $("#SignoVitalpaciente").hide();
        $("#PersonalGestores").hide();
        $("#Pagare").hide();
       
        
    }
    if (document.getElementById("formapago").value == "Crédito Médico") {
      $("#PersonalMedico").show();
        $("#PublicoGenerall").hide();
        $("#PersonalEnfermeria").hide();
        $("#PersonalFarmacia").hide();
        $("#PersonalLimpieza").hide();
        $("#SignoVitalpaciente").hide();
        $("#PersonalGestores").hide();
        $("#Pagare").hide();
       
        
    }

    if (document.getElementById("formapago").value == "Crédito Limpieza") {
      $("#PersonalLimpieza").show();
      $("#PersonalMedico").hide();
        $("#PublicoGenerall").hide();
        $("#PersonalEnfermeria").hide();
        $("#PersonalFarmacia").hide();
        $("#SignoVitalpaciente").hide();
        $("#PersonalGestores").hide();
        $("#Pagare").hide();
       
        
    }
   
    var formadepagoreal = document.getElementById("formapago").value;

// Seleccionar todos los elementos con la clase "formapago-dinamico"
var elementosDinamicos = document.getElementsByClassName("formapago-dinamico");
for (var i = 0; i < elementosDinamicos.length; i++) {
    elementosDinamicos[i].value = formadepagoreal;
}

}


function CapturaNombreEnfermero() {

    var nombredelpersonalenfermero = document.getElementById("nombreenfermero").value;
    //Se actualiza en municipio inm
   
    document.getElementById("cliente1").value = nombredelpersonalenfermero;
    document.getElementById("cliente2").value = nombredelpersonalenfermero;
    document.getElementById("cliente3").value = nombredelpersonalenfermero;
    document.getElementById("cliente4").value = nombredelpersonalenfermero;
    document.getElementById("cliente5").value = nombredelpersonalenfermero;
    document.getElementById("cliente6").value = nombredelpersonalenfermero;
    document.getElementById("cliente7").value = nombredelpersonalenfermero;
    document.getElementById("cliente8").value = nombredelpersonalenfermero;
    document.getElementById("cliente9").value = nombredelpersonalenfermero;
    document.getElementById("cliente10").value = nombredelpersonalenfermero;
   
   
}
function CapturaNombreFarmaceutico() {

var nombredelpersonalfarmaceutico = document.getElementById("nombrefarma").value;
//Se actualiza en municipio inm

document.getElementById("cliente1").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente2").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente3").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente4").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente5").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente6").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente7").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente8").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente9").value = nombredelpersonalfarmaceutico;
document.getElementById("cliente10").value = nombredelpersonalfarmaceutico;


}


function CapturaNombreMedico() {

var nombredelpersonalmedico = document.getElementById("nombremedicoo").value;
//Se actualiza en municipio inm

document.getElementById("cliente1").value = nombredelpersonalmedico;
document.getElementById("cliente2").value = nombredelpersonalmedico;
document.getElementById("cliente3").value = nombredelpersonalmedico;
document.getElementById("cliente4").value = nombredelpersonalmedico;
document.getElementById("cliente5").value = nombredelpersonalmedico;
document.getElementById("cliente6").value = nombredelpersonalmedico;
document.getElementById("cliente7").value = nombredelpersonalmedico;
document.getElementById("cliente8").value = nombredelpersonalmedico;
document.getElementById("cliente9").value = nombredelpersonalmedico;
document.getElementById("cliente10").value = nombredelpersonalmedico;


}

function CapturaNombreLimpieza() {

var nombredelpersonallimpieza = document.getElementById("nombreintendente").value;
//Se actualiza en municipio inm

document.getElementById("cliente1").value = nombredelpersonallimpieza;
document.getElementById("cliente2").value = nombredelpersonallimpieza;
document.getElementById("cliente3").value = nombredelpersonallimpieza;
document.getElementById("cliente4").value = nombredelpersonallimpieza;
document.getElementById("cliente5").value = nombredelpersonallimpieza;
document.getElementById("cliente6").value = nombredelpersonallimpieza;
document.getElementById("cliente7").value = nombredelpersonallimpieza;
document.getElementById("cliente8").value = nombredelpersonallimpieza;
document.getElementById("cliente9").value = nombredelpersonallimpieza;
document.getElementById("cliente10").value =nombredelpersonallimpieza;


}
function CapturaNombreclienteTicket() {
    var nombredelcliente = document.getElementById("namecliente").value;

    // Iterar sobre todos los elementos con la clase "cliente"
    var clientes = document.getElementsByClassName("cliente");
    for (var i = 0; i < clientes.length; i++) {
        clientes[i].value = nombredelcliente;
    }
}



function CapturaFolioSignoVital() {
    var numerodefoliodesignovital = document.getElementById("Signosvitalescaptura").value;

    // Iterar sobre todos los elementos con la clase "sv"
    var svElements = document.getElementsByClassName("sv");
    for (var i = 0; i < svElements.length; i++) {
        svElements[i].value = numerodefoliodesignovital;
    }
}

function CapturaTicketAnterior() {
    var numerodeticketanterior = document.getElementById("TicketAnterior").value;

    // Seleccionar todos los elementos con la clase "tk-dinamico"
    var elementosDinamicos = document.getElementsByClassName("tk-dinamico");
    for (var i = 0; i < elementosDinamicos.length; i++) {
        elementosDinamicos[i].value = numerodeticketanterior;
    }
}





$("#activoventa").on('click', function(e) {
    $("#Cierra").trigger("click");
   
    $("#submit_registro").trigger("click");
    $("#subtotal").val("");
    $("#pago").val("");
    $("#cambio").val("");
});




    $( function() {
    $("#formapago").change( function() {
        if ($(this).val() === "") {
            $("#activoventa").prop("disabled", true);
            $("#avisaformapago").css("display","block");
        } else {
            $("#activoventa").prop("disabled", false);
        }
    });
});
    </script>

    
