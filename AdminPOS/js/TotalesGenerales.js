function  TotalGeneralSinCorte(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/TotalGeneralSinCorte.php","",function(data){
      $("#TotalesGeneralSin").html(data);
    })

  }
  
  
  
  TotalGeneralSinCorte();