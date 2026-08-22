//=======================//
//   DATOS UNIVERDALES   //
//=======================//
const Servicios = {
    1: "Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales",
    2: "Alumbrado público",
    3: "Limpia, recolección, traslado, tratamiento y disposición final de residuos",
    4: "Mercados y centrales de abasto",
    5: "Panteones",
    6: "Rastro",
    7: "Calles, parques y jardines y su equipamiento",
    8: "Seguridad pública, policía preventiva municipal y tránsito"
}

//
//
//


//=====================================//
//   ESTO ES PARA BUSCAR INFORMACION   //
//=====================================//
const fondo = document.getElementById("fondo");
const Anuncio = document.getElementById("Anuncio");
const Mensaje = Anuncio.querySelector(".Ciego");
Anuncio.addEventListener("click", ()=> {
    //
    const anchoVentana = window.innerWidth;
    Mensaje.classList.toggle("Ciego");
    if(anchoVentana <= 548) {
        fondo.classList.toggle("Anunciofondo");
        Anuncio.classList.toggle("AnuncioCompleto");
    }else {
        // Opcional: Asegurarse de quitarla si la pantalla es grande
        Anuncio.classList.remove("AnuncioCompleto");
        fondo.classList.remove("Anunciofondo");
    }

    if(Mensaje.classList.contains("Ciego")){
        console.log("Checo");
    } else {
        console.log("Perez");
    }
});


document.getElementById("FormularioReporte").addEventListener("submit", function(e) {
    e.preventDefault(); // 🚨 evita que se envíe el formulario
    generarPDF();

});




