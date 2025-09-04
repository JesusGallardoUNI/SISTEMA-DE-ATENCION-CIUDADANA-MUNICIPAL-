<?php
    require "../../Recursos/Informacion.php";
    $db = ConectarDB();

    require "../../Recursos/Partes/Bloqueo.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../Acceso.php');
    }

    //=======================================================//
    //  Aqui empiezo a buscar todos los reportes necesarios  //
    //=======================================================//
    $Buscar = "SELECT * FROM reportes_colonias WHERE resuelto != 'si'";
    $Ejecutar = mysqli_query($db,$Buscar);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atención de reporte</title>
    <link rel="stylesheet" href="../../Recursos/CSS/General.css">
    <link rel="stylesheet" href="../BuscarEstilo.css">
</head>
<body>
    <header>
        <img src="../../Recursos/Imagenes/Guadalupe.png" alt="Logo" class="logo">
        <div>
            <h1>Atención Ciudadana</h1>
            <h2>Da clic a la clave del reporte para continuar</h2>
        </div>
        <div class="Salir">
            <img src="../../Recursos/SVG/Cerrar.svg" alt="">
            <a href="../../Recursos/Partes/Salir.php" class="">Cerrar sesión</a>
        </div>
    </header>
    <main>
        
        <div class="Configurar ancho">
            <table>
                <thead>
                    <tr>
                        <th>Clave</th>
                        <th>Reporte</th>
                        <th>Codigo postal</th>
                        <th>Colonia</th>
                        <th>Calle</th>
                        <th>Fecha de reporte</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($Registro = mysqli_fetch_assoc($Ejecutar)): ?>
                        <?php if (!empty($Registro['clave'])): ?>
                            <tr>
                                <td>
                                    <a href="Solucion.php?clave=<?php echo $Registro['clave']; ?>"><?php echo $Registro['clave']; ?></a>
                                </td>
                                <td>
                                    <?php 
                                        switch($Registro['tipo_reporte']){
                                            case 1:
                                                $Reporte="Agua potable, drenaje, alcantarillado, tratamiento y disposición de sus aguas residuales";
                                            break;
                                            case 2:
                                                $Reporte="Alumbrado público";
                                            break;
                                            case 3:
                                                $Reporte="Limpia, recolección, traslado, tratamiento y disposición final de residuos";
                                            break;
                                            case 4:
                                                $Reporte="Mercados y centrales de abasto";
                                            break;
                                            case 5:
                                                $Reporte="Panteones";
                                            break;
                                            case 6:
                                                $Reporte="Rastro";
                                            break;
                                            case 7:
                                                $Reporte="Calles, parques y jardines y su equipamiento";
                                            break;
                                            case 8:
                                                $Reporte="Seguridad pública, policía preventiva municipal y tránsito";
                                            break;
                                        }
                                        echo $Reporte;
                                    ?>
                                </td>
                                <td><?php echo $Registro['codigo_postal']; ?></td>
                                <td><?php echo $Registro['nombre_colonia']; ?></td>
                                <td><?php echo $Registro['nombre_calle']; ?></td>
                                <td><?php echo $Registro['fecha']; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
    
</body>
</html>