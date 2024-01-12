function CargaVentasDelDia(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();