function  HistorialCajasSincronizadas(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/HistorialCajasSincronizadas.php","",function(data){
      $("#CajasDesdeSincronizacion").html(data);
    })

  }
  
  
  
  HistorialCajasSincronizadas();