async function generarPDF() {
    // Persona
    const nombre = document.getElementById('nombre_persona').value;
    const telefono = document.getElementById('telefono_persona').value;

    // Reporte
    const estado = document.getElementById('estado').value;
    const municipio = document.getElementById('municipio').value;
    const colonia = document.getElementById('colonia');
    const valor_reporte = document.getElementById('reporte').value;
    const reporte = Servicios[valor_reporte];
    const especificacion = document.querySelector('input[name="especificacion"]:checked')?.value;
    const descripcion = document.getElementById('Descripcion').value;
    const calle = document.getElementById('calle').value;
    const coordenadas = document.getElementById('coordenadas').value;
    const imagenInput = document.getElementById('imagen'); 
    const DatoFecha = document.getElementById('fechaHora').value;
    const [Anio, Mes, Dia] = DatoFecha ? DatoFecha.split("-") : ["--", "--", "----"];

    const fechaHora = `${Dia}/${Mes}/${Anio}`;
    const Folio = document.getElementById('Clave').value;

    // Validación de campos
    const Mensaje = [];
    if (!nombre) Mensaje.push("Tu nombre");
    if (!telefono) Mensaje.push("Tu teléfono");
    if (!colonia.value) Mensaje.push("Nombre de la colonia");
    if (!reporte) Mensaje.push("Tipo de reporte");
    if (!descripcion) Mensaje.push("Descripción del reporte");
    if (!calle) Mensaje.push("Nombre de la calle");
    if (!coordenadas) Mensaje.push("Ubicación en el mapa");
    if (!imagenInput.files.length) Mensaje.push("Imagen de referencia");

    if (Mensaje.length > 0) {
        Swal.fire({
            title: "Reporte incompleto",
            text: "Asegúrate de completar los siguientes campos: " + Mensaje.join(", "),
            icon: "warning"
        });
        return;
    }

    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();


    const mapaElemento = document.getElementById('mi_mapa');

    // Captura visual del contenedor del mapa
    const mapaCanvas = await html2canvas(mapaElemento, {
        useCORS: true,       // Permite cargar tiles/imágenes externas de OpenStreetMap
        allowTaint: false,
        scale: 2             // Mejora la resolución de la captura
    });
    
    const mapaBase64 = mapaCanvas.toDataURL('image/jpeg', 0.95);


    // Estilos globales
    doc.setFont("helvetica", "normal");

    // --- ENCABEZADO ---
    const imagenLogo = "../Recursos/Imagenes/icono.png";
    doc.addImage(imagenLogo, "PNG", 14, 10, 18, 18);

    doc.setFont("helvetica", "bold");
    doc.setFontSize(16);
    doc.setTextColor(30, 41, 59); // Slate dark
    doc.text("Gobierno Municipal de Guadalupe", 38, 18);
    
    doc.setFont("helvetica", "normal");
    doc.setFontSize(9);
    doc.setTextColor(100, 116, 139);
    

    doc.setFontSize(10);
    doc.text(`Fecha: ${fechaHora}`, 196, 18, { align: "right" });

    // Línea divisora superior
    doc.setDrawColor(242, 92, 63);
    doc.setLineWidth(0.8);
    doc.line(14, 32, 196, 32);

    // --- BLOQUE DATOS CIUDADANO / FOLIO ---
    doc.setFillColor(248, 250, 252);
    doc.roundedRect(14, 36, 182, 22, 2, 2, "F");

    doc.setFontSize(10);
    doc.setFont("helvetica", "bold");
    doc.setTextColor(225, 29, 72); // Color destacado para el Folio
    doc.text(`Folio: ${Folio}`, 20, 44);

    doc.setFont("helvetica", "normal");
    doc.setTextColor(51, 65, 85);
    doc.text(`Solicitante: ${nombre}`, 20, 52);
    doc.text(`Teléfono: ${telefono}`, 20, 57);

    // --- TABLA DETALLES DEL REPORTE ---
    doc.autoTable({
        startY: 64,
        head: [["Campo", "Detalle del Reporte"]],
        body: [
            ["Colonia", colonia.value],
            ["Calle", calle],
            ["Sección de reporte", reporte],
            ["Reporte", especificacion || "N/A"],
            ["Descripción", descripcion],
        ],
        theme: 'striped',
        headStyles: { 
            fillColor: [242, 92, 63], 
            textColor: [255, 255, 255], 
            fontStyle: 'bold',
            halign: 'left'
        },
        columnStyles: {
            0: { fontStyle: 'bold', cellWidth: 45, textColor: [71, 85, 105] },
            1: { cellWidth: 'auto', textColor: [15, 23, 42] }
        },
        margin: { left: 14, right: 14 },
        styles: { fontSize: 9.5, cellPadding: 3.5 }
    });

    let finalY = doc.lastAutoTable.finalY + 10;

    // 2. INSERTAR EL MAPA EN EL PDF
    doc.setFont("helvetica", "bold");
    doc.setFontSize(11);
    doc.setTextColor(30, 41, 59);
    doc.text("Ubicación en el Mapa:", 14, finalY);

    // Ajustar dimensiones del mapa (Ancho: 182mm, Alto proporcional ~70mm)
    doc.addImage(mapaBase64, 'JPEG', 14, finalY + 4, 182, 70);

    finalY += 80; // Desplazar coordenada Y para el siguiente contenido



    // --- ADJUNTAR IMAGEN DE REFERENCIA ---
    const file = imagenInput.files[0];
    const reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onloadend = function() {
        const base64Data = reader.result;
        const format = file.type.includes("png") ? "PNG" : "JPEG";

        // Si la tabla ocupó mucho espacio, agregamos nueva página para la foto
        if (finalY + 85 > 280) {
            doc.addPage();
            finalY = 20;
        }

        doc.setFont("helvetica", "bold");
        doc.setFontSize(11);
        doc.setTextColor(30, 41, 59);
        doc.text("Evidencia Fotográfica:", 14, finalY);

        // Renderizado proporcional de la imagen
        doc.addImage(base64Data, format, 14, finalY + 4, 182, 80);

        // Guardar archivo
        doc.save(`Reporte_${Folio}_Ciudadano.pdf`);

        // Alerta de confirmación
        Swal.fire({
            title: "Reporte enviado con éxito",
            text: `Tu reporte quedó registrado con el Folio: ${Folio}. Puedes consultar el seguimiento dando clic en la lupa.`,
            icon: "success"
        }).then(() => {
            document.getElementById("FormularioReporte").submit();
        });
    };
}


//========================================//
//   ESTO NOS MUESTRA UN MAPA FUNCIONAL   //
//========================================//
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



    const GPS = document.getElementById("GPS");

GPS.addEventListener("click", () => {

    if (!navigator.geolocation) {
        alert("Tu navegador no permite obtener la ubicación.");
        return;
    }

    navigator.geolocation.getCurrentPosition(
        (posicion) => {

            const lat = posicion.coords.latitude;
            const lng = posicion.coords.longitude;

            console.log("Latitud:", lat);
            console.log("Longitud:", lng);

            // Guardar coordenadas en el input
            document.getElementById("coordenadas").value =
                `${lat.toFixed(6)}, ${lng.toFixed(6)}`;

            // Mover el marcador
            marker.setLatLng([lat, lng])
                  .bindPopup("📍 Tu ubicación actual")
                  .openPopup();

            // Centrar el mapa
            map.setView([lat, lng], 17);
        },

        (error) => {
            console.error(error);

            alert("No fue posible obtener tu ubicación.");
        }
    );
});