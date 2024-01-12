$('document').ready(function ($) {
    $(function() {
      $("#FiltrarContenido5").hide();
      $("#FiltrarContenido4").autocomplete({
          source: "Consultas/VentaDeProductos4.php",
          minLength: 2,
          appendTo: "#productos",
          select: function(event, ui) {
              event.preventDefault();
            
             
              $('#fkid4').val(ui.item.fkid4);
              $('#clavad4').val(ui.item.clavad4);
              $('#codbarras4').val(ui.item.codbarras4);  
              $('#identificadortip4').val(ui.item.identificadortip4);
               $('#nombreprod4').val(ui.item.nombreprod4);
               $('#lote4').val(ui.item.lote4);
               $('#precioprod4').val(ui.item.precioprod4);
                 
               $('#FiltrarContenido4').val("");
               $('#multi3').trigger("click");
               $('#add_field4').trigger("click");
               $("#cantidad4").focus()
               $("#FiltrarContenido4").hide()
               $("#FiltrarContenido5").show()
               $("#FiltrarContenido5").focus();
            
           }
          
      });
            
  }); });
  