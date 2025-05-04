// Función para sumar dos números
function sumar(a, b) {
    return a + b;
  }
  
  // Función para restar dos números
  function restar(a, b) {
    return a - b;
  }
  
  // Función para multiplicar dos números
  function multiplicar(a, b) {
    return a * b;
  }
  
  // Función para dividir dos números
  function dividir(a, b) {
    if (b === 0) {
      return "Error: División por cero no permitida.";
    }
    return a / b;
  }
  
  // Función principal de la calculadora
  function calcular() {
    const num1 = parseFloat(document.getElementById('num1').value);
    const num2 = parseFloat(document.getElementById('num2').value);
    const operacion = document.getElementById('operacion').value;
    let resultado;
  
    switch (operacion) {
      case 'sumar':
        resultado = sumar(num1, num2);
        break;
      case 'restar':
        resultado = restar(num1, num2);
        break;
      case 'multiplicar':
        resultado = multiplicar(num1, num2);
        break;
      case 'dividir':
        resultado = dividir(num1, num2);
        break;
      default:
        resultado = "Operación no válida.";
    }
  
    document.getElementById('resultado').innerText = `Resultado: ${resultado}`;
  }
  