$('document').ready(function ($) {
    $(function() {
      $("#FiltrarContenido4").hide();
      $("#FiltrarContenido3").autocomplete({
          source: "Consultas/VentaDeProductos3.php",
          minLength: 2,
          appendTo: "#editModalClini",
          select: function(event, ui) {
              event.preventDefault();
            
              $('#add_field2').trigger("click");
              $('#fkid3').val(ui.item.fkid3);
              $('#clavad3').val(ui.item.clavad3);
              $('#codbarras3').val(ui.item.codbarras3);  
              $('#identificadortip3').val(ui.item.identificadortip3);
               $('#nombreprod3').val(ui.item.nombreprod3);
               $('#lote3').val(ui.item.lote3);
               $('#precioprod3').val(ui.item.precioprod3);
                 
               $('#FiltrarContenido2').val("");
               $('#multi2').trigger("click");
             
               $("#cantidad3").focus()
               $("#Ajusteeee").trigger("click");
               $("#FiltrarContenido3").hide()
               $("#FiltrarContenido4").show()
               $("#FiltrarContenido4").focus();
            
           }
          
      });
            
  }); });
  