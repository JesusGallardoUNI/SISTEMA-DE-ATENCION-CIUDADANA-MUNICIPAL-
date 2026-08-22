<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
    $db = ConectarDB();


    // Revisión del parámetro GET solo muestra
    if (isset($_GET['tipo'])) {
        $tipo = intval($_GET['tipo']);
        $Muestra = "SELECT * FROM reportes_colonias WHERE tipo_reporte = {$tipo} AND resuelto = 'no'";
    } else {
        $Muestra = "SELECT * FROM reportes_colonias WHERE resuelto = 'no'";
        $Dato = "Estas viendo el total de reportes, seleccione una opción del menú para ver casos especificos.";
    }
    $Ejecucion = mysqli_query($db, $Muestra);
?>

<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Reportes</title>
        <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
        <link rel="stylesheet" href="../../Ayuntamiento.css">
    </head>

    <body>
        <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Colonias de Guadalupe","Reporte de colonias"); ?>

        <div class="Cuerpo">
            <nav>
                <div class="opcion Titulo_opcion" id="ScrollNavBar">
                    <h2>Menú</h2>
                    <img src="../../../Recursos/SVG/menu.svg" loading="lazy">
                </div>
                <div class="opcion">
                    <img src="../../../Recursos/SVG/inicio.svg" alt="">
                    <a href="../MunicipioInforme.php">Volver a la página principal</a>
                </div>
                
                <div class="opcion" id="Opcion1">
                    <img src="../../../Recursos/SVG/opcion1.svg" alt="">
                    <a href="?tipo=1">a) Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales</a>
                    <div class="Total"><?php echo Estadistica(1, "no")?></div>
                </div>
                
                <div class="opcion" id="Opcion2">
                    <img src="../../../Recursos/SVG/opcion2.svg" alt="">
                    <a href="?tipo=2">b) Alumbrado público</a>
                    <div class="Total"><?php echo Estadistica(2, "no")?></div>
                </div>
                <div class="opcion" id="Opcion3">
                    <img src="../../../Recursos/SVG/opcion3.svg" alt="">
                    <a href="?tipo=3">c) Limpia, recolección, traslado, tratamiento y disposición final de residuos</a>
                    <div class="Total"><?php echo Estadistica(3, "no")?></div>
                </div>
                <div class="opcion" id="Opcion4">
                    <img src="../../../Recursos/SVG/opcion4.svg" alt="">
                    <a href="?tipo=4">d) Mercados y centrales de abasto</a>
                    <div class="Total"><?php echo Estadistica(4, "no")?></div>
                </div>
                
                <div class="opcion" id="Opcion5">
                    <img src="../../../Recursos/SVG/opcion5.svg" alt="">
                    <a href="?tipo=5">e) Panteones</a>
                    <div class="Total"><?php echo Estadistica(5, "no")?></div>
                </div>
                
                <!--
                <div class="opcion" id="Opcion6">
                    <img src="../../../Recursos/SVG/opcion6.svg" alt="">
                    <a href="?tipo=6">f) Rastro</a>
                </div>
                -->
                <div class="opcion" id="Opcion7">
                    <img src="../../../Recursos/SVG/opcion7.svg" alt="">
                    <a href="?tipo=7">g) Calles, parques y jardines y su equipamiento</a>
                    <div class="Total"><?php echo Estadistica(7, "no")?></div>
                </div>
                <div class="opcion" id="Opcion8">
                    <img src="../../../Recursos/SVG/opcion8.svg" alt="">
                    <a href="?tipo=8">h) Seguridad pública, policía preventiva municipal y tránsito</a>
                    <div class="Total"><?php echo Estadistica(8, "no")?></div>
                </div>
            </nav>
            <main class="Contenido">
                <div class="Contenido__Encabezado">
                    <table id="ReportesDashboard" class="Configurar Configurar__Local">
                        <thead>
                            <th class="FondoVerde">Sin retraso</th>
                            <th class="FondoAmarillo">Retraso leve</th>
                            <th class="FondoNaranja">Retraso considerable</th>
                            <th class="FondoRojo">Retraso crítico</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="Reportes_Verde">3</td>
                                <td id="Reportes_Amarillo">4</td>
                                <td id="Reportes_Naranja">1</td>
                                <td id="Reportes_Rojo">1</td>
                            </tr>
                        </tbody>
                    </table>
                    <p><?php echo $muestra = isset($Dato) ? $Dato : Traductor($_GET['tipo']);?></p>
                </div>
                <div class="Contenido_Reportes">
                    <?php while ($Registro = mysqli_fetch_assoc($Ejecucion)): ?>
                        <div class="Reporte">
                            <?php TiempoTotal($Registro['fecha']); ?>
                            <a href="Problema.php?id=<?php echo $Registro['id']; ?>">
                                <p>Codigo postal: <?php echo $Registro['codigo_postal']; ?> Colonia:  <?php echo $Registro['nombre_colonia']; ?> Calle: <?php echo $Registro['nombre_calle']; ?></p>
                                <p>Grupo: <?php echo Traductor($Registro['tipo_reporte']); ?>  Reporte: <?php echo $Registro['especificacion'] ? $Registro['especificacion'] : "nada" ; ?></p>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </main>
        </div>
        
        <script src="../../Ayuntamiento.js"></script>
        <script src="../../../Recursos/JS/General.js"></script>
    </body>
</html>