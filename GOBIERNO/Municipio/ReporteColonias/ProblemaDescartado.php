<?php
    include "../../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Ayuntamiento.php');
    }
    $id = $_GET['id'];
    $db = ConectarDB();
    $Query = "SELECT * FROM reportes_colonias WHERE id = {$id}";
    $Resultado = mysqli_query($db, $Query);
    $Muestra = mysqli_fetch_assoc($Resultado);

    
    $Soluion = "SELECT * FROM reportes_descartados WHERE id_reporte = $id;";
    $Obtencion = mysqli_query($db, $Soluion);
    $OtraMuestra = mysqli_fetch_assoc($Obtencion);
    $Persona = $OtraMuestra["encargado"];
    $TipoDescarte = $OtraMuestra["tipo"];
    $MotivoDescarte = $OtraMuestra["motivo"];

    //==================================================================================//
    // Aqui quiero que me muestre la informacion de los funcionarios que lo descartaron //
    //==================================================================================//
    $Busca = "SELECT * FROM secretarias WHERE id_encargado = $Persona;";
    $Seleccion = mysqli_query($db, $Busca);
    $Nombre = mysqli_fetch_assoc($Seleccion);
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
        <table class="acostado">
            <tr>
                <td colspan="2"><img loading="lazy" src="../../../ImagenesReportes/<?php echo $Muestra['imagen']; ?>" alt="Foto"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <p>Clave reporte: <?php echo $Muestra['clave']; ?></p>
                    <p>Fecha de reporte: <?php echo $Muestra['fecha']; ?></p>
                    <p>Colonia: <?php echo $Muestra['nombre']; ?></p>
                    <p>Calle: <?php echo $Muestra['nombre_calle']; ?></p>
                    <p>Codigo postal: <?php echo $Muestra['codigo_postal']; ?></p>
                    <p>Reporte: <?php echo Traductor($Muestra['tipo_reporte']); ?> </p>
                </td>
            </tr>
            <tr>
                <td>Civil que reporta: <?php echo $Muestra['nombre_persona'];?></td>
                <td>
                    <p>Encargado que descarto el reporte: <?php echo $Nombre['Nombres'] . " " . $Nombre['Apellidos'];?></p>
                </td>
            </tr>
            <tr>
                <td><textarea class="Descripcion" rows="8" readonly><?php echo $Muestra['descripcion']; ?></textarea></td>
                <td><textarea class="Descripcion" rows="8" readonly><?php echo $TipoDescarte . " // " . $MotivoDescarte; ?></textarea></td>
            </tr>
            <tr>
                <td colspan="2">
                    <label for="mi_mapa">Lugar del reporte:</label>
                    <div id="mi_mapa"></div>
                </td>
            </tr>
        </table>
        
        <input type="hidden" id="coordenadas" name="mi_mapa" value="<?php echo $Muestra['ubicacion']; ?>" readonly required>
    </main>
    <a href="ReportesEnColoniasDescartado.php" class="BOTON BTN__Color_Verde">Regresar</a>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="../../../Recursos/JS/General.js"></script>
</body>

</html>