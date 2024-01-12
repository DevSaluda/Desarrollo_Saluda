function CargaCancelacionesExternas(){


    $.post("https://controlfarmacia.com/AgendaDeCitas/Consultas/CancelacionesExternas.php","",function(data){
      $("#CitasCanceladasExt").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesExternas();

  
