function CargaAbonos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/Abonos.php","",function(data){
      $("#tablaAbonos").html(data);
    })

  }
  
  
  
  CargaAbonos();