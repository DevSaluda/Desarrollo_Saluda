function CargaTotales(){


    $.post("https://controlfarmacia.com/POS2/Consultas/TotalesServiciosAtras.php","",function(data){
      $("#TableTotalesServ").html(data);
    })

  }
  
  
  
  CargaTotales();