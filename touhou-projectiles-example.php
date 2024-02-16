<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>touhou-projectiles-example</title>
<style>
    body {
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-image: url('asset-3.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
    }
    .container {
        position: relative;
        width: 50px;
        height: 50px;
        background-image: url('asset-1.png');
        background-size: cover;
    }
    .quadrado {
        width: 100%;
        height: 100%;
    }
    .projetil {
        position: absolute;
        width: 20px;
        height: 20px;
    }
</style>
</head>
<body>

<div class="container">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.container');

    function dispararProjeteis(quantidade) {
        for (let i = 0; i < quantidade; i++) {
            const projetil = criarProjetil();
            container.appendChild(projetil);
            animarProjetil(projetil, i, quantidade);
        }
    }

    function criarProjetil() {
        const projetil = document.createElement('img');
        projetil.src = 'asset-2.png';
        projetil.classList.add('projetil');
        return projetil;
    }

    function animarProjetil(projetil, index, total) {
        const startX = container.offsetWidth / 2 - projetil.offsetWidth / 2;
        const startY = container.offsetHeight / 2 - projetil.offsetHeight / 2;
        let angle = (index * (360 / total)) * Math.PI / 180;
        let distance = 10;

        setInterval(() => {
            angle += 0.05;
            distance += 1;
            const x = startX + (distance * Math.cos(angle));
            const y = startY + (distance * Math.sin(angle));
            projetil.style.left = x + 'px';
            projetil.style.top = y + 'px';
        }, 20);
    }

    setInterval(() => {
        dispararProjeteis(50);
    }, 3000);
});
</script>

</body>
</html>
