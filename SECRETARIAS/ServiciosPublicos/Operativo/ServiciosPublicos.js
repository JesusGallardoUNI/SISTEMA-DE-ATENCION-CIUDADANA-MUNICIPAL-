
function cargarSeccion(Opcion) {
    let Ruta = "";
    switch (Opcion) {
        case 0:
            Ruta = "Acciones/Total.php";        //YA
            break;
        case 1:
            Ruta = "Acciones/Pendiente.php";    //YA
            break;
        case 2:
            Ruta = "Acciones/Completado.php";   //YA
            break;
        case 3:
            Ruta = "Acciones/Descartar.php";    //YA
            break;
        case 4:
            Ruta = "Acciones/Estadistica.php";  //YA (ARREGLAR EL DATO DE CUANDO ES DESCARTADO YA NO SEA PENDIENTE)
            break;
        case 5:
            Ruta = "Acciones/Cambio.php";
            break;
        case 6:
            Ruta = "Acciones/Informe.php";      //YA
            break;


    }
    fetch(Ruta)
        .then(res => res.text())
        .then(contenido => {
            /*
            const Muestra = document.getElementById("contenido");
            Muestra.replaceChildren();
            */
            document.getElementById("contenido").innerHTML = "";


            document.getElementById("contenido").innerHTML = contenido;

            //Adiciones particulares:
            //Para Estadistica.php
            const Estadistica = document.getElementById("Estadistica");
            if (Estadistica) {
                Grafica(Estadistica);
            }


        });
}



//================================================//
//                Para formularios                //
//================================================//
const BASE = "/GUADALUPE/SECRETARIAS/ServiciosPublicos";
// Delegación global
document.addEventListener("submit", function (e) {
    if (e.target.classList.contains("FormularioTotal")) {
        e.preventDefault();
        let datos = new FormData(e.target);
        fetch(BASE + "/Acciones/Total.php", {
            method: "POST",
            body: datos
        })
            .then(res => res.text())
            .then(html => {
                // Recargamos la tabla actualizada
                document.getElementById("contenido").innerHTML = html;
            })
            .catch(error => {
                console.error("Error:", error);
            });
    }
});


//================================================//
//                    Para PDF                    //
//================================================//
function GenerarPDF_Cambio() {
    //Aqui agarro TODOS los valores del formulario
    let Actual = document.getElementById("F_Actual").value;         //Fecha
    let Nombre = document.getElementById("NombreCompleto").value;    //Nombre completo
    let Telefono = document.getElementById("Telefono").value;       //Telefono
    let Correo = document.getElementById("Correo").value;           //Correo
    let Cargo = document.getElementById("CargoActual").value;       //Cargo
    let Motivo = document.getElementById("Motivo").value;           //Motivo
    let OpcionesCambio = document.getElementById("Permanente");         //Cambio
    const OpcionesCambio_Texto = OpcionesCambio.selectedOptions[0].text;
    let OpcionesDependencia = document.getElementById("CargoCambio");   //Dependencia
    const OpcionesDependencia_Texto = OpcionesDependencia.selectedOptions[0].text;




    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    //Aqui empiezo a darle el formato al PDF

    //===---TIPO HEADER---===//
    //Agregar una imagen
    const imagen = "../../Recursos/Imagenes/icono.png";
    doc.addImage(imagen, "PNG", 10, 12, 20, 20);


    doc.setFontSize(22);
    doc.setTextColor(67, 45, 215); // RGB valor Para color de letras
    doc.text('Solicitud de cambio de cargo', 60, 24);

    doc.setFontSize(10);
    doc.text(`Fecha: ${Actual}`, 165, 15);
    doc.line(40, 25, 180, 25);          //Te crea una linea


    //===---TIPO TABLA---===//
    doc.autoTable({
        startY: 40,
        head: [["", ""]],
        body: [
            ["Nombre:", Nombre],
            ["Telefono:", Telefono],
            ["Correo:", Correo],
            ["Area asignada actual:", Cargo],
            ["Area a cambiar:", OpcionesDependencia_Texto],
        ],
        headStyles: { fillColor: [242, 92, 63] },
        margin: { left: 20, right: 20 },
    });

    //===---TIPO DESCRIPCION---===//
    doc.setTextColor(49, 201, 80); //VERDE
    doc.setFontSize(10);

    doc.setDrawColor(200, 200, 200);
    doc.setFillColor(248, 249, 250);
    doc.roundedRect(20, 95, 170, 50, 2, 2, "FD");

    let Texto = `Motivo: ${Motivo}, Yo deceo que mi cambio ${OpcionesCambio_Texto} sea de forma permantente Y que mi area sea ${OpcionesDependencia_Texto} `;

    let Muestra_Texto = doc.splitTextToSize(Texto, 160);

    doc.text(Muestra_Texto, 25, 100);

    doc.setFontSize(12);
    doc.text("Movimiento aprobado", 25, 160);

    doc.rect(25, 165, 4, 4);
    doc.text("Si", 30, 169);

    doc.rect(25, 175, 4, 4);
    doc.text("No", 30, 179);

    doc.text("Firma de conformidad", 130, 160);
    doc.line(120, 180, 180, 180);
    doc.text(Nombre, 120, 185);

    doc.text("Fecha de recibido", 25, 200);
    doc.line(60, 200, 100, 200);


    doc.text("Nombre de quien recibe", 25, 210);
    doc.line(75, 210, 150, 210);

    doc.text("Firma", 25, 220);
    doc.line(40, 220, 100, 220);



    doc.save('Solicitud de cambio.pdf');
    
}



document.addEventListener("submit", function (e) {

    if (e.target.id === "Cambio") {
        e.preventDefault();
        Muestra_Alerta("Reporte completo", "El reporte a sido enviado a la autoridad correspondiente", "success");
        GenerarPDF_Cambio();


        setTimeout(() => {
            e.target.submit();
        }, 1400);
    }

});


//================================================//
//                Para Estadistica                //
//================================================//
const Grafica = (Estadistica) => {
    //
    const Pendientes = Number(document.getElementById("Pendientes").value);
    const Resueltos = Number(document.getElementById("Resueltos").value);
    const Descartados = Number(document.getElementById("Descartados").value);

    const data = {
        labels: [
            'Descartado',
            'Resuelto',
            'Pendiente'
        ],
        datasets: [{
            label: 'Total: ',
            data: [Descartados, Resueltos, Pendientes],
            backgroundColor: [
                'rgb(220, 53, 69)',
                'rgb(40, 167, 69)',
                'rgb(255, 193, 7)'
            ],
            hoverOffset: 4
        }]
    };


    new Chart(Estadistica, {
        type: 'pie',
        data: data,
    });

}