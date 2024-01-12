$('document').ready(function ($) {
    $(function() {
      $("#FiltrarContenido8").hide();
      $("#FiltrarContenido7").autocomplete({
          source: "Consultas/VentaDeProductos7.php",
          minLength: 2,
          appendTo: "#editModalClini",
          select: function(event, ui) {
              event.preventDefault();
            
              $('#add_field6').trigger("click");
              $('#fkid7').val(ui.item.fkid7);
              $('#clavad7').val(ui.item.clavad7);
              $('#codbarras7').val(ui.item.codbarras7);  
              $('#identificadortip7').val(ui.item.identificadortip7);
               $('#nombreprod7').val(ui.item.nombreprod7);
               $('#lote7').val(ui.item.lote7);
               $('#precioprod7').val(ui.item.precioprod7);
                 
               $('#FiltrarContenido7').val("");
               $('#multi6').trigger("click");
               $("#cantidad7").focus()
               $("#Ajusteeee").trigger("click");
               $("#FiltrarContenido7").hide()
               $("#FiltrarContenido8").show()
               $("#FiltrarContenido8").focus();
            
           }
          
      });
            
  }); });
  