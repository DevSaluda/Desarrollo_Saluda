function CargaHistorial(){


    $.get("https://saludapos.com/ServiciosEspecializados/Consultas/Historial.php","",function(data){
      $("#Tablahistorial").html(data);
    })
  
  }
  
  
  
  CargaHistorial();

  
