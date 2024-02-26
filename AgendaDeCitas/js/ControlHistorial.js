function CargaHistorial(){


    $.get("https://controlfarmacia.com/AgendaDeCitas/Consultas/Historial.php","",function(data){
      $("#Tablahistorial").html(data);
    })
  
  }
  
  
  
  CargaHistorial();

  
