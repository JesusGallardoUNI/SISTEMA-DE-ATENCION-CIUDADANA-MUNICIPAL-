// clave.js
// Función que genera la clave con base en los selects
function generarClave() {
    const coloniaSelect = document.getElementById("colonia");
    const reporteSelect = document.getElementById("reporte");
    const claveInput = document.getElementById("Clave");

    const idColonia = coloniaSelect.options[coloniaSelect.selectedIndex].title;
    const tipoReporte = reporteSelect.value;

    const claveGenerada = `18/26/[${idColonia}][${tipoReporte}]-[`;

    claveInput.value = claveGenerada;
}

// Ejecutar al cambiar cualquier select
document.addEventListener("DOMContentLoaded", () => {
    document.getElementById("colonia").addEventListener("change", generarClave);
    document.getElementById("reporte").addEventListener("change", generarClave);

    // Inicializa por si ya están seleccionados al cargar
    generarClave();
});



//
//
//
const Anuncio = document.getElementById("Anuncio");
const Mensaje = Anuncio.querySelector(".Ciego");
Anuncio.addEventListener("click", ()=> {
    //
    Mensaje.classList.toggle("Ciego");
    if(Mensaje.classList.contains("Ciego")){
        console.log("Checo");
    } else {
        console.log("Perez");
    }
});



//Esta funcion no funciona actualmente, debo checar el porque
function generarPDF() {
    // Actualizar la fecha y hora al hacer clic en enviar
    actualizarFechaHora();

    //Persona
    const nombre = document.getElementById('nombre_persona').value;
    const telefono = document.getElementById('telefono_persona').value;
    const correo = document.getElementById('correo_persona').value;

    //Reporte
    const estado = document.getElementById('estado').value;
    const municipio = document.getElementById('municipio').value;
    const codigoPostal = document.getElementById('codigoPostal').value;
    const colonia = document.getElementById('colonia');
    const reporte = document.getElementById('reporte');
    const descripcion = document.getElementById('Descripcion').value;
    const calle = document.getElementById('calle').value;
    const coordenadas = document.getElementById('coordenadas').value;
    const imagenInput = document.getElementById('imagen'); 
    const fechaHora = document.getElementById('fechaHora').value;
    //const clave = document.getElementById('Clave').value;

    // Validación de campos
    const Mensaje = [];
    
    //Para los datos de la persona
    if(!nombre) Mensaje.push("Ingresa tu nombre");
    if(!telefono || !correo) Mensaje.push("Necesitamos tu numero de telefono o correo para comunicarnos");

    //Para los datos del reporte
    if (!codigoPostal) Mensaje.push("Código Postal");
    if (!colonia.value) Mensaje.push("Nombre de la Colonia");
    if (!reporte.value) Mensaje.push("Tipo de Reporte");
    if (!descripcion) Mensaje.push("Descripcion del reporte");
    if (!calle) Mensaje.push("Nombre de la Calle");
    if (!coordenadas) Mensaje.push("Seleccione en el mapa la hubicacion");
    if (!imagenInput.value) Mensaje.push("Imagen de Referencia");

    if (Mensaje.length > 0) {
        Swal.fire({
            title: "Reporte incompleto",
            text: "Asegúrate de completar los siguientes campos: " + Mensaje.join(", "),
            icon: "warning"
        })
        //alert("Por favor, completa los siguientes campos: " + Mensaje.join(", "));
        return;
    }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    const idColonia = colonia.selectedIndex;
    const idTipoReporte = reporte.selectedIndex;
    const claveReporte = `18 / 26 / ${idColonia} - ${idTipoReporte} - ${numPila}`;

    doc.setFont("Arial");
    doc.setFontSize(12);
    doc.text(fechaHora, 150, 10);
    doc.text(`Clave de Reporte: ${claveReporte}`, 15, 10);

    const contenido = `A día de hoy, el Estado libre y soberano de ${estado}, en el municipio de ${municipio}, código postal ${codigoPostal}, se hace el presente el reporte en cuestión a "${reporte.value}" que se encuentra en la colonia ${colonia.value}, en la calle ${calle} para darle a conocer a los funcionarios responsables el hecho de atender el presente reporte y resolver la problemática.`;
    const lineasDeTexto = doc.splitTextToSize(contenido, 180);
    let yPosition = 30;

    lineasDeTexto.forEach(linea => doc.text(linea, 15, yPosition += 10));
    yPosition += 20;

    const reader = new FileReader();
    reader.readAsDataURL(imagenInput.files[0]);
    reader.onloadend = function() {
        const base64Image = reader.result.split(',')[1];
        doc.addImage(base64Image, 'JPEG', 15, yPosition, 180, 120);

        yPosition += 130;
        doc.text("Ubicación exacta del reporte a atender:", 15, yPosition);
        doc.textWithLink(googleMapsLink, 15, yPosition + 10, { url: googleMapsLink });

        doc.save('reporte_ciudadano.pdf');
        numPila += 1;

        // Limpiar campos excepto "Fecha y hora de acceso"
        document.getElementById('codigoPostal').value = "";
        document.getElementById('colonia').value = "";
        document.getElementById('reporte').value = "";
        document.getElementById('calle').value = "";
        document.getElementById('googleMapsLink').value = "";
        document.getElementById('imagen').value = "";

        actualizarFechaHora(); // Actualizar para el próximo reporte
    };
}


var map = L.map('mi_mapa').setView([25.67688, -100.25943], 15);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', { 
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Definir un icono personalizado (flecha o ubicación tipo pin)
    var iconoUbicacion = L.icon({
        iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png', // puedes cambiar la URL por otra imagen
        iconSize: [30, 30],  // tamaño del icono
        iconAnchor: [15, 30], // punto del icono que se coloca en la coordenada
        popupAnchor: [0, -30] // posición del popup respecto al icono
    });

    // Crear marcador vacío (sin posición inicial)
    var marker = L.marker([25.67688, -100.25943], { icon: iconoUbicacion })
                 .addTo(map)
                 .bindPopup("Ubicación inicial");

    // Evento clic en el mapa
    map.on('click', function(e) {
        var lat = e.latlng.lat.toFixed(6);  
        var lng = e.latlng.lng.toFixed(6);  

        // Mostrar coordenadas en el input
        document.getElementById("coordenadas").value = lat + ", " + lng;

        // Mover el marcador a la nueva posición con el ícono de ubicación
        marker.setLatLng(e.latlng)
              .bindPopup("Nueva ubicación: " + lat + ", " + lng);
    });