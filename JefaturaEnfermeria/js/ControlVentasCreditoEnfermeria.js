function CargaVentasDelDia(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/VentasDelDiaCredito.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();