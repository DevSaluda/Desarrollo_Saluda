function CargaChecadorSalidaDia(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/ChecadorDiaSalidas","",function(data){
      $("#SalidasPersonal").html(data);
    })
  
  }
  
  
  CargaChecadorSalidaDia();

  
