function CargaHistorial(){


    $.get("https://saludapos.com/AgendaDeCitas/Consultas/Historial.php","",function(data){
      $("#Tablahistorial").html(data);
    })
  
  }
  
  
  
  CargaHistorial();

  
