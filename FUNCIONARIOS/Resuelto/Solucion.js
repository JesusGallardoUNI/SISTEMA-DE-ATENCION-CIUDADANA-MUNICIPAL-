// Función para establecer la fecha y hora de acceso actuales
function actualizarFechaHora() {
    const now = new Date();
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');
    const hours = String(now.getHours()).padStart(2, '0');
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const formattedDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;
    document.getElementById('FechaHoraResuelto').value = formattedDateTime;
}

// Establecer los valores iniciales en la página
document.addEventListener("DOMContentLoaded", function() {
    actualizarFechaHora();
    
    const params = new URLSearchParams(window.location.search);
    document.getElementById('estado').value = params.get('estado') || "NULL";
    document.getElementById('municipio').value = params.get('municipio') || "NULL";
    document.getElementById('colonia').value = params.get('colonia') || "NULL";
    document.getElementById('reporte').value = params.get('reporte') || "NULL";
});

function validarYGenerarPDF() {
    // Obtener valores de los campos
    const estado = document.getElementById('estado').value;
    const municipio = document.getElementById('municipio').value;
    const colonia = document.getElementById('colonia').value;
    const reporte = document.getElementById('reporte').value;
    const fechaHora = document.getElementById('fechaHora').value;
    const imagenInput = document.getElementById('imagen');

    // Validar que todos los campos tengan valores válidos
    if (estado === "NULL" || municipio === "NULL" || colonia === "NULL" || reporte === "NULL" || !imagenInput.value) {
        alert("Por favor, asegúrese de que todos los campos están completos y válidos.");
        return;
    }

    // Generación del PDF
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.setFont("Arial", "bold");
    doc.setFontSize(14);

    // Añadir contenido al PDF
    doc.text(`Nombre del Estado: ${estado}`, 15, 20);
    doc.text(`Nombre del Municipio: ${municipio}`, 15, 30);
    doc.text(`Nombre de la Colonia: ${colonia}`, 15, 40);
    doc.text(`Reporte: ${reporte}`, 15, 50);
    doc.text(`Fecha y hora de acceso: ${fechaHora}`, 15, 60);

    // Procesar la imagen y añadirla al PDF
    const reader = new FileReader();
    reader.onload = function(event) {
        const base64Image = event.target.result;
        doc.addImage(base64Image, 'JPEG', 15, 70, 180, 120);
        doc.save('reporte_resuelto.pdf');  // Guardar el archivo PDF
    };
    reader.onerror = function() {
        alert("Error al cargar la imagen. Intenta nuevamente.");
    };
    reader.readAsDataURL(imagenInput.files[0]);  // Leer el archivo de imagen como base64
}