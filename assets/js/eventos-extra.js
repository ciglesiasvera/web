// Evento de clic en el botón
document.getElementById('botonEvento').addEventListener('click', () => {
    document.getElementById('eventoTexto').textContent = '¡Haz hecho clic en el botón!';
});

// Evento de teclado
document.getElementById('inputEvento').addEventListener('keyup', (e) => {
    document.getElementById('eventoTexto').textContent = `Escribiste: ${e.target.value}`;
});

// Contador de clics
let contador = 0;
const contadorElemento = document.getElementById("contador");
const botonContador = document.getElementById("boton-contador");

if (botonContador) {
    botonContador.addEventListener("click", function () {
        contador++;
        contadorElemento.textContent = `Clics: ${contador}`;
    });
}

// Movimiento con teclado
const caja = document.getElementById("caja");

if (caja) {
    document.addEventListener("keydown", function (evento) {
        const paso = 10;
        const style = window.getComputedStyle(caja);
        let left = parseInt(style.left);
        let top = parseInt(style.top);

        switch (evento.key) {
            case "ArrowLeft":
                caja.style.left = `${left - paso}px`;
                break;
            case "ArrowRight":
                caja.style.left = `${left + paso}px`;
                break;
            case "ArrowUp":
                caja.style.top = `${top - paso}px`;
                break;
            case "ArrowDown":
                caja.style.top = `${top + paso}px`;
                break;
        }
    });
}
