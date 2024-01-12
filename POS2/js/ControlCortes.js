function  CortesDeCaja(){


    $.post("https://controlfarmacia.com/POS2/Consultas/CortesDeCajas.php","",function(data){
      $("#TableCorteDeCaja").html(data);
    })

  }
  
  
  
  CortesDeCaja();