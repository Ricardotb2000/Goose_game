function animateBackground() {
    const colors = ["#FF0000", "#FF7F00", "#FFFF00", "#00FF00", "#0000FF", "#4B0082", "#9400D3"];
    const background = document.getElementById("background");
    let index = 0;

    function changeColor() {
        background.style.backgroundColor = colors[index];
        index = (index + 1) % colors.length;
    }

    setInterval(changeColor, 1000); // Cambia el color de fondo cada 1000 ms (1 segundo)
}

animateBackground(); // Inicia la animación al cargar la página
