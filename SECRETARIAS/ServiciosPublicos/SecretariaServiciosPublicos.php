<?php
    include "../../Recursos/Partes/Partes.php";
    $Bloqueo = Seguridad();
    if(!$Bloqueo){
        header('Location: ../GobiernoMunicipal.php');
    }
    $db = ConectarDB();
    
    //=======================================================//
    //  Aqui empiezo a buscar todos los reportes necesarios  //
    //=======================================================//
    $Buscar = "SELECT * FROM reportes_colonias WHERE resuelto != 'si' AND tipo_reporte = {$_SESSION['usuario_tipo']}";
    $Ejecutar = mysqli_query($db,$Buscar);
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
        <?php Banner(true,"../../Recursos/Imagenes/icono.png","Municipio de Guadalupe","Secretaria de servicios publicos"); ?>
        <table class="Configurar Configurar__Mediano">
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
                            <td><a href="Solucion.php?clave=<?php echo $Registro['clave']; ?>"><?php echo $Registro['clave']; ?></a></td>
                            <td><?php echo Traductor($Registro['tipo_reporte']); ?></td>
                            <td><?php echo $Registro['codigo_postal']; ?></td>
                            <td><?php echo $Registro['nombre_colonia']; ?></td>
                            <td><?php echo $Registro['nombre_calle']; ?></td>
                            <td><?php echo $Registro['fecha']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endwhile; ?>
            </tbody>
        </table>
    </body>
</html>