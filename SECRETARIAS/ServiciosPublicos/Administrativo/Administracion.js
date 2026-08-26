
function cargarSeccion(Opcion) {
    let Ruta = "";
    switch (Opcion) {
        case 0:
            Ruta = "Acciones/RegistrarServiciosPublicos.php";        
            break;
        case 1:
            Ruta = "Acciones/ListadoEmpleados.php";    
            break;
        case 2:
            Ruta = "Acciones/RendimientoEmpleados.php";   
            break;
        case 3:
            Ruta = "Acciones/RegistrarAreasEncargadas.php";
            break;
    }
    fetch(Ruta)
        .then(res => res.text())
        .then(contenido => {
            
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
const BASE = "/GUADALUPE/SECRETARIAS/ServiciosPublicos/Administrativo";
// Delegación global
document.addEventListener("submit", function (e) {
    if (e.target.classList.contains("FormularioTotal")) {
        e.preventDefault();
        let datos = new FormData(e.target);
        fetch(BASE + "/Acciones/RegistrarServiciosPublicos.php", {
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






document.addEventListener("submit", function (e) {

    if (e.target.id === "Cambio") {
        e.preventDefault();
        Muestra_Alerta("Reporte completo", "El reporte a sido enviado a la autoridad correspondiente", "success");


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