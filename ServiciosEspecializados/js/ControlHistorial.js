function CargaHistorial(){


    $.get("https://controlfarmacia.com/Servicios_Especializados/Consultas/Historial.php","",function(data){
      $("#Tablahistorial").html(data);
    })
  
  }
  
  
  
  CargaHistorial();

  
