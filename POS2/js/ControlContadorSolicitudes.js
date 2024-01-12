function  CargaContadores(){


    $.post("https://controlfarmacia.com/POS2/ContadoresSolicitudes.php","",function(data){
      $("#ContadorDeSolicitudesTraspasos").html(data);
    })

  }
  
  
  
  CargaContadores();