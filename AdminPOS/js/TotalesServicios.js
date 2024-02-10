function CargaTotales(){


    $.post("https://saludapos.com/AdminPOS/Consultas/TotalesServicios.php","",function(data){
      $("#TableTotalesServ").html(data);
    })

  }
  
  
  
  CargaTotales();