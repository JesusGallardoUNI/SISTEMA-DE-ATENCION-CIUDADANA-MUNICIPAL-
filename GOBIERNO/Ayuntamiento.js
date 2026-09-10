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
        const doc = new jsPDF();

        //================================================//
        //                 DATOS DEL FORMULARIO           //
        //================================================//

        const estado = document.getElementById('estado').value;
        const municipio = document.getElementById('municipio').value;
        const alcalde = document.getElementById('alcalde').value;
        const fecha = document.getElementById('fecha').value;
        const signatureImage = signaturePad.toDataURL('image/png');
        const Descripcion = document.getElementById("Descripcion").value;


        //================================================//
        //                    CONSTANTES                  //
        //================================================//

        const anchoPagina = doc.internal.pageSize.getWidth();
        const altoPagina = doc.internal.pageSize.getHeight();

        const margenIzquierdo = 20;
        const margenDerecho = 20;
        const anchoContenido = anchoPagina - margenIzquierdo - margenDerecho;


        //================================================//
        //                 PRIMERA HOJA                   //
        //================================================//

        // Fecha
        doc.setFontSize(10);
        doc.setFont("Arial", "normal");

        doc.text(
            `Fecha: ${fecha}`,
            anchoPagina - 20,
            20,
            { align: "right" }
        );


        // Título
        doc.setFontSize(20);
        doc.setFont("Arial", "bold");

        doc.text(
            "CARTA COMPROMISO",
            anchoPagina / 2,
            40,
            { align: "center" }
        );


        // Línea decorativa
        doc.setLineWidth(0.8);
        doc.line(20, 45, anchoPagina - 20, 45);


        // Municipio
        doc.setFontSize(12);
        doc.setFont("Arial", "normal");

        doc.text(
            `${municipio}, ${estado}`,
            anchoPagina / 2,
            55,
            { align: "center" }
        );


        //================================================//
        //                 TEXTO PRINCIPAL                //
        //================================================//

        const textoCarta = `Por medio de la presente solicitud para dar a conocer las problemáticas y necesidades que presentan, yo el alcalde ${alcalde} del municipio de ${municipio} del Estado libre y soberano de ${estado}, me comprometo en atender y resolver todo lo señalado para darle solución de manera inmediata, garantizando así la calidad de los trabajos que se van a realizar con el fin de que los resultados esperados sean buenos en beneficio para la ciudadanía, además de que se garantice que los resultados sean duraderos.`;

        const lineasCarta = doc.splitTextToSize(
            textoCarta,
            anchoContenido
        );

        doc.text(lineasCarta, margenIzquierdo, 75);


        //================================================//
        //                    DESCRIPCIÓN                 //
        //================================================//

        const lineasDescripcion = doc.splitTextToSize(
            Descripcion,
            anchoContenido
        );

        doc.setFont("Arial", "bold");
        doc.text("Descripción:", margenIzquierdo, 115);

        doc.setFont("Arial", "normal");

        doc.text(
            lineasDescripcion,
            margenIzquierdo,
            125
        );


        //================================================//
        //                      FIRMA                     //
        //================================================//

        const signatureX = (anchoPagina - 150) / 2;
        const signatureY = 160;

        doc.addImage(
            signatureImage,
            'PNG',
            signatureX,
            signatureY,
            150,
            50
        );

        doc.setLineWidth(0.5);

        doc.line(
            signatureX,
            signatureY + 50,
            signatureX + 150,
            signatureY + 50
        );


        doc.setFontSize(11);

        doc.text(
            "Nombre y firma del alcalde",
            anchoPagina / 2,
            signatureY + 65,
            { align: "center" }
        );

        doc.setFont("Arial", "bold");

        doc.text(
            alcalde,
            anchoPagina / 2,
            signatureY + 75,
            { align: "center" }
        );


        //================================================//
        //                 SEGUNDA HOJA                   //
        //================================================//

        // OBLIGAMOS A QUE EL LISTADO COMIENCE
        // EN UNA NUEVA PÁGINA

        doc.addPage();


        //================================================//
        //                 ENCABEZADO                     //
        //================================================//

        doc.setFont("Arial", "bold");
        doc.setFontSize(18);

        doc.text(
            "LISTADO DE REPORTES",
            anchoPagina / 2,
            25,
            { align: "center" }
        );


        doc.setLineWidth(0.8);

        doc.line(
            20,
            30,
            anchoPagina - 20,
            30
        );


        doc.setFont("Arial", "normal");
        doc.setFontSize(10);

        doc.text(
            `Municipio: ${municipio}`,
            20,
            40
        );

        doc.text(
            `Fecha: ${fecha}`,
            anchoPagina - 20,
            40,
            { align: "right" }
        );


        //================================================//
        //                 LISTADO                        //
        //================================================//

        const listado = document.getElementById("Listado");
        const elementos = listado.querySelectorAll("li");

        let y = 55;

        const margenInferior = altoPagina - 20;
        const espacioEntreBloques = 8;
        const altoLinea = 5;

        elementos.forEach((li, indice) => {

            let textoLimpio = li.textContent
                .replace(/\s+/g, ' ')
                .trim();

            let lineas = doc.splitTextToSize(
                textoLimpio,
                anchoContenido
            );

            let alturaBloque = lineas.length * altoLinea;


            //================================================//
            //          ¿NECESITAMOS OTRA PÁGINA?             //
            //================================================//

            if (y + alturaBloque > margenInferior) {

                doc.addPage();

                // Encabezado de continuación
                doc.setFont("Arial", "bold");
                doc.setFontSize(14);

                doc.text(
                    "LISTADO DE REPORTES",
                    anchoPagina / 2,
                    20,
                    { align: "center" }
                );

                doc.setLineWidth(0.5);

                doc.line(
                    20,
                    25,
                    anchoPagina - 20,
                    25
                );

                y = 40;
            }


            //================================================//
            //                  NÚMERO                       //
            //================================================//

            doc.setFont("Arial", "bold");
            doc.setFontSize(10);

            doc.text(
                `${indice + 1}.`,
                20,
                y
            );


            //================================================//
            //                    TEXTO                      //
            //================================================//

            doc.setFont("Arial", "normal");

            doc.text(
                lineas,
                28,
                y
            );


            y += alturaBloque + espacioEntreBloques;

        });


        //================================================//
        //                  PIE DE PÁGINA                 //
        //================================================//

        const paginas = doc.internal.getNumberOfPages();

        for (let i = 1; i <= paginas; i++) {

            doc.setPage(i);

            doc.setFontSize(8);
            doc.setFont("Arial", "normal");

            doc.text(
                `Página ${i} de ${paginas}`,
                anchoPagina / 2,
                altoPagina - 10,
                { align: "center" }
            );
        }


        //================================================//
        //                    GUARDAR                     //
        //================================================//

        doc.save("Carta Compromiso.pdf");
    }
}


