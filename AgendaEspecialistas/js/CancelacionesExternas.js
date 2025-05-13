function CargaCancelacionesExternas(){


    $.post("https://saludapos.com/AgendaDeCitas/Consultas/CancelacionesExternas.php","",function(data){
      $("#CitasCanceladasExt").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesExternas();

  
