<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../ALCALDE.php');
    }
    $id = $_GET['id'];
    $db = ConectarDB();
    $Query = "SELECT * FROM reportes_colonias WHERE id = {$id}";
    $Resultado = mysqli_query($db, $Query);
    $Muestra = mysqli_fetch_assoc($Resultado);

    //=================================================================================//
    // Aqui quiero que me muestre la informacion de los funcionarios que lo atendieron //
    //=================================================================================//
    $Copia = $Muestra['clave'];
    $Soluion = "SELECT * FROM reportes_resueltos WHERE clave = '$Copia'";
    $Obtencion = mysqli_query($db, $Soluion);
    $OtraMuestra = mysqli_fetch_assoc($Obtencion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de caso</title>
    
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../../ALCALDE.css">

    <!--Importante no borrar, sirve para la api del mapa-->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

</head>

<body>
    <?php Banner(true,"../../../Recursos/Imagenes/icono.png","Reporte"); ?>
    
    <main class="Informe">
        <div class="acostado">
            <div>
                <img loading="lazy" src="../../../ImagenesReportes/<?php echo $Muestra['imagen']; ?>" alt="Foto">
                <p>Clave reporte: <?php echo $Muestra['clave']; ?></p>
                <p>Fecha de reporte: <?php echo $Muestra['fecha']; ?></p>
                <p>Colonia: <?php echo $Muestra['nombre_colonia']; ?></p>
                <p>Calle: <?php echo $Muestra['nombre_calle']; ?></p>
                <p>Codigo postal: <?php echo $Muestra['codigo_postal']; ?></p>
                <p>Reporte: <?php echo Traductor($Muestra['tipo_reporte']); ?> </p>
                <textarea class="Descripcion" rows="8" readonly><?php echo $Muestra['descripcion']; ?></textarea>
            </div>
            <div>
                <img loading="lazy" src="../../../ReportesResueltos/<?php echo $OtraMuestra['foto']; ?>" alt="Foto">
                <p>Clave resuelto: <?php echo $OtraMuestra['clave']; ?></p>
                <p>Fecha de resuelto: <?php echo $OtraMuestra['fecha_resuelto']; ?></p>
                <p>Costo: $<?php echo $OtraMuestra['costo']; ?></p>
                <textarea class="Descripcion" rows="8" readonly><?php echo $OtraMuestra['descripcion']; ?></textarea>
            </div>
        </div>
        <label for="mi_mapa">Lugar del reporte:</label>
        <div id="mi_mapa"></div>
        <input type="text" id="coordenadas" name="mi_mapa" value="<?php echo $Muestra['ubicacion']; ?>" readonly required>
    </main>
    <a href="ReportesEnColoniasResueltos.php" class="BOTON BTN__Color_Verde">Regresar</a>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="../../../Recursos/JS/General.js"></script>
</body>

</html>