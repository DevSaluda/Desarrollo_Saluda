<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Captura de Foto y Procesamiento</title>
</head>
<body>
    <h2>Capturar Foto</h2>

    <!-- Video para mostrar la cámara -->
    <video id="video" autoplay></video>
    <button id="capture">Capturar Foto</button>

    <!-- Canvas donde se dibujará la foto -->
    <canvas id="canvas" style="display:none;"></canvas>

    <!-- Tesseract.js para OCR -->
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.1.1/dist/tesseract.min.js"></script>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('capture');

        // Solicitar acceso a la cámara del usuario
        navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((err) => {
            console.error("Error al acceder a la cámara: ", err);
        });

        // Capturar la imagen
        captureButton.addEventListener('click', () => {
            const context = canvas.getContext('2d');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Obtener la imagen en formato base64
            const imageData = canvas.toDataURL('image/png');

            // Usar Tesseract para OCR
            Tesseract.recognize(imageData, 'spa', {
                logger: (m) => console.log(m),
            }).then(({ data: { text } }) => {
                console.log("Texto reconocido:", text);

                // Enviar la imagen y el texto al backend PHP
                fetch('procesar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ image: imageData, recognizedText: text }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Datos procesados:", data);
                    alert("Datos procesados correctamente: " + data.message);
                })
                .catch(error => console.error("Error en el procesamiento:", error));
            });
        });
    </script>
</body>
</html>
