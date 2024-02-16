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
        background-color: black; /* Fundo preto */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        position: relative;
        width: 507px; /* Tamanho da imagem de fundo */
        height: 502px; /* Tamanho da imagem de fundo */
        background-image: url('asset-3.png');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
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

        const animation = setInterval(() => {
            angle += 0.05;
            distance += 1;
            const x = startX + (distance * Math.cos(angle));
            const y = startY + (distance * Math.sin(angle));

            // Verifica se o projetil ultrapassou os limites da imagem de fundo
            if (x < 0 || x > container.offsetWidth || y < 0 || y > container.offsetHeight) {
                clearInterval(animation); // Remove a animação do projetil
                container.removeChild(projetil); // Remove o projetil do DOM
            } else {
                projetil.style.left = x + 'px';
                projetil.style.top = y + 'px';
            }
        }, 20);
    }

    setInterval(() => {
        dispararProjeteis(50);
    }, 3000);
});
</script>

</body>
</html>
