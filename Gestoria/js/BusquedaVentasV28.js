$('document').ready(function ($) {
    $(function() {
      $("#FiltrarContenido9").hide();
      $("#FiltrarContenido8").autocomplete({
          source: "Consultas/VentaDeProductos8.php",
          minLength: 2,
          appendTo: "#editModalClini",
          select: function(event, ui) {
              event.preventDefault();
            
              $('#add_field7').trigger("click");
              $('#fkid8').val(ui.item.fkid8);
              $('#clavad8').val(ui.item.clavad8);
              $('#codbarras8').val(ui.item.codbarras8);  
              $('#identificadortip8').val(ui.item.identificadortip8);
               $('#nombreprod8').val(ui.item.nombreprod8);
               $('#lote8').val(ui.item.lote8);
               $('#precioprod8').val(ui.item.precioprod8);
                 
               $('#FiltrarContenido8').val("");
               $('#multi7').trigger("click");
              
               $("#cantidad8").focus()
               $("#Ajusteeee").trigger("click");
               $("#FiltrarContenido8").hide()
               $("#FiltrarContenido9").show()
               $("#FiltrarContenido9").focus();
            
           }
          
      });
            
  }); });
  