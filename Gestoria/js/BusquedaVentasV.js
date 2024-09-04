$('document').ready(function ($) {

    $(function() {
    
      $("#FiltrarContenido2").hide();
      $("#FiltrarContenido").autocomplete({
          source: "Consultas/VentaDeProductos.php",
          minLength: 2,
          appendTo: "#editModalClini",
          select: function(event, ui) {
              event.preventDefault();
            
              $('#add_fieldinicial').trigger("click");
              $('.FKID').val(ui.item.pro_FKID);
              $('.Clavead').val(ui.item.pro_clavad);
              $('.Codigo').val(ui.item.pro_nombre);
              $('.Nombre').val(ui.item.NombreProd);
              $('.Precio').val(ui.item.pro_cantidad);
              $('.Lote').val(ui.item.pro_lote);
              $('.Identificador').val(ui.item.IdentificadorTip);
              $('#FiltrarContenido').val("");
            
            
              $("#cantidadventa").focus()
              $("#Ajusteeee").trigger("click");
              $("#FiltrarContenido").hide()
              $("#FiltrarContenido2").show()
              $("#FiltrarContenido2").focus();
             
              
           }
          
      });
            
            }); });
  