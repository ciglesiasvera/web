// Función para verificar si un número es par o impar
function verificarParImpar() {
    const numero = parseInt(document.getElementById('numero').value);
    const resultadoElemento = document.getElementById('resultado');
  
    if (isNaN(numero)) {
      resultadoElemento.innerText = "Por favor, ingresa un número válido.";
      return;
    }
  
    if (numero % 2 === 0) {
      resultadoElemento.innerText = `El número ${numero} es par.`;
    } else {
      resultadoElemento.innerText = `El número ${numero} es impar.`;
    }
  }
  