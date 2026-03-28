//============================================================//
//                ESTA PARTE VA EN INFORME.PHP                //
//============================================================//

const canvas = document.getElementById('firma');
if (canvas) {


    // Configurar Signature Pad
    const signaturePad = new SignaturePad(canvas);

    // Ajustar las coordenadas del lienzo
    window.addEventListener('resize', resizeCanvas);
    resizeCanvas();

    function resizeCanvas() {
        const ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext('2d').scale(ratio, ratio);
        signaturePad.clear(); // Borra la firma cuando se ajusta el tamaño del lienzo
    }

    // Función para borrar la firma
    function clearSignature() {
        signaturePad.clear();
    }

    function generatePDF() {
        const { jsPDF } = window.jspdf;

        // Crear una nueva instancia de jsPDF
        const doc = new jsPDF();

        // Obtener los valores del formulario
        const estado = document.getElementById('estado').value;
        const municipio = document.getElementById('municipio').value;
        const alcalde = document.getElementById('alcalde').value;
        const fecha = document.getElementById('fecha').value;
        const signatureImage = signaturePad.toDataURL('image/png');
        const Descripcion = document.getElementById("Descripcion").value;
        console.log("error aqui?");

        // Agregar fecha en el encabezado
        doc.setFontSize(12);
        doc.text(`Fecha: ${fecha}`, 150, 20);

        // Título de la carta
        doc.setFontSize(14);
        //doc.setFont("Arial", "bold");
        doc.text("Carta compromiso", 20, 40);
        doc.setLineWidth(0.5);
        doc.line(20, 41, 75, 41);

        // Contenido de la carta
        doc.setFontSize(12);
        doc.setFont("Arial", "normal");
        const text = `Por medio de la presente solicitud para dar a conocer las problemáticas y necesidades que presentan, yo el alcalde ${alcalde} del municipio de ${municipio} del Estado libre y soberano de ${estado}, me comprometo en atender y resolver todo lo señalado para darle solución de manera inmediata, garantizando así la calidad de los trabajos que se van a realizar con el fin de que los resultados esperados sean buenos en beneficio para la ciudadanía, además de que se garantice que los resultados sean duraderos.`;
        doc.text(text, 20, 60, { maxWidth: 170 });
        
        
        let Muestra_Texto = doc.splitTextToSize(Descripcion, 160);
        doc.text(Muestra_Texto, 20, 90);

        
        

        // Firma
        doc.setLineWidth(0.5);
        const signatureX = (doc.internal.pageSize.getWidth() - 150) / 2;
        const signatureY = 110;
        doc.line(signatureX, signatureY + 60, signatureX + 150, signatureY + 60); // Subraya la firma
        doc.addImage(signatureImage, 'PNG', signatureX, signatureY, 150, 60);

        // Nombre y firma del alcalde
        doc.setFont("Arial", "normal");
        doc.text("Nombre y firma del alcalde", doc.internal.pageSize.getWidth() / 2, signatureY + 80, { align: 'center' });
        doc.text(alcalde, doc.internal.pageSize.getWidth() / 2, signatureY + 90, { align: 'center' });

        //===============================================================//
        //   PRIMERO CONTESTAMOS EL FORMULARIO Y LUEGO NOS DA LA LISTA   //
        //===============================================================//
        let listado = document.getElementById("Listado");
        const elementos = listado.querySelectorAll("li");
        
        const margenIzquierdo = 20;
        const anchoMaximo = 160;
        const interlineado = 5; // Espacio entre líneas individuales
        const espacioEntreBloques = 8; // Espacio extra entre cada <li>

        let y = 220; // Posición inicial en la primera página
        const margenInferior = 275; // Límite antes de saltar de página
        const margenSuperior = 20;  // Dónde empieza el texto en la nueva página

        elementos.forEach((li) => {
            let textoLimpio = li.textContent.replace(/\s+/g, ' ').trim();
            let lineas = doc.splitTextToSize(textoLimpio, 160);

            // Calculamos cuánto espacio ocupará este bloque específico
            let alturaBloque = lineas.length * 5;

            // --- VALIDACIÓN DE SALTO DE PÁGINA ---
            // Si la posición actual (y) + lo que mide el bloque supera el límite:
            if (y + alturaBloque > margenInferior) {
                doc.addPage(); // Crea la nueva hoja
                y = margenSuperior; // Reinicia el cursor arriba
            }

            // Dibujamos el texto en la posición segura
            doc.text(lineas, 20, y);

            // Actualizamos 'y' para el siguiente elemento
            y += alturaBloque + 8;
        });

        // Descargar el PDF
        doc.save('Carta Compromiso.pdf');
    }
}


//============================================================//
//               ESTA PARTE SE VA PARA DATOS.PHP              //
//============================================================//

