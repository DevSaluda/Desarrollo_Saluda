

  $(function() {
    $("#codigoprocedimiento").autocomplete({
        source: "Consultas/BuscandoPaciente.php",
        minLength: 2,
        appendTo: "#AgregaProcedimientos",
        select: function(event, ui) {
            event.preventDefault();
          
           
            $('#codigoprocedimiento').val(ui.item.codigoprocedimiento);
            $('#tel').val(ui.item.tel);
           
            
         }
        
    });
          
          });
