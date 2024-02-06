function CargaTotales(){


    $.post("https://saluda.com/POS2/Consultas/TotalesServicios.php","",function(data){
      $("#TableTotalesServ").html(data);
    })

  }
  
  
  
  CargaTotales();