function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/VentasDelDiaCreditoFarmaceutico.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();