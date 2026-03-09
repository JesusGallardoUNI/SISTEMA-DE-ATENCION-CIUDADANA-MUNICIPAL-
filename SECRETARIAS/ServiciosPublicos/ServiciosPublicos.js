
function cargarSeccion(Opcion) {
    let Ruta="";
    switch(Opcion) {
        case 0: 
            Ruta = "Total.php";
        break;
        case 1: 
            Ruta = "Pendiente.php";
        break;
        case 2: 
            Ruta = "Completado.php";
        break;
        case 3: 
            Ruta = "Descartar.php";
        break;
        case 4: 
            Ruta = "Estadistica.php";
        break;
        case 5: 
            Ruta = "Cambio.php";
        break;
        case 6: 
            Ruta = "Informe.php";
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
            //Para Cambio.php
            let Actual = document.getElementById("F_Actual");               //Fecha
            if(Actual){
                Actual.value = Fecha();
            }
            

        });
}



//================================================//
//                Para formularios                //
//================================================//
const BASE = "/GUADALUPE/SECRETARIAS/ServiciosPublicos/";
// Delegación global
document.addEventListener("submit", function(e){
    if(e.target.classList.contains("FormularioTotal")){
        e.preventDefault();
        let datos = new FormData(e.target);
        fetch(BASE + "Total.php", {
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
function GenerarPDF_Cambio(){
    //Aqui agarro TODOS los valores del formulario
    let Actual = document.getElementById("F_Actual").value;         //Fecha
    let Nombre= document.getElementById("NombreCompleto").value;    //Nombre completo
    let Telefono = document.getElementById("Telefono").value;       //Telefono
    let Correo = document.getElementById("Correo").value;           //Correo
    let Cargo = document.getElementById("CargoActual").value;       //Cargo
    let Motivo = document.getElementById("Motivo").value;           //Motivo
    let OpcionesCambio = document.getElementById("cambio");         //Cambio
    const OpcionesCambio_Texto = OpcionesCambio.selectedOptions[0].text;
    let OpcionesDependencia = document.getElementById("reporte");   //Dependencia
    const OpcionesDependencia_Texto = OpcionesDependencia.selectedOptions[0].text;

    
    
    //Aqui empiezo a darle el formato al PDF
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    doc.text('Solicitud de cambio de cargo', 10, 10);

    doc.text(`Fecha: ${Actual}`, 50, 15);
    doc.text(`Nombre: ${Nombre}`, 10, 15);
    doc.text(`Telefono: ${Telefono}`, 10, 20);
    doc.text(`Correo: ${Correo}`, 10, 25);
    doc.text(`Area asignada: ${Cargo}`, 10, 30);
    doc.text(`Yo deceo que mi cambio ${OpcionesCambio_Texto} sea de forma permantente`, 10, 35);
    doc.text(`Y que mi area sea ${OpcionesDependencia_Texto}`, 10, 40);   
    doc.text(`Motivo: ${Motivo}`, 10, 60);
    doc.save('a4.pdf');
}


console.log("Prueba");
document.addEventListener("submit", function(e){

    if(e.target.id === "Cambio"){
        e.preventDefault();
        

        alert("Generando reporte");
        GenerarPDF_Cambio();


        //e.target.submit(); 

    }

});