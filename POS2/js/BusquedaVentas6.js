$('document').ready(function ($) {
    $(function() {
      $("#FiltrarContenido7").hide();
      $("#FiltrarContenido6").autocomplete({
          source: "Consultas/VentaDeProductos6.php",
          minLength: 2,
          appendTo: "#productos",
          select: function(event, ui) {
              event.preventDefault();
            
             
              $('#fkid6').val(ui.item.fkid6);
              $('#clavad6').val(ui.item.clavad6);
              $('#codbarras6').val(ui.item.codbarras6);  
              $('#identificadortip6').val(ui.item.identificadortip6);
               $('#nombreprod6').val(ui.item.nombreprod6);
               $('#lote6').val(ui.item.lote6);
               $('#precioprod6').val(ui.item.precioprod6);
                 
               $('#FiltrarContenido6').val("");
               $('#multi5').trigger("click");
               $('#add_field6').trigger("click");
               $("#cantidad6").focus()
               $("#FiltrarContenido6").hide()
               $("#FiltrarContenido7").show()
               $("#FiltrarContenido7").focus();
            
           }
          
      });
            
  }); });
  