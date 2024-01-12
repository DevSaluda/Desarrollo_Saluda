function CargaTotales(){


    $.post("https://controlfarmacia.com/POS2/Consultas/TotalesServicios.php","",function(data){
      $("#TableTotalesServ").html(data);
    })

  }
  
  
  
  CargaTotales();