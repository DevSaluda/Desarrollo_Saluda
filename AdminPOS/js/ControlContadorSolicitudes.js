function  CargaContadores(){


    $.post("https://controlfarmacia.com/AdminPOS/ContadoresSolicitudes.php","",function(data){
      $("#ContadorDeSolicitudesTraspasos").html(data);
    })

  }
  
  
  
  CargaContadores();