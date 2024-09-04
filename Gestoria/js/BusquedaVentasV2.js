$('document').ready(function ($) {

  
    $(function() {
      $("#FiltrarContenido3").hide();
      $("#FiltrarContenido2").autocomplete({
          source: "Consultas/VentaDeProductos2.php",
          minLength: 2,
          appendTo: "#editModalClini",
          select: function(event, ui) {
              event.preventDefault();
            
              $('#add_field').trigger("click");
              $('#fkid2').val(ui.item.fkid2);
              $('#clavad2').val(ui.item.clavad2);
              $('#codbarras2').val(ui.item.codbarras2);  
              $('#identificadortip2').val(ui.item.identificadortip2);
               $('#nombreprod2').val(ui.item.nombreprod2);
               $('#lote2').val(ui.item.lote2);
               $('#precioprod2').val(ui.item.precioprod2);
              
               $('#FiltrarContenido2').val("");
               $('#multi1').trigger("click");
               
               $("#cantidad2").focus()
               $("#Ajusteeee").trigger("click");
               $("#FiltrarContenido2").hide()
               $("#FiltrarContenido3").show()
               $("#FiltrarContenido3").focus();
            
           }
          
      });
            
  }); });
  