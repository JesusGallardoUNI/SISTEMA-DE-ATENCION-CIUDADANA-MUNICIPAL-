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
        $Muestra = "SELECT * FROM reportes_colonias WHERE tipo_reporte = {$tipo} AND descartado = 'si'";
    } else {
        $Muestra = "SELECT * FROM reportes_colonias WHERE descartado = 'si'";
        $Dato = "Estas viendo el total de reportes, seleccione una opción del menú para ver casos especificos.";
    }

    $Ejecucion = mysqli_query($db, $Muestra);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Reportes resueltos</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../Ayuntamiento.css">
</head>

<body>
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Colonias de Guadalupe","Reportes descartados"); ?>
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
            <!--
            <div class="opcion" id="Opcion1">
                <img src="../../../Recursos/SVG/opcion1.svg" alt="">
                <a href="?tipo=1">a) Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales</a>
            </div>
            -->
            <div class="opcion" id="Opcion2">
                <img src="../../../Recursos/SVG/opcion2.svg" alt="">
                <a href="?tipo=2">b) Alumbrado público</a>
                <div class="Total"><?php echo Descartados(2, "si")?></div>
            </div>
            <div class="opcion" id="Opcion3">
                <img src="../../../Recursos/SVG/opcion3.svg" alt="">
                <a href="?tipo=3">c) Limpia, recolección, traslado, tratamiento y disposición final de residuos</a>
                <div class="Total"><?php echo Descartados(3, "si")?></div>
            </div>
            <div class="opcion" id="Opcion4">
                <img src="../../../Recursos/SVG/opcion4.svg" alt="">
                <a href="?tipo=4">d) Mercados y centrales de abasto</a>
                <div class="Total"><?php echo Descartados(4, "si")?></div>
            </div>
            <!--
            <div class="opcion" id="Opcion5">
                <img src="../../../Recursos/SVG/opcion5.svg" alt="">
                <a href="?tipo=5">e) Panteones</a>
            </div>
            -->
            <!--
            <div class="opcion" id="Opcion6">
                <img src="../../../Recursos/SVG/opcion6.svg" alt="">
                <a href="?tipo=6">f) Rastro</a>
            </div>
            -->
            <div class="opcion" id="Opcion7">
                <img src="../../../Recursos/SVG/opcion7.svg" alt="">
                <a href="?tipo=7">g) Calles, parques y jardines y su equipamiento</a>
                <div class="Total"><?php echo Descartados(7, "si")?></div>
            </div>
            <div class="opcion" id="Opcion8">
                <img src="../../../Recursos/SVG/opcion8.svg" alt="">
                <a href="?tipo=8">h) Seguridad pública, policía preventiva municipal y tránsito</a>
                <div class="Total"><?php echo Descartados(8, "si")?></div>
            </div>
        </nav>
        <main class="Contenido">
            <div class="Contenido__Encabezado">
                <p><?php echo $muestra = isset($Dato) ? $Dato : Traductor($_GET['tipo']);?></p>
            </div>
            <div class="Muestra" id="infoSection">
                <h2>Información Detallada</h2>
            </div>
            <div class="Contenido_Reportes">
                <?php while ($Registro = mysqli_fetch_assoc($Ejecucion)): ?>
                    <div class="Reporte">
                        
                        <a href="ProblemaDescartado.php?id=<?php echo $Registro['id']; ?>">
                            <img loading="lazy" src="../../../ImagenesReportes/<?php echo $Registro['imagen']; ?>" alt="Foto">
                            <p>Colonia: <?php echo $Registro['nombre_colonia']; ?></p>
                            <p>Calle: <?php echo $Registro['nombre_calle']; ?></p>
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