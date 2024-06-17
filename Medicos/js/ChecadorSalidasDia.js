function CargaChecadorSalidaDia(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ChecadorDiaSalidas","",function(data){
      $("#SalidasPersonal").html(data);
    })
  
  }
  
  
  CargaChecadorSalidaDia();

  
