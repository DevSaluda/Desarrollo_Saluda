document.addEventListener("DOMContentLoaded", function(){
    // Invocamos cada 5 segundos ;)
    const milisegundos = 900 *1000;
    setInterval(function(){
        // No esperamos la respuesta de la petición porque no nos importa
        fetch("https://controlfarmacia.com/CEDIS/Consultas/SesionV.php");
    },milisegundos);
});