//============================================================//
//               ESTA PARTE SE VA PARA DATOS.PHP              //
//============================================================//

const Datos = document.getElementById("Datos");
if (Datos) {
    //Esto es de los inputs de la tabla donde los reportes NO estan resueltos
    //R = Reporte
    const R1 = parseInt(document.querySelector("#Rep1").value, 10);
    const R2 = parseInt(document.querySelector("#Rep2").value, 10);
    const R3 = parseInt(document.querySelector("#Rep3").value, 10);
    const R4 = parseInt(document.querySelector("#Rep4").value, 10);
    const R5 = parseInt(document.querySelector("#Rep5").value, 10);
    const R7 = parseInt(document.querySelector("#Rep7").value, 10);
    const R8 = parseInt(document.querySelector("#Rep8").value, 10);

    //Esto es de los inputs de la tabla donde los reportes SI estan resueltos
    //S = Solucionado
    const S1 = parseInt(document.querySelector("#Sol1").value, 10);
    const S2 = parseInt(document.querySelector("#Sol2").value, 10);
    const S3 = parseInt(document.querySelector("#Sol3").value, 10);
    const S4 = parseInt(document.querySelector("#Sol4").value, 10);
    const S5 = parseInt(document.querySelector("#Sol5").value, 10);
    const S7 = parseInt(document.querySelector("#Sol7").value, 10);
    const S8 = parseInt(document.querySelector("#Sol8").value, 10);

    //Esto es de los inputs de la tabla donde los reportes SI estan descartados
    //D = Descartado
    const D1 = parseInt(document.getElementById("Descartado1").value, 10);
    const D2 = parseInt(document.getElementById("Descartado2").value, 10);
    const D3 = parseInt(document.getElementById("Descartado3").value, 10);
    const D4 = parseInt(document.getElementById("Descartado4").value, 10);
    const D5 = parseInt(document.getElementById("Descartado5").value, 10);
    const D7 = parseInt(document.getElementById("Descartado7").value, 10);
    const D8 = parseInt(document.getElementById("Descartado8").value, 10);



    const ctx = document.getElementById('GrafoEstadistico');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                ['Agua potable, drenaje,', 'alcantarillado, tratamiento', 'y disposición de sus aguas residuales'],
                'Alumbrado Público',
                ['Limpia, recolección, traslado,', 'tratamiento y disposición final', 'de residuos'],
                ['Mercados y centrales', 'de abastos'],
                'Panteones',
                ['Calles, parques y', 'jardines y su equipamiento'],
                ['Seguridad pública,', 'policía preventiva', 'municipal y tránsito']
            ],
            datasets: [
                {
                    label: 'Reportes atendidos',
                    data: [S1, S2, S3, S4, S5, S7, S8],
                    borderWidth: 2,
                    backgroundColor: 'rgba(40, 167, 69, 0.7)',
                },
                {
                    label: 'Reportes pendientes',
                    data: [R1, R2, R3, R4, R5, R7, R8],
                    borderWidth: 2,
                    backgroundColor: 'rgba(255, 193, 7, 0.7)',
                },
                {
                    label: 'Reportes descartados',
                    data: [D1, D2, D3, D4, D5, D7, D8],
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