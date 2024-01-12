function  CaducanProntoProds(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/ProductosPorVencer.php","",function(data){
      $("#TableProdCaducaPronto").html(data);
    })

  }
  
  
  
  CaducanProntoProds();