function CargaMobi(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/MobilariosVigentes.php","",function(data){
      $("#tablaMobiliariosNuevos").html(data);
    })

  }
  
  
  
  CargaMobi();