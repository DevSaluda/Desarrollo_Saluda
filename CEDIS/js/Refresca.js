document.addEventListener("DOMContentLoaded", function(){
    // Invocamos cada 5 minutos
    const milisegundos = 300 * 1000;
    setInterval(function(){
        // No esperamos la respuesta de la petición porque no nos importa
        fetch("https://saludapos.com/CEDIS/Consultas/SesionV.php");
    }, milisegundos);
});
