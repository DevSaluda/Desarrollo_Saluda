function CargaChecadorGeneral(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/ChecadorGeneral","",function(data){
      $("#ChecadorGeneral").html(data);
    })
  
  }
  
  
  CargaChecadorGeneral();

  
