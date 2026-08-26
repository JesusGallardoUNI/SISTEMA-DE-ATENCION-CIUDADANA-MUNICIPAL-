<?php
    // 1️⃣ Indicamos que la respuesta de este archivo será en formato JSON
    // Esto le dice al navegador o a JavaScript cómo interpretar la respuesta
    header("Content-Type: application/json");

    //aqui llamamos la coneccion de la base de datos y la declaramos en la variable
    require_once __DIR__ . "/../Informacion.php";
    $db = ConectarDB(); 


    $Secretaria = $_GET["Secretaria"];

    //esta es la consulta (puede ser modificada para fines de IA, ciencia de datos ML, heristicas)
    $consulta = "SELECT * FROM reportes_especificacion WHERE seccion = '$Secretaria';";
    $resultado = mysqli_query($db, $consulta);


    //Solo en caso de error
    if(!$resultado){
        //1️⃣ Indicamos un error del servidor (HTTP 500)
        http_response_code(500);

        //2️⃣ Devolvemos una respuesta JSON indicando el error
        echo json_encode([
            "success" => false,
            "message" => "Error al ejecutar la consulta"
        ]);
        exit;
    } else {
        //Solo en caso de exito

        // Creamos un arreglo vacío donde guardaremos los registros
        $Servicios = [];


        //Recorremos cada fila del resultado con mysqli_fetch_assoc() y la guardamos en el arreglo
        while($registro = mysqli_fetch_assoc($resultado)){
            $Servicios[] = $registro;
        }

        //Devolvemos la respuesta final en formato JSON
        // success = true indica que todo salió bien
        // colonias_lista contiene los datos que JS consumirá
        echo json_encode([
            "success" => true,
            "servicios_lista" => $Servicios
        ]);
    }
?>