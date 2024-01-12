function CargaTotalesServ(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TotalesServiciosAtras.php","",function(data){
      $("#TableTotalesServG").html(data);
    })

  }
  
  
  
  CargaTotalesServ();