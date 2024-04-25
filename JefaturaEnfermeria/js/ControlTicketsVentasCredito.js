function CargaVentasDelDia(){


    $.post("https://saludapos.com/JefaturaEnfermeria/Consultas/VentasDelDiaPorTicketsCredito.php","",function(data){
      $("#TableVentasDelDiaCredito").html(data);
    })

  }
  
  
  
  CargaVentasDelDia();