

  $(function() {
    $("#clavebusqueda").autocomplete({
        source: "Consultas/BuscandoProductosParaIngresar.php",
        minLength: 2,
        appendTo: "#RegistrosPorActualizar",
        select: function(event, ui) {
            event.preventDefault();
          
           
            $('#codbarrap').val(ui.item.codbarrap);
            $('#nameprod').val(ui.item.nameprod);
            $('#lote').val(ui.item.lote);
            $('#Folioporact').val(ui.item.Folioporact);
            $('#existencias').val(ui.item.existencias);
            
         }
        
    });
          
          });
