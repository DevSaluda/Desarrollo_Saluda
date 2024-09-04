$('document').ready(function ($) {
    $(function() {
      $("#FiltrarContenido6").hide();
      $("#FiltrarContenido5").autocomplete({
          source: "Consultas/VentaDeProductos5.php",
          minLength: 2,
          appendTo: "#productos",
          select: function(event, ui) {
              event.preventDefault();
            
             
              $('#fkid5').val(ui.item.fkid5);
              $('#clavad5').val(ui.item.clavad5);
              $('#codbarras5').val(ui.item.codbarras5);  
              $('#identificadortip5').val(ui.item.identificadortip5);
               $('#nombreprod5').val(ui.item.nombreprod5);
               $('#lote5').val(ui.item.lote5);
               $('#precioprod5').val(ui.item.precioprod5);
                 
               $('#FiltrarContenido5').val("");
               $('#multi4').trigger("click");
               $('#add_field5').trigger("click");
               $("#cantidad5").focus()
               $("#FiltrarContenido5").hide()
               $("#FiltrarContenido6").show()
               $("#FiltrarContenido6").focus();
            
           }
          
      });
            
  }); });
  