const Datos = document.getElementById("Datos");
if (Datos) {
    //Esto es de los inputs de la tabla donde los reportes NO estan resueltos
    //R = Reporte
    const R2 = parseInt(document.querySelector("#Rep2").value, 10);
    const R3 = parseInt(document.querySelector("#Rep3").value, 10);
    const R4 = parseInt(document.querySelector("#Rep4").value, 10);
    const R7 = parseInt(document.querySelector("#Rep7").value, 10);
    const R8 = parseInt(document.querySelector("#Rep8").value, 10);

    //Esto es de los inputs de la tabla donde los reportes SI estan resueltos
    //S = Solucionado
    const S2 = parseInt(document.querySelector("#Sol2").value, 10);
    const S3 = parseInt(document.querySelector("#Sol3").value, 10);
    const S4 = parseInt(document.querySelector("#Sol4").value, 10);
    const S7 = parseInt(document.querySelector("#Sol7").value, 10);
    const S8 = parseInt(document.querySelector("#Sol8").value, 10);

    //Esto es de los inputs de la tabla donde los reportes SI estan descartados
    //D = Descartado
    const D2 = parseInt(document.getElementById("Descartado2").value, 10);
    const D3 = parseInt(document.getElementById("Descartado3").value, 10);
    const D4 = parseInt(document.getElementById("Descartado4").value, 10);
    const D7 = parseInt(document.getElementById("Descartado7").value, 10);
    const D8 = parseInt(document.getElementById("Descartado8").value, 10);



    const ctx = document.getElementById('GrafoEstadistico');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                'Alumbrado Público',
                ['Limpia, recolección, traslado,', 'tratamiento y disposición final', 'de residuos'],
                ['Mercados y centrales', 'de abastos'],
                ['Calles, parques y', 'jardines y su equipamiento'],
                ['Seguridad pública,', 'policía preventiva', 'municipal y tránsito']
            ],
            datasets: [
                {
                    label: 'Reportes atendidos',
                    data: [S2, S3, S4, S7, S8],
                    borderWidth: 2,
                    backgroundColor: 'rgba(40, 167, 69, 0.7)',
                },
                {
                    label: 'Reportes pendientes',
                    data: [R2, R3, R4, R7, R8],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 193, 7, 0.7)',
                },
                {
                    label: 'Reportes descartados',
                    data: [D2, D3, D4, D7, D8],
                    borderWidth: 2,
                    backgroundColor: 'rgba(220, 53, 69, 0.7)',
                }
            ]
        },
        options: {
            scales: {
                x: {

                    ticks: {
                        maxRotation: 0,
                        minRotation: 0,
                        autoSkip: false
                    }
                },
                y: {

                    beginAtZero: true
                }
            }
        }
    });

}


//============================================================//
//              ESTA PARTE SE VA PARA GASTOS.PHP              //
//============================================================//

const Gastos = document.getElementById("Gastos");
if (Gastos) {
    new DataTable('#myTable', {
        scrollY: 300,
        paging: true,
        searching: true,
        autoWidth: false,

        pageLength: 10,
        lengthMenu: [10, 20, 50, 100],
        lengthChange: true,

        caption: 'Gastos aplicados a cada colonia de acuerdo al tipo de reporte',

        language: {
            search: "Buscar colonia:",
            info: "Mostrando _START_ a _END_ de un total de _TOTAL_ registros",
            infoEmpty: "No hay registros para mostrar",
            lengthMenu: "Mostrar cantidad de registros_MENU_",
            zeroRecords: "No se encontraron resultados"
        },

        layout: {
            topStart: 'search',
            topEnd: 'pageLength',
            bottomStart: 'info',
            bottomEnd: 'paging'
        },
    });

}


//====================================================================================//
//   ESTA PARTE SE VA PARA ReportesEnColonias.PHP y ReportesEnColoniasResueltos.PHP   //
//====================================================================================//

const TablaDashboard = document.getElementById("ReportesDashboard");
if (TablaDashboard) {
    let Verde = document.querySelectorAll(".FondoVerde").length - 1 || 0;
    let Amarillo = document.querySelectorAll(".FondoAmarillo").length - 1 || 0;
    let Naranja = document.querySelectorAll(".FondoNaranja").length - 1 || 0;
    let Rojo = document.querySelectorAll(".FondoRojo").length - 1 || 0;

    const Reportes_Verde = document.getElementById("Reportes_Verde");
    const Reportes_Amarillo = document.getElementById("Reportes_Amarillo");
    const Reportes_Naranja = document.getElementById("Reportes_Naranja");
    const Reportes_Rojo = document.getElementById("Reportes_Rojo");


    Reportes_Verde.innerText = Verde;
    Reportes_Amarillo.innerText = Amarillo;
    Reportes_Naranja.innerText = Naranja;
    Reportes_Rojo.innerText = Rojo;


}