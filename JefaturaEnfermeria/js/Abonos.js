function CargaAbonos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/Abonos.php","",function(data){
      $("#tablaAbonos").html(data);
    })

  }
  
  
  
  CargaAbonos();