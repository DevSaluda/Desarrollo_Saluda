function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/VentasDelDiaCreditoMedico.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();