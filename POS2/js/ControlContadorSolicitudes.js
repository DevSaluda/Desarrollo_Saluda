function  CargaContadores(){


    $.post("https://saludapos.com/POS2/ContadoresSolicitudes.php","",function(data){
      $("#ContadorDeSolicitudesTraspasos").html(data);
    })

  }
  
  
  
  CargaContadores();