function  CargaContadores(){


    $.post("https://controlfarmacia.com/CEDIS/ContadoresSolicitudes.php","",function(data){
      $("#ContadorDeSolicitudesTraspasos").html(data);
    })

  }
  
  
  
  CargaContadores();