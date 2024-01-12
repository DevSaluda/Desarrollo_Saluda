function CargaTotales(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TotalesServicios.php","",function(data){
      $("#TableTotalesServ").html(data);
    })

  }
  
  
  
  CargaTotales();