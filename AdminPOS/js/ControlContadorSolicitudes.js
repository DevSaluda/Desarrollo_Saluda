function  CargaContadores(){


    $.post("https://saludapos.com/AdminPOS/ContadoresSolicitudes.php","",function(data){
      $("#ContadorDeSolicitudesTraspasos").html(data);
    })

  }
  
  
  
  CargaContadores();