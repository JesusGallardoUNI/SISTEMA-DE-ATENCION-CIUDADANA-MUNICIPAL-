// Esperar 4.5 segundos y luego ocultar el div
setTimeout(() => {
    let alerta = document.getElementById("alerta");
    if (alerta) {
        alerta.style.transition = "opacity 1s"; // Animación suave
        alerta.style.opacity = "0"; 
        setTimeout(() => alerta.remove(), 1000); // Lo elimina del DOM
    }
}, 4000);
