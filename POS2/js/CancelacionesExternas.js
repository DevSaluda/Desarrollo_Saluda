function CargaCancelacionesExternas(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CancelacionesExternas.php","",function(data){
      $("#CitasCanceladasExt").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesExternas();

  
