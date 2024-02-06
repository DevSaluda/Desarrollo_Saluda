function CargaTotales(){


    $.post("https://saludapos.com/POS2/Consultas/TotalesServiciosAtras.php","",function(data){
      $("#TableTotalesServ").html(data);
    })

  }
  
  
  
  CargaTotales();