<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animación de Ramo de Flores</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="flower-animation">
        <div class="flower"></div>
        <div class="flower"></div>
        <div class="flower"></div>
        <div class="flower"></div>
        <div class="flower"></div>
        <div class="flower"></div>
        <div class="flower"></div>
        <div class="flower"></div>
        <div class="flower"></div>
    </div>
</body>
</html>


<style>
   body {
    background-color: #f0f0f0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    overflow: hidden;
}

.flower-animation {
    width: 300px;
    height: 300px;
    position: relative;
    transform: scale(0);
    animation: bloom 4s forwards;
}

.flower {
    width: 40px;
    height: 40px;
    background-color: red;
    border-radius: 50%;
    position: absolute;
    transform-origin: center bottom;
    animation: rotate 8s infinite linear, color-change 4s infinite alternate;
    animation-delay: 1s;
}

.flower:nth-child(1) {
    top: 0;
    left: 50px;
}

.flower:nth-child(2) {
    top: 70px;
    left: 100px;
}

.flower:nth-child(3) {
    top: 0;
    left: 150px;
}

.flower:nth-child(4) {
    top: 70px;
    left: 200px;
}

.flower:nth-child(5) {
    top: 100px;
    left: 50px;
}

.flower:nth-child(6) {
    top: 170px;
    left: 100px;
}

.flower:nth-child(7) {
    top: 100px;
    left: 150px;
}

.flower:nth-child(8) {
    top: 170px;
    left: 200px;
}

.flower:nth-child(9) {
    top: 30px;
    left: 125px;
}

@keyframes bloom {
    100% {
        transform: scale(1);
    }
}

@keyframes rotate {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

@keyframes color-change {
    0% {
        background-color: red;
    }
    100% {
        background-color: pink;
    }
}

@keyframes shake {
    0% {
        transform: translateX(0);
    }
    50% {
        transform: translateX(-5px);
    }
    100% {
        transform: translateX(0);
    }
}

.flower-animation::after {
    content: '¡Te Amo Wen!';
    font-size: 24px;
    font-weight: bold;
    position: absolute;
    top: 280px;
    left: 20px;
    opacity: 0;
    animation: fade-in 2s forwards;
    animation-delay: 4s;
}

@keyframes fade-in {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
 
</style>