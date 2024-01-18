function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDiaCreditoFarmaceutico.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();