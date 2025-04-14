document.addEventListener("DOMContentLoaded", function () {
    const resultado = document.getElementById("resultado");
    const input = document.getElementById("numeroIntento");
    const boton = document.getElementById("botonAdivinar");

    const numeroSecreto = Math.floor(Math.random() * 100) + 1;

    // Función para manejar el intento
    function verificarIntento() {
        const intento = parseInt(input.value);

        if (isNaN(intento)) {
            resultado.textContent = "Por favor, ingresa un número válido.";
            return;
        }

        if (intento === numeroSecreto) {
            resultado.textContent = "¡Felicidades! Adivinaste el número";
        } else if (intento < numeroSecreto) {
            resultado.textContent = "El número es más alto...";
        } else {
            resultado.textContent = "El número es más bajo...";
        }
    }

    // Evento click del botón
    boton.addEventListener("click", verificarIntento);

    // Evento para la tecla Enter en el input
    input.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            verificarIntento();
        }
    });
});
