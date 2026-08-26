<?php
    include "../../../Recursos/Partes/Partes.php";
    /*
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    */
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Atención Ciudadana - Inicio de Sesión</title>
        <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
        <link rel="stylesheet" href="../../FUNCIONARIOS.css">
    </head>
    <body>
        <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Municipio de Guadalupe","Secretaria de servicios publicos", true, "../../../Recursos/SVG/Cerrar.svg", "../../../Recursos/Partes/Salir.php"); ?>
        
        <div class="Cuerpo">
            <nav>
                <div class="opcion Titulo_opcion" id="ScrollNavBar">
                    <h2>Menú</h2>
                    <img src="../../../Recursos/SVG/menu.svg" loading="lazy">
                </div>
                <div class="opcion">
                    <img src="../../../Recursos/SVG/reporte-propio.svg" alt="">
                    <a href="#" onclick="cargarSeccion(0)">Registrar servicios publicos</a>
                </div>
                <div class="opcion">
                    <img src="../../../Recursos/SVG/reporte-pendiente.svg" alt="">
                    <a href="#" onclick="cargarSeccion(1)">Listado de empleados</a>
                </div>
                <div class="opcion">
                    <img src="../../../Recursos/SVG/TareaTerminada.svg" alt="">
                    <a href="#" onclick="cargarSeccion(2)">Rendimiento de los empleados</a>
                </div>
                <div class="opcion">
                    <img src="../../../Recursos/SVG/reporte-propio.svg" alt="">
                    <a href="#" onclick="cargarSeccion(3)">Registrar areas encargadas</a>
                </div>
                
                
            </nav>
            <main class="Contenido" id="contenido">
            </main>
        </div>

        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script><!--ESTE ES PARA EL PDF-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script><!--ESTE ES PARA EL PDF-->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script><!--ESTE ES PARA ALERTAS-->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script><!--ESTE ES PARA GRAFICOS-->

        <script src="../../Recursos/JS/General.js"></script>
        <script src="Administracion.js"></script>

    </body>
</html>