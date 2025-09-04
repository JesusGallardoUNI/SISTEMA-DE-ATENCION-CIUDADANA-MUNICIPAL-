<?php
    require "../../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../../Portal.php');
    }
    //echo "<pre>";
    //var_dump($_GET);
    //echo "</pre>";

    $id = $_GET['id'];


    require "../../../Recursos/Informacion.php";
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
    <link rel="stylesheet" href="ColoniaEstilos.css">
    <link rel="stylesheet" href="../../../Recursos/CSS/General.css">
</head>

<body>
    <header>
        <img src="../../../Recursos/Imagenes/Guadalupe.png" alt="" class="logo">
        <h1 id="page-title">Reporte</h1>
    </header>
    <main class="Informe">
        <div class="acostado">
            <div>
                <img loading="lazy" src="../../../ImagenesReportes/<?php echo $Muestra['imagen']; ?>" alt="Foto">
                <p>Clave reporte: <?php echo $Muestra['clave']; ?></p>
                <p>Fecha de reporte: <?php echo $Muestra['fecha']; ?></p>
                <p>Colonia: <?php echo $Muestra['nombre_colonia']; ?></p>
                <p>Calle: <?php echo $Muestra['nombre_calle']; ?></p>
                <p>Codigo postal: <?php echo $Muestra['codigo_postal']; ?></p>
                <p>Reporte: 
                    <?php 
                        //echo $Muestra['tipo_reporte'];
                        switch($Muestra['tipo_reporte']){
                            case 1: echo "Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales"; break;
                            case 2: echo "Alumbrado público"; break;
                            case 3: echo "Limpia, recolección, traslado, tratamiento y disposición final de residuos"; break;
                            case 4: echo "Mercados y centrales de abasto"; break;
                            case 5: echo "Panteones"; break;
                            case 6: echo "Rastro"; break;
                            case 7: echo "Calles, parques y jardines y su equipamiento"; break;
                            case 8: echo "Seguridad pública, policía preventiva municipal y tránsito"; break;
                            default:
                                echo "Reporte desconocido"; break;
                        }
                    ?>
                </p>
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
    </main>
    
    <footer>
        <a href="ReportesEnColoniasResueltos.php" class="BOTON BTN__Color_Verde">Regresar</a>
    </footer>

    
</body>

</html>