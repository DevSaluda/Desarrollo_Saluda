function CargaTotales(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/TotalesServicios.php","",function(data){
      $("#TableTotalesServ").html(data);
    })

  }
  
  
  
  CargaTotales();