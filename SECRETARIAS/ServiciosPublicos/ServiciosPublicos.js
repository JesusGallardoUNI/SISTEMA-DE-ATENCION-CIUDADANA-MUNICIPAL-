
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
        case 7: 
            Ruta = "Ajustes.php";
        break;


    }
    fetch(Ruta)
        .then(res => res.text())
        .then(data => {
            /*
            const Muestra = document.getElementById("contenido");
            Muestra.replaceChildren();
            */
            document.getElementById("contenido").innerHTML = "";
            
            
            document.getElementById("contenido").innerHTML = data;
        });
}