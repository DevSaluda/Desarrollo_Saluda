function CargaAbonos(){


    $.post("https://saludapos.com/ControlDental/Consultas/Abonos.php","",function(data){
      $("#tablaAbonos").html(data);
    })

  }
  
  
  
  CargaAbonos();