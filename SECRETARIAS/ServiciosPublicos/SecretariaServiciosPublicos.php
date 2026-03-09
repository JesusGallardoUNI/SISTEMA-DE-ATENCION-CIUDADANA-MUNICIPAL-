<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Atención Ciudadana - Inicio de Sesión</title>
        <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    </head>
    <body>
        <?php Banner(true,"../../Recursos/Imagenes/icono.png","Municipio de Guadalupe","Secretaria de servicios publicos", true, "../../Recursos/SVG/Cerrar.svg", "../../Recursos/Partes/Salir.php"); ?>
        
        <div class="Cuerpo">
            <nav>
                <div class="opcion Titulo_opcion" id="ScrollNavBar">
                    <h2>Menú</h2>
                    <img src="../../Recursos/SVG/menu.svg" loading="lazy">
                </div>
                <div class="opcion">
                    <img src="../../Recursos/SVG/reporte-propio.svg" alt="">
                    <a href="#" onclick="cargarSeccion(0)">Selecciona reportes</a>
                </div>
                <div class="opcion">
                    <img src="../../Recursos/SVG/reporte-pendiente.svg" alt="">
                    <a href="#" onclick="cargarSeccion(1)">Tus reportes pendientes</a>
                </div>
                <div class="opcion">
                    <img src="../../Recursos/SVG/TareaTerminada.svg" alt="">
                    <a href="#" onclick="cargarSeccion(2)">Tus reportes terminados</a>
                </div>
                <div class="opcion">
                    <img src="../../Recursos/SVG/Eliminar.svg" alt="">
                    <a href="#" onclick="cargarSeccion(3)">descartar un reporte</a>
                </div>
                <div class="opcion">
                    <img src="../../Recursos/SVG/estadistica.svg" alt="">
                    <a href="#" onclick="cargarSeccion(4)">Estado de atencion</a>
                </div>
                <div class="opcion">
                    <img src="../../Recursos/SVG/CambioSecretaria.svg" alt="">
                    <a href="#" onclick="cargarSeccion(5)">Solicitud de cambio</a>
                </div>
                <div class="opcion">
                    <img src="../../Recursos/SVG/informe.svg" alt="">
                    <a href="#" onclick="cargarSeccion(6)">informes</a>
                </div>
            </nav>
            <main class="LimiteTabla" id="contenido">
            </main>
        </div>

        <script src="../../Recursos/JS/General.js"></script>
        <script src="ServiciosPublicos.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script><!--ESTE ES PARA EL PDF-->
    </body>
</html>