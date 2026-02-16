<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
    $id = $_GET['id'];
    $db = ConectarDB();
    //echo "<pre>";
    //var_dump($_GET);
    //echo "</pre>";
    $Query = "SELECT * FROM reportes_colonias WHERE id = {$id}";
    $Resultado = mysqli_query($db, $Query);
    $Muestra = mysqli_fetch_assoc($Resultado);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de caso</title>
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../Ayuntamiento.css">
    

    <!--Importante no borrar, sirve para la api del mapa-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    
</head>

<body>
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Reporte"); ?>
    <main class="Informe">
        <img loading="lazy" src="../../../ImagenesReportes/<?php echo $Muestra['imagen']; ?>" alt="Foto">
        <p>Colonia: <?php echo $Muestra['nombre_colonia']; ?></p>
        <p>Calle: <?php echo $Muestra['nombre_calle']; ?></p>
        <p>Codigo postal: <?php echo $Muestra['codigo_postal']; ?></p>
        <p>Reporte: <?php echo Traductor($Muestra['tipo_reporte']); ?> </p>
        <textarea name="" id="" class="Descripcion" rows="8" readonly><?php echo $Muestra['descripcion']; ?></textarea>
        <label for="mi_mapa">Lugar del reporte:</label>
        <div>
            <div id="mi_mapa"></div>
        </div>
        <input type="hidden" id="coordenadas" name="mi_mapa" value="<?php echo $Muestra['ubicacion']; ?>" readonly required>
        <p>Fecha: <?php echo $Muestra['fecha']; ?></p>
        <a href="ReportesEnColonias.php" class="BOTON BTN__Color_Verde">Regresar</a>
    </main>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="../../../Recursos/JS/General.js"></script>
    
</body>

</html>