function CargaCancelacionesExternas(){


    $.post("https://saludapos.com/POS2/Consultas/CancelacionesExternas.php","",function(data){
      $("#CitasCanceladasExt").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesExternas();

  
