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

    <!-- Mensaje de procesamiento -->
    <p id="processingMessage" style="display:none;">Procesando la foto, por favor espera...</p>

    <!-- Canvas donde se dibujará la foto -->
    <canvas id="canvas" style="display:none;"></canvas>

    <!-- Tesseract.js para OCR -->
    <script src="https://cdn.jsdelivr.net/npm/tesseract.js@2.1.1/dist/tesseract.min.js"></script>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const captureButton = document.getElementById('capture');
        const processingMessage = document.getElementById('processingMessage');

        // Solicitar acceso a la cámara trasera del usuario
        navigator.mediaDevices.getUserMedia({
            video: { facingMode: { exact: "environment" } }  // Usar la cámara trasera
        })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((err) => {
            console.error("Error al acceder a la cámara: ", err);
        });

        // Capturar la imagen
        captureButton.addEventListener('click', () => {
            // Mostrar el mensaje de procesamiento
            processingMessage.style.display = 'block';

            const context = canvas.getContext('2d');

            // Aumentar la resolución del canvas
            canvas.width = video.videoWidth * 2;
            canvas.height = video.videoHeight * 2;

            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Preprocesar la imagen en escala de grises
            const imageData = context.getImageData(0, 0, canvas.width, canvas.height);
            const pixels = imageData.data;

            for (let i = 0; i < pixels.length; i += 4) {
                const r = pixels[i];
                const g = pixels[i + 1];
                const b = pixels[i + 2];
                // Convertir a escala de grises usando la fórmula promedio
                const gray = 0.3 * r + 0.59 * g + 0.11 * b;
                pixels[i] = gray;
                pixels[i + 1] = gray;
                pixels[i + 2] = gray;
            }

            // Aplicar la imagen preprocesada al canvas
            context.putImageData(imageData, 0, 0);

            // Obtener la imagen procesada en formato base64
            const processedImage = canvas.toDataURL('image/png');

            // Usar Tesseract para OCR en inglés y español
            Tesseract.recognize(processedImage, 'eng+spa', {
                logger: (m) => console.log(m),
            }).then(({ data: { text } }) => {
                console.log("Texto reconocido:", text);

                // Enviar la imagen y el texto al backend PHP
                fetch('procesar.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ image: processedImage, recognizedText: text }),
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Datos procesados:", data);

                    // Ocultar el mensaje de procesamiento
                    processingMessage.style.display = 'none';

                    // Redirigir a la nueva página con el texto reconocido como parámetro en la URL
                    window.location.href = `resultado.php?texto=${encodeURIComponent(data.text)}`;
                })
                .catch(error => {
                    console.error("Error en el procesamiento:", error);
                    processingMessage.style.display = 'none';  // Ocultar el mensaje si ocurre un error
                });
            });
        });
    </script>
</body>
</html>
