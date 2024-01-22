function CargaCancelacionesExternas(){


    $.post("https://saludapos.com/Enfermeria2/Consultas/CancelacionesExternas.php","",function(data){
      $("#CitasCanceladasExt").html(data);
    })
  
  }
  
  
  
  CargaCancelacionesExternas();

  
