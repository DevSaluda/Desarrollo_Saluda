function CargaCajasSincronizadas(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/CajasSincronizadas.php","",function(data){
      $("#CajasSincronizadas").html(data);
    })
  
  }
  
  
  
  CargaCajasSincronizadas();

  
  