<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
?>


<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Asistencia</title>
        <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
        <script src="../../../Recursos/JS/ApiConsultaPrueba.js"></script>
    </head>
    <body>
        <?php Banner(true,"../../../Recursos/Imagenes/icono.png", "Asistencia de IA" ,"Propuesta de seleccion"); ?>

        <div id="lista-colonias"></div>

        <div>
            <button onclick="location.href='../MunicipioInforme.php'">Volver a la página principal</button>
        </div>
         
    </body>
</html>