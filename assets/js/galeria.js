document.addEventListener("DOMContentLoaded", function () {
    const galeria = document.getElementById("galeria");
    const imagenes = galeria.querySelectorAll("img");

    imagenes.forEach(img => {
        img.addEventListener("click", function () {
            alert(`Has hecho clic en la imagen: ${img.alt}`);
        });
    });
});
