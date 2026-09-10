function cargarSeccion(Opcion) {
    let Ruta = "";
    switch (Opcion) {
        case 1:
            Ruta = "Acciones/Altas.php";            //YA
            break;
        case 2:
            Ruta = "Acciones/ListaCambios.php";     //YA
            break;
        case 3:
            Ruta = "Acciones/Activos.php";          //YA
            break;
        case 4:
            Ruta = "Acciones/Bajas.php";            //YA
            break;
    }
    fetch(Ruta)
        .then(res => res.text())
        .then(contenido => {
            
            document.getElementById("contenido").innerHTML = "";

            document.getElementById("contenido").innerHTML = contenido;
        });
}




//================================================//
//                Mostrar alertas                 //
//================================================//
document.addEventListener("submit", function (e) {

    if (e.target.id === "Altas_Formulario") {
        e.preventDefault();
        Muestra_Alerta("Alta Registrada", "El funcionario a sido dado de alta", "success");


        setTimeout(() => {
            e.target.submit();
        }, 1400);
    }

    if (e.target.id === "Bajas") {
        e.preventDefault();
        Muestra_Alerta("Baja Realisada", "El funcionario a sido dado de baja", "success");


        setTimeout(() => {
            e.target.submit();
        }, 1400);
    }

});