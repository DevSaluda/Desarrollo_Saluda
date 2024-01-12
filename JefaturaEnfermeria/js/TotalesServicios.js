function CargaTotales(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/TotalesServicios.php","",function(data){
      $("#TableTotalesServ").html(data);
    })

  }
  
  
  
  CargaTotales();