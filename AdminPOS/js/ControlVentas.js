$(document).ready(function(){
    $("#frm_filtrarproducto").submit(function(e){
        e.preventDefault();
        filtarPorProducto();
    });
});
function CargaVentasDelDia(){


    $.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDia.php","",function(data){
      $("#TableVentasDelDia").html(data);
    })

  }
  
  function filtarPorProducto(){
    alert("Hola");
    //$.post("https://saludapos.com/AdminPOS/Consultas/VentasDelDia.php","",function(data){
    //  $("#TableVentasDelDia").html(data);
    //})
  }
  
  CargaVentasDelDia();