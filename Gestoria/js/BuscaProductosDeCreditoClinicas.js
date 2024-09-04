
  $(function() {
    $("#codbarrap").autocomplete({
        source: "Consultas/ProductosDeCreditoDeClinicas.php",
        minLength: 2,
        appendTo: "#editModalClini",
        select: function(event, ui) {
            event.preventDefault();
          
            $('#nombre_prod').val(ui.item.nombre_prod);
            $('#nombre_prodticket').val(ui.item.nombre_prodticket);
            $('#nombre_prodticketr').val(ui.item.nombre_prodticketr);
            $('#costoprod').val(ui.item.costoprod);
            $('#precioticket').val(ui.item.precioticket);
            $('#precioticketr').val(ui.item.precioticketr);
            $('#idproductos').val(ui.item.idproductos);
            $("#codbarrap").focus();
          
         }
        
    });
          
          });
