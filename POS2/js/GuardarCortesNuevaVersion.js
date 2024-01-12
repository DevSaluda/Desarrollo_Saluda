$('document').ready(function($) {
    $("#GeneraTicketCierreCaja").hide();
    $("#FinalizaAsignacion").hide();
  
    $.validator.addMethod("Sololetras", function(value, element) {
      return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
  
    $("#CierreDeCaja").validate({
      rules: {
        TotalCaja: {
          required: true,
        },
        Cantidad: {
          required: true,
        },
        Empleado: {
          required: true,
        },
        Sucursal: {
          required: true,
        },
        Fecha: {
          required: true,
        },
        TotalCaja: {
          required: true,
        },
        vigencia: {
          required: true,
        },
      },
      messages: {
        TotalCaja: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Dato requerido ",
        },
        Cantidad: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Dato requerido ",
        },
        Empleado: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Dato requerido ",
        },
        Sucursal: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Dato requerido ",
        },
        Fecha: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Dato requerido ",
        },
        TotalCaja: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i>Se necesita el valor de la caja para poder realizar la apertura ",
        },
      },
      submitHandler: function(form) {
        submitForm(form);
      }
    });
  
    function submitForm(form) {
      $.ajax({
        type: 'POST',
        url: "Consultas/CierreCaja.php",
        data: $(form).serialize(),
        cache: false,
        beforeSend: function() {
          $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
        },
        success: function(dataResult) {
          var dataResult = JSON.parse(dataResult);
          if (dataResult.statusCode == 250) {
            var modal_lv = 0;
            $('.modal').on('shown.bs.modal', function(e) {
              $('.modal-backdrop:last').css('zIndex', 1051 + modal_lv);
              $(e.currentTarget).css('zIndex', 1052 + modal_lv);
              modal_lv++
            });
            $('.modal').on('hidden.bs.modal', function(e) {
              modal_lv--
            });
            $("#submit_registro").html("Algo no salió bien.. <i class='fas fa-exclamation-triangle'></i>");
            $('#ErrorCaja').modal('toggle');
            setTimeout(function() {}, 2000);
            setTimeout(function() {
              $("#submit_registro").html("Guardar <i class='fas fa-save'></i>");
            }, 3000);
          } else if (dataResult.statusCode == 200) {
            $("#submit_registro").html("Enviado <i class='fas fa-check'></i>");
            $('#finasignacion').trigger("click");
          } else if (dataResult.statusCode == 201) {
            $("#submit_Age").html("Algo no salió bien.. <i class='fas fa-exclamation-triangle'></i>");
            $('#ErrorData').modal('toggle');
            setTimeout(function() {
              $("#submit_Age").html("Guardar <i class='fas fa-save'></i>");
            }, 3000);
          }
        }
      });
      return false;
    }
  
    const realizarCorteLink = document.getElementById('realizarCorte');
    realizarCorteLink.addEventListener('click', function(event) {
      event.preventDefault();
      const sucursal = document.getElementById('nombresucursal').value;
      const turno = document.getElementById('Turno').value;
      const cajero = document.getElementById('Cajero').value;
      const totalVenta = document.getElementById('TotalDeVenta').value;
      const totalTickets = document.getElementById('TotalDeTickets').value;
      const totalSignosVitales = document.getElementById('totaldesignosvitales').value;
      const nombreServicioInputs = document.getElementsByName('NombreServicio[]');
      const totalServicioInputs = document.getElementsByName('TotalServicio[]');
      const datosServiciosTabla = [];
      for (let i = 0; i < nombreServicioInputs.length; i++) {
        const nombreServicio = nombreServicioInputs[i].value;
        const totalServicio = totalServicioInputs[i].value;
        datosServiciosTabla.push({ nombreServicio, totalServicio });
      }
      const nombreFormaPagoInputs = document.getElementsByName('NombreFormaPago[]');
      const totalFormasPagosInputs = document.getElementsByName('TotalFormasPagos[]');
      const datosFormasPagosTabla = [];
      for (let i = 0; i < nombreFormaPagoInputs.length; i++) {
        const nombreFormaPago = nombreFormaPagoInputs[i].value;
        const totalFormasPagos = totalFormasPagosInputs[i].value;
        datosFormasPagosTabla.push({ nombreFormaPago, totalFormasPagos });
      }
      const mensaje = `
        <div class="row">
          <div class="col">
            <label for="exampleFormControlInput1">Sucursal</label>
            <input type="text" class="form-control" value="${sucursal}" readonly>
          </div>
          <div class="col">
            <label for="exampleFormControlInput1">Turno</label>
            <input type="text" class="form-control" value="${turno}" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="exampleFormControlInput1">Cajero</label>
            <input type="text" class="form-control" value="${cajero}" readonly>
          </div>
          <div class="col">
            <label for="exampleFormControlInput1">Total de venta</label>
            <input type="number" class="form-control" value="${totalVenta}" readonly>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <label for="exampleFormControlInput1">Total de tickets</label>
            <input type="text" class="form-control" value="${totalTickets}" readonly>
          </div>
          <div class="col">
            <label for="exampleFormControlInput1">Total de signos vitales</label>
            <input type="number" class="form-control" value="${totalSignosVitales}" readonly>
          </div>
        </div>
        <br>
        <div class="table-responsive">
          <table id="TotalesGeneralesCortes" class="table table-hover">
            <thead>
              <th>Nombre Servicio</th>
              <th>Total</th>
            </thead>
            <tbody>
              ${datosServiciosTabla
                .map(
                  (dato) => `
                  <tr>
                    <td>
                      <input type="text" class="form-control" value="${dato.nombreServicio}" readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" value="${dato.totalServicio}" readonly>
                    </td>
                  </tr>
                `
                )
                .join('')}
            </tbody>
          </table>
        </div>
        <br>
        <div class="table-responsive">
          <table id="TotalesFormaPAgoCortes" class="table table-hover">
            <thead>
              <th>Forma de pago</th>
              <th>Total</th>
            </thead>
            <tbody>
              ${datosFormasPagosTabla
                .map(
                  (dato) => `
                  <tr>
                    <td>
                      <input type="text" class="form-control" value="${dato.nombreFormaPago}" readonly>
                    </td>
                    <td>
                      <input type="text" class="form-control" value="${dato.totalFormasPagos}" readonly>
                    </td>
                  </tr>
                `
                )
                .join('')}
            </tbody>
          </table>
        </div>
      `;
      Swal.fire({
        html: mensaje,
        icon: 'info',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
        if (result.isConfirmed) {
          submitForm($('#CierreDeCaja'));
        }
      });
    });
  });
  