function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/VentasDelDiaCreditoEnfermeria.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();