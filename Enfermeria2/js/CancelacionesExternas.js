function CargaCancelacionesExternas(){


    $.post("https://controlfarmacia.com/Enfermeria2/Consultas/CancelacionesExternas.php","",function(data){
      $("#CitasCanceladasExt").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesExternas();

  
