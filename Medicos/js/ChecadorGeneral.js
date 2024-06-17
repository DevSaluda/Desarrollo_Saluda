function CargaChecadorGeneral(){


    $.get("https://saludapos.com/AdminPOS/Consultas/ChecadorGeneral","",function(data){
      $("#ChecadorGeneral").html(data);
    })
  
  }
  
  
  CargaChecadorGeneral();

  
