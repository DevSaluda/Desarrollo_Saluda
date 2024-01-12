function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/VentasDelDiaCreditoFarmaceutico.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();