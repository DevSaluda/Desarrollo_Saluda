

  $(function() {
    $("#nombresExt").autocomplete({
        source: "Consultas/BuscandoPacienteExt.php",
        minLength: 2,
        appendTo: "#AgendaExterno",
        select: function(event, ui) {
            event.preventDefault();
          
           
            $('#nombresExt').val(ui.item.nombresExt);
            $('#telExt').val(ui.item.telExt);
           
            
         }
        
    });
          
